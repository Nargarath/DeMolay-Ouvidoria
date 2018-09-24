<?php
# application/middleware/TestMiddleware.php

class AuthMiddleware implements Luthier\MiddlewareInterface
{
    function __construct() 
	{
        ci()->load->library('ion_auth');
        
		
	}

    public function run($args)
    {
        $data = array(
			'logged_in' => ci()->ion_auth->logged_in(),
			'is_admin' => ci()->ion_auth->is_admin()
        );
        
        if(!$data['logged_in']){
            echo('Você não está logado');
            exit;

        }else if($data['logged_in'] && !$data['is_admin']){
            echo('Você não é admin');
            exit;
        }
    }
}