<?php

  class Note extends CI_Controller {
        function __construct()
      {
		  parent::__construct ();
          // load the database in the constructor
          $this->load->database();
		  $this->load->model('DatabaseModel');
		  $this->load->helper('url');
	require(APPPATH.'libraries/REST_Controller.php');
      }
	  
	  
	  //HOMEPAGE
	  public function index() {
		  
		
    $this->data['ids'] = $this->DatabaseModel->getID();

	$this->load->library('pagination');
	$config = array();
	$config['base_url'] = base_url().'';
	$config['total_rows'] = $this->DatabaseModel->countPosts();
	$config['per_page'] = 5;

	$this->pagination->initialize($config);
	
	$this->data['paginationposts'] = $this->DatabaseModel->getPosts($config['per_page'], $this->uri->segment(3));
	
	
	//the pagination links
	$this->data['links'] = $this->pagination->create_links();
	
	
	
	$this->data['userids'] = $this->DatabaseModel->getuserids();
	
	
	
	//load all the data with the homepage view.
 	$this->load->view('posts_view', $this->data);
	
 
			
	  }

	
	  
	
 
    function Register(){
	
		  $this->load->view('registerview');
		  
 } 

 // New Posts
	  function NewPosts(){
		  
				$this->data['ids'] = $this->DatabaseModel->getID();
				
				//function from database model that ordered data by date.
				$this->data['posts'] = $this->DatabaseModel->getNewPosts();
               $this->data['userids'] = $this->DatabaseModel->getuserids();
				 $this->load->view('newposts_view', $this->data);
				
			}
	  
   //Top Posts
function TopPosts(){
			$this->data['ids'] = $this->DatabaseModel->getID();
			
			
				//function from database model that ordered data by votes.
				$this->data['posts'] = $this->DatabaseModel->getTopVotes();
				$this->data['userids'] = $this->DatabaseModel->getuserids();
				 $this->load->view('topposts_view', $this->data);
			}
 
 //CreateLink
 function CreateLink() {
	 				$this->data['userids'] = $this->DatabaseModel->getuserids();

	  $this->load->view('createlinkview', $this->data);
	  
 }
 
  function submitLink(){
	
	//storing the current date when post was submitted.
	$post_date = date('Y-m-d H:i:s');
	$user_id = $this->input->post('user_id');
	$post_link = $this->input->post('post_link');
	$post_desc = $this->input->post('post_desc');
	 
	 
	 $linkdata = array(
	 'PostDate' => $post_date, 
	 'userID' => $user_id, 
	 'PostDesc' => $post_desc,
	 'PostLink' => $post_link,
	 );
	 
	 $this->DatabaseModel->processLink($linkdata);

	 //Once above function is called, would go to a blank page, echo allows for text to be shown.
	 echo 'Link Post Submitted.<br><br>';
	
	//Links to go back to pages.
	 echo '<a href="http://timetablegenerator.epizy.com/index.php/Note">Back to Post List</a><br><br>';
	 
	  echo '<a href="http://timetablegenerator.epizy.com/index.php/Note/NewPosts">Back to New Post List</a><br><br>';
	
	  echo '<a href="http://timetablegenerator.epizy.com/index.php/Note/TopPosts">Back to Top Post List</a><br><br>';
 }
 

 //submit Comment in a post.
function insertComment(){
	
    $comment_date = date('Y-m-d H:i:s');
	$post_id = $this->input->post('post_id');
	$user_id = $this->input->post('user_id');
	$comment_text = $this->input->post('comment_text');
	 
	 $data = array(
	 'PostID' => $post_id, 
	 'userID' => $user_id,
	 'CommentText' => $comment_text,
	 'CommentDate' => $comment_date,
	 );
	 
	 $this->DatabaseModel->process($data);

	 echo 'Comment Submitted.<br>';
	
	 echo '<a href="PostDetails?varname='.$post_id.'">Back to Post</a>';
 }
 
  function registerUser(){
	
	//storing the current date when post was submitted.
	
	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$email = $this->input->post('email');
	 
	 
	 $registerdata = array(
	 'username' => $username,
	 'password' => $password,
	 'email' => $email,
	 );
	 
	 $this->DatabaseModel->insertUser($registerdata);

	 //Once above function is called, would go to a blank page, echo allows for text to be shown.
	 echo 'User Registered.<br><br>';
	
	//Links to go back to pages.
	 echo '<a href="http://timetablegenerator.epizy.com/index.php/Note">Back to Post List</a><br><br>';
	 
	  echo '<a href="http://timetablegenerator.epizy.com/index.php/Note/NewPosts">Back to New Post List</a><br><br>';
	
	  echo '<a href="http://timetablegenerator.epizy.com/index.php/Note/TopPosts">Back to Top Post List</a><br><br>';
 }
 
function PostDetails() {
	
	$this->data['posts'] = $this->DatabaseModel->getNotes();
	$this->data['comments'] = $this->DatabaseModel->getComments();
	$this->data['userids'] = $this->DatabaseModel->getuserids();
	
	
	$this->load->view('viewdetails', $this->data);
 } 
 
 
 function UserDetails() {
	
	$this->data['posts'] = $this->DatabaseModel->getNotes();
	$this->data['comments'] = $this->DatabaseModel->getComments();
	$this->data['userids'] = $this->DatabaseModel->getuserids();
	
	$this->load->view('viewuserdetails', $this->data);
 }
 
 function checklogin() {
	 
	 $login_user = $_POST['username'];
	 $login_pass = $_POST['password']; 

	 
	 $logincheck = $this->DatabaseModel->loginCheck($login_user,$login_pass);
	 session_start();
	 
	 
	 if ($logincheck == $login_user){
	$_SESSION['username'] = $logincheck;
	echo $_SESSION['username'];
	return;
	 }
	 else if ($logincheck == 0){
		 
		 
		 return 0;
	 }
	 
 }
 

 
  function LogOut() {
	 $logout = $this->input->post('logout_user');
	 session_start();
	$_SESSION['username'] = $logout;

echo $_SESSION['username'];	 
return;
 }
  
  
  }
  
  ?>
