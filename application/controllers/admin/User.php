<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Pagination\Paginator as Paginator;

class User extends CI_Controller {
    function __construct() 
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('Users');
		$this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->lang->load('auth');
        
    }
	public function index()
	{

		
    }
    public function add(){
        $request = $this->input->post();

        $this->form_validation->set_data($request);
		$this->form_validation->set_rules('name','Nome' ,'required');
        $this->form_validation->set_rules('email','Email' ,'required');
        $this->form_validation->set_rules('password','Senha' ,'required');
        $this->form_validation->set_rules('cpassword','Confirmar senha' ,'required|matches[password]');

        $this->form_validation->set_error_delimiters('', '');
        
        if ($this->form_validation->run() === TRUE)
		{

            $name = $request['name'];
            $email = strtolower($request['email']);
            $password = $request['password'];

            $additional_data = array(
                'first_name' => $name,

            );

            $usuario = $this->ion_auth->register($email, $password, $email, $additional_data);

            if($usuario){
                $data['success'] = true;
                $data['message'] = "O usuário foi salvo com sucesso!";
                
            }else{
                $data['success'] = false;
                $data['message'] = "Ocorreu um erro ao salvar o usuário, tente novamente outra hora.";
            }
            echo(json_encode($data));
        }else{
            $data['success'] = false;
			$data['errors'] = $this->form_validation->error_array();
            $data['message'] = "Preencha todos os campos";
            echo(json_encode($data));
        }
    }
    public function del($id){

        $feedback = Feedbacks::find($id);
        $feedback->delete();
        
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
                $result = Users::where('username','like','%'.$filter.'%')->paginate($per_page)->withPath(route('usersTable'))->appends(['sort' => $sort,'filter'=>$filter]);
            }else{
                $result = Users::paginate($per_page)->withPath(route('usersTable'))->appends(['sort' => $sort]);
            }
            
        }else{
            $sort_exploded = explode("|",$sort);
            if(!empty($filter)){
                $result = Users::where('username','like','%'.$filter.'%')->orderBy($sort_exploded[0], $sort_exploded[1])->paginate($per_page)->withPath(route('usersTable'))->appends(['sort' => $sort,'filter'=>$filter]);
            }else{
                $result = Users::orderBy($sort_exploded[0], $sort_exploded[1])->paginate($per_page)->withPath(route('usersTable'))->appends(['sort' => $sort]);
            }
            
        }
        


        echo(json_encode($result));
    }
}
