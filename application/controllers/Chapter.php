<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapter extends CI_Controller {
    function __construct() 
	{
        parent::__construct();
        $this->load->model('Chapters');
    }
	public function index()
	{
        $Chapters = Chapters::orderBy('name')->get();
        echo($Chapters);
    }
    public function add(){
        $request = $this->input->post();

        $feedback = new Feedbacks();
        $feedback->feedbackType_id = $request['feedbackType'];
        $feedback->text = $request['text'];
        $feedback->chapter_id = $request['chapter'];
        $feedback->approved = 0;
        $feedback->save();
        
        $feed = Feedbacks::all();
        echo(json_encode($feed));


    }
    public function fetch(){
        
        
    }
}
