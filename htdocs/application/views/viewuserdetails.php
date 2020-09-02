<?php
session_start();


if (empty($_SESSION['username'])) { // if the session variable is not exists

echo 'sorry, you are not logged in';


}

else { // if the session variable is exists


   $session_value = $_SESSION['username'];
  
 	 foreach($userids as $uids){
		 if($uids->username == $session_value){
			 
			 echo 'Welcome '; echo $uids->username; echo ', you are logged in.';
			 ?> 
			 <a href="http://timetablegenerator.epizy.com/index.php/Note/UserDetails?varname=<?php echo $uids->userID ?>"> 
<?
			 echo ' Your User Profile';
			 ?>
			
 </a>
			 
	<?		 
	
	 }
		 ?>


<?
}
}
?>
<br>
<span class="idoutput"></span>


<?php if (!empty($_SESSION['username'])) { ?>
<form id="logoutform" class="form-horizontal"> 
<input type="hidden" value="" class="form-control" name="logout_user" id="logout_user">
<button class="btn" id="Logoutbtn">Logout</button>
</form>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
 <script language="Javascript">

 var logoutreq = "";
 
  $('#logoutform').submit(function (e) {
	  // if logout button is clicked
 
    $.ajax({ // JQuery ajax function
      type: "POST", // Submitting Method
      url: "<?= base_url()."LogOut"?>", // PHP processor
      data:  $('#logoutform').serialize(),
      success: function(data) { // if ajax function results success
    document.location.href = "<?= base_url();?>";
      }
     });
	 return false;
});
	</script>
	
<?php } ?>

<!DOCTYPE html>
<html lang="en">
  <head> <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   <style>
    body {
		padding-top: 70px; }
	
	a { color: red;
text-align: center;	}
	
	h1 { color : red;
	font-size: 160px;
	font-weight: bold;
	text-align: center;	
	}

	.btn {   background-color: #555555;  
border: white;
color: white;
font-weight: bold;
    }
	
	table {
		text-align: center;
		align-items:center;
	}
	
	form {
		
padding: 30px;
		
	}
	
	b {
		
		font-weight: bold;
		text-align:center;
	}
	
  </style>
  </head>
  <body>
           <h1><a href="<?= base_url()?>">Fakeit</a> </h1>                        
      
		  <br>
		   <p class="navbar-brand">
		 <div class="btn-group btn-group-justified">
		 <?php if (!empty($_SESSION['username'])) { ?>
		 <div class="btn-group">
<a href="<?= base_url()."CreateLink"?>"><button type="button" class="btn btn-primary">Create Post</button></a>
</div>
		 <?php } ?>
 <div class="btn-group">
<a href="<?= base_url()."TopPosts"?>"><button type="button" class="btn btn-primary">Top Posts</button></a>
</div>
 <div class="btn-group">
<a href="<?= base_url()."NewPosts"?>"><button type="button" class="btn btn-primary">New Posts</button></a>

</div>

       </div></p>
	   
	   <h3 align="center"> My Posts </h3>
	
  <?php
   $var_value = $_GET['varname'];
  $x = 0;
 
	 foreach($posts as $postdetail){
		 if($postdetail->userID == $var_value){
		 $sum[$x]= $postdetail->Votes;
		 $x++;
		 
		 ?>
		 
		  
		   <br>
		   <br>
		<div class="container">
      <div class="media">
	        <div class="media-right media-middle">
			  <img src="" class="media-object" style="width:90px">
			  </div>
			   <div class="media-body">
    <h4 class="media-heading"><strong><?php echo $postdetail->username;?></strong></h4>
    <p><?php echo $postdetail->PostDesc;?>
	<br>
	<a href="<?php echo $postdetail->PostLink;?>"><?php echo $postdetail->PostLink;?></a>
	<br>
	 <b>Votes:</b> <?php echo $postdetail->Votes;?>
	<br>
	</p>
  </div>
</div>
</div>
<hr>
       <?php }}
	 
	 ?>  <h3 align="center"><b>My User Score: <? echo array_sum($sum);?>  </b></h3>
	 
<hr>
<h3 align="center"> My Comments </h3>
	<?php
	 foreach($comments as $listcomments){
		 if($listcomments->userID == $var_value){
		 ?>
		
		<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
	 <strong><?php echo $listcomments->username;?></strong> 
	<br>
	<?php echo $listcomments->CommentDate;?></div>
      <div class="panel-body">
	  <?php echo $listcomments->CommentText;?>
	  </div>
    </div></div>

  
     <?php }}?>  


  </body>
</html> 
