<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Pagination\Paginator as Paginator;

class Feedback extends CI_Controller {
    function __construct() 
	{
        parent::__construct();
        $this->load->model('Feedbacks');
        $this->load->model('FeedbackTypes');
        $this->load->library(array('form_validation'));
    }
	public function index()
	{

		
    }
    public function del($id){

        $feedback = Feedbacks::find($id);
        $feedback->delete();
        
        echo(json_encode($feedback));

    }
    public function changeStatus($id){

        $feedback = Feedbacks::find($id);
        $feedback->approved = !$feedback->approved;
        $feedback->save();
        
        echo(json_encode($feedback));

    }
    public function edit(){
        $request = $this->input->post();

        $feedback = Feedbacks::find($request['id']);
        $feedback->text  = !empty($request['text'])?$request['text']:$feedback->text;
        $feedback->feedbackType_id  = !empty($request['feedbackType_id'])?$request['feedbackType_id']:$feedback->feedbackType_id;
        $feedback->chapter_id  = !empty($request['chapter_id'])?$request['chapter_id']:$feedback->chapter_id;
        $feedback->approved  = !empty($request['approved'])?$request['approved']:$feedback->approved;
        $feedback->save();
        
        echo(json_encode($feedback));
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
                $result = Feedbacks::where('text','like','%'.$filter.'%')->paginate($per_page)->withPath(route('feedbacksTable'))->appends(['sort' => $sort,'filter'=>$filter]);
            }else{
                $result = Feedbacks::paginate($per_page)->withPath(route('feedbacksTable'))->appends(['sort' => $sort]);
            }
            
        }else{
            $sort_exploded = explode("|",$sort);
            if(!empty($filter)){
                $result = Feedbacks::where('text','like','%'.$filter.'%')->orderBy($sort_exploded[0], $sort_exploded[1])->paginate($per_page)->withPath(route('feedbacksTable'))->appends(['sort' => $sort,'filter'=>$filter]);
            }else{
                $result = Feedbacks::orderBy($sort_exploded[0], $sort_exploded[1])->paginate($per_page)->withPath(route('feedbacksTable'))->appends(['sort' => $sort]);
            }
            
        }
        


        echo(json_encode($result));
    }
}
