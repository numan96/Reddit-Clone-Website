<?php
session_start();


if (empty($_SESSION['username'])) { // if the session variable is not exists

echo '  Sorry, you are not logged in.';


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

<?php if (empty($_SESSION['username'])) { ?>
	 
<form action="<?= base_url()."Register"?>" method="post" id="register">
<button class="btn" value="Register" name="register" />Register</button></form>
<?php } ?>

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

       </div>   </p>

	
	
	<!DOCTYPE html>
<html lang="en">


	
	
	

 
    <table class="table table-striped table-hover">
     <tr>
      <td></td>
	  <td></td>
<td><strong>Usernames</strong></td>
	  <td><strong>Links</strong></td>
	  	  <td></td>
    </tr>
     <?php 
	$varname = $ids;

	?>
	  

<?php

	foreach($posts as $post){?>
     <tr><td>
		 <?php if (!empty($_SESSION['username'])) { ?>
	 <button type="button" class="btn" value="Upvote" name="upvotenew" onClick="upvote(<?php echo $post->PostID ?>)">Upvote</button>

	
<?php } ?>

<div class="votes" id="v<?php echo $post->PostID?>"><?php echo $post->Votes; ?></div>

<?php if (!empty($_SESSION['username'])) { ?>
<button type="button" class="btn" value="Downvote" name="downvotenew" onClick="downvote(<?php echo $post->PostID ?>)">Downvote</button>

<?php } ?>
</td></strong>
	 <td></td>
         <td><?php echo $post->username;?></td>
		 
 <td><a href="<?php echo $post->PostLink;?>"> 
		  <?php echo $post->PostLink;?></a></td> 
		  
		 
		  <td><div class="btn-group btn-group-lg"><a href="http://timetablegenerator.epizy.com/index.php/Note/PostDetails?varname=<?php echo $post->PostID ?>"> 
		  
<button type="button" class="btn">View Post</button></a>
		</a></td> 


      </tr>
	
    <?php }
	 
	 

	 
	 ?>  

	 
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
 <script language="Javascript">
 function upvote(post_id){
 
 var url = 'http://timetablegenerator.epizy.com/index.php/Users/upvote?post_id=';
 url += post_id;
 $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
updatevotes(post_id);
                
                }
       
            });
        }
		
		function downvote(post_id){
		 var url2 = 'http://timetablegenerator.epizy.com/index.php/Users/downvote?post_id=';
 url2 += post_id;
 $.ajax({
                type: 'GET',
                url: url2,
                success: function (data) {
updatevotes(post_id);
                
                }
       
            });
        }
		
 function updatevotes(post_id){
 
 var url = 'http://timetablegenerator.epizy.com/index.php/Users/updatevotes?post_id=';
 url += post_id;
 $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
					$("#v" + post_id).html(data);
                }
       
            });
        }
 
</script>	
   </table>
  
  
  
	


  </body>
</html>
