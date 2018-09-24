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
    public function add(){
        $request = $this->input->post();

		$this->form_validation->set_data($request);
		$this->form_validation->set_rules('feedbackType','tipo de feedback' ,'required');
        $this->form_validation->set_rules('text','texto de feeback' ,'required');
        $this->form_validation->set_rules('chapter','capitulo' ,'required');
        $this->form_validation->set_error_delimiters('', '');
        
        if ($this->form_validation->run() === TRUE)
		{
            $feedback = new Feedbacks();
            $feedback->feedbackType_id = $request['feedbackType'];
            $feedback->text = $request['text'];
            $feedback->chapter_id = $request['chapter'];
            $feedback->approved = 0;
            $feedback->save();
            
            if($feedback){
                $data['success'] = true;
                $data['message'] = "Seu feedback foi salvo com sucesso, em breve estará público no mural.";
                echo(json_encode($data));
            }else{
                $data['success'] = false;
                $data['message'] = "Ocorreu um erro ao salvar o seu feedback, tente novamente outra hora.";
            }
            

            
        }else{
            $data['success'] = false;
			$data['errors'] = $this->form_validation->error_array();
            $data['message'] = "Preencha todos os campos";
            echo(json_encode($data));
        }
    }
    public function datatable(){
        $request = $this->input->get();
        $paginate = json_decode($request['paginate'],true);
        $current_page = $paginate['current_page'];
        
        Paginator::currentPageResolver(function () use ($current_page){
            return $current_page;
        });

        $result = Feedbacks::where('text','like','%'.$request['search'].'%')->where('feedbackType_id',$request['feedbackType'])->where('approved',true)->with('type')->with('chapter')->paginate($paginate['per_page']);

        echo(json_encode($result));
    }
}
