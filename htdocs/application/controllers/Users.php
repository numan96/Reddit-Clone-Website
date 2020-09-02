<?php
require(APPPATH.'libraries/REST_Controller.php');
 
class Users extends REST_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model(array('DatabaseModel'));
		$this->load->database();
	require_once(APPPATH.'libraries/Format.php');
	require_once(APPPATH.'libraries/REST_Controller.php');
}
 function user_get()
    {
		
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
 
        $user = $this->DatabaseModel->checkUsers($this->get('id'));
        
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code 
        }
 
        else
        {
            $this->response(NULL, 404);
        }
		
		
    }
     
    function userpost_post()
    {
		 $this->load->view('createlinkview');
        $result = $this->DatabaseModel->updateUsers( $this->post('id'), array(
            'username' => $this->post('name'),
            'email' => $this->post('email')
        ));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
         
    }
     
    function users_get()
    {
        $users = $this->DatabaseModel->getUsers();
         
        if($users)
        {
            $this->response($users, 200);
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	function upvote_get()
    {		 
		$post_id = $this->input->get('post_id');

    $result = $this->DatabaseModel->processupVotes($post_id);

	echo $result;
	
	return;
	
}

		function downvote_get()
    {		 
		$post_id = $this->input->get('post_id');

    $result = $this->DatabaseModel->processdownVotes($post_id);

	echo $result;
	
	return;
	
}




function updatevotes_get()
    {		
	
	$post_id = $this->input->get('post_id');
		$result = $this->DatabaseModel->getVotes($post_id);

		
 $this->response($result, 200);
	


}


}
