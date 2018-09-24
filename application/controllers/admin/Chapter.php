<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Pagination\Paginator as Paginator;

class Chapter extends CI_Controller {
    function __construct() 
	{
        parent::__construct();
        $this->load->model('Chapters');
    }
	public function index()
	{
        $Chapters = Chapters::all();
        echo($Chapters);
    }
    public function del($id){

        $chapter = Chapters::find($id);
        $chapter->delete();
        
        echo(json_encode($chapter));

    }
    public function edit(){
        $request = $this->input->post();
        $chapter = Chapters::find($request['id']);
        $chapter->name  = !empty($request['name'])?$request['name']:$chapter->name;
        $chapter->number  = !empty($request['number'])?$request['number']:$chapter->number;
        $chapter->region  = !empty($request['region'])?$request['region']:$chapter->region;
        $chapter->emblem  = !empty($request['emblem'])?$request['emblem']:$chapter->emblem;
        $chapter->save();
        
        echo(json_encode($chapter));
    }
    public function datatable(){
        $request = $this->input->get();
        $current_page = $request['page'];
        $per_page = $request['per_page'];
        $sort = $request['sort'];
        $filter = isset($request['filter'])?$request['filter']:'';
        
        Paginator::currentPageResolver(function () use ($current_page){
            return $current_page;
        });
        if(empty($sort)){
            if(!empty($filter)){
                $result = Chapters::where('name','like','%'.$filter.'%')->paginate($per_page)->withPath(route('chapersTable'))->appends(['sort' => $sort,'filter'=>$filter]);
            }else{
                $result = Chapters::paginate($per_page)->withPath(route('chapersTable'))->appends(['sort' => $sort]);
            }
            
        }else{
            $sort_exploded = explode("|",$sort);
            if(!empty($filter)){
                $result = Chapters::where('name','like','%'.$filter.'%')->orderBy($sort_exploded[0], $sort_exploded[1])->paginate($per_page)->withPath(route('chapersTable'))->appends(['sort' => $sort,'filter'=>$filter]);
            }else{
                $result = Chapters::orderBy($sort_exploded[0], $sort_exploded[1])->paginate($per_page)->withPath(route('chapersTable'))->appends(['sort' => $sort]);
            }
            
        }
        


        echo(json_encode($result));
    }
}
