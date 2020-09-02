<?php
class DatabaseModel extends CI_Model {

 //CHANGE HOST NAME IN DATABASE.PHP TO LOCALHOST BEFORE SUBMISSION.
function getNotes(){
 $this->db->select("fakeit_posts.PostID, fakeit_users.userID, fakeit_posts.PostLink, fakeit_posts.PostDesc, fakeit_posts.Votes, fakeit_posts.PostDate, fakeit_posts.Votes, fakeit_users.username");
  $this->db->from('fakeit_posts');
  $this->db->join('fakeit_users', 'fakeit_users.userID = fakeit_posts.userID');
  $query = $this->db->get();
  return $query->result();
}


function getPosts($limit, $offset){
	$this->db->limit($limit,$offset);
	 $this->db->select("fakeit_posts.PostID, fakeit_users.userID, fakeit_posts.PostLink, fakeit_posts.PostDesc, fakeit_posts.Votes, fakeit_posts.PostDate, fakeit_users.username");
  $this->db->from('fakeit_posts');
  $this->db->join('fakeit_users', 'fakeit_users.userID = fakeit_posts.userID');
	$query = $this->db->get();
	
	if($query->num_rows() > 0){
		return $query->result();
		
	}else {
		return $query->result();
		
	}
}
function getID(){
  $this->db->select("PostID");
  $this->db->from('fakeit_posts');
  $query = $this->db->get();
  return $query->result();
}

function checkUsers($id){
	$query = $this->db->get_where('fakeit_users', array('userID' => $id));
 
	return $query->result();
}
function getUsers(){
 $this->db->select("userID, username");
  $this->db->from('fakeit_users');
  $query = $this->db->get();
  return $query->result();
}

function getVotes($post_id){
 $this->db->select("Votes");
  $this->db->from('fakeit_posts');
 $this->db->where('PostID',$post_id);
$query = $this->db->get();
 $result = $query->row();
 
	if($query->num_rows() == 1) {
		$success = $result->Votes;
		return $success;
	}

}

 public function processupVotes($post_id){ 
  $this->db->set('Votes', 'Votes+1', FALSE);
 $this->db->where('postID', $post_id);
 $this->db->update('fakeit_posts');
return true;
 

 }
 
  public function processdownVotes($post_id){ 
  $this->db->set('Votes', 'Votes-1', FALSE);
 $this->db->where('postID', $post_id);
 $this->db->update('fakeit_posts');
return true;
 

 }
public function updateUsers($id, $userdata){
	 $this->db->where('userID',$id);
	 $this->db->update('fakeit_users',$userdata);
 }

function getComments(){
$this->db->select("fakeit_comments.CommentID, fakeit_comments.PostID, fakeit_comments.userID, fakeit_comments.CommentText, fakeit_comments.CommentDate, fakeit_users.username");
  $this->db->from('fakeit_comments');
  $this->db->join('fakeit_users', 'fakeit_users.userID = fakeit_comments.userID');
  $this->db->order_by('CommentDate', 'DESC');
  $query = $this->db->get();
  return $query->result();
}


function getTopVotes(){
 $this->db->select("fakeit_posts.PostID, fakeit_users.userID, fakeit_posts.PostLink, fakeit_posts.PostDesc, fakeit_posts.Votes, fakeit_posts.PostDate, fakeit_users.username");
  $this->db->from('fakeit_posts');
  $this->db->join('fakeit_users', 'fakeit_users.userID = fakeit_posts.userID');
  $this->db->order_by('Votes', 'DESC');
  $query = $this->db->get();
  return $query->result();
}


function getNewPosts(){
  $this->db->select("fakeit_posts.PostID, fakeit_users.userID, fakeit_posts.PostLink, fakeit_posts.PostDesc, fakeit_posts.Votes, fakeit_posts.PostDate, fakeit_users.username");
  $this->db->from('fakeit_posts');
  $this->db->join('fakeit_users', 'fakeit_users.userID = fakeit_posts.userID');
  $this->db->order_by('PostDate', 'DESC');
  $query = $this->db->get();
  return $query->result();
}



public function process($data){
	 $this->db->insert('fakeit_comments',$data);
 }
 
 
 public function processLink($linkdata){
	 $this->db->insert('fakeit_posts',$linkdata);
 }
 
  public function insertUser($registerdata){
	 $this->db->insert('fakeit_users',$registerdata);
 }
 
 
 

function countPosts() {
	//counts amount of records in posts table for pagination.
	return $this->db->count_all('fakeit_posts');
	
}


private $url = 'http://timetablegenerator.epizy.com/index.php/Users/users';

 function getuserids()
{
  $userdata = file_get_contents($this->url);

  return json_decode($userdata,false);
}



function loginCheck($login_user,$login_pass) {

  $this->db->select("username, password");
  $this->db->from('fakeit_users');
	 $this->db->where('username',$login_user);
	  $this->db->where('password',$login_pass);
	$query = $this->db->get();
	 $result = $query->row();
	 
	
if ($query->num_rows() == 1){
	
	 $_SESSION['username'] = $login_user;
    return $_SESSION['username'];
	
}

else {
	
	return 0;
}
}



	
}
	

?>
