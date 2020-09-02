<?php
session_start();


if (empty($_SESSION['username'])) { // if the session variable doesnt exist

echo '  Sorry, you are not logged in.';


}

else { // if the session variable exists


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

  <head> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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

	.btn {   background-color: #cf0000;  
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
           <h1>Fakeit</h1>                          
      
		  <br>
		   <div class="navbar-nav">
		
		<div class="nav-item nav justify-content-center">
		 <?php if (!empty($_SESSION['username'])) { ?>
		 
<a href="<?= base_url()."CreateLink"?>"><button type="button" class="btn btn-primary btn-lg">Create Post</button></a>

		 <?php } ?>


<a href="<?= base_url()."TopPosts"?>"><button type="button" class="btn btn-primary btn-lg ">Top Posts</button></a>

 
<a href="<?= base_url()."NewPosts"?>"><button type="button" class="btn btn-primary btn-lg">New Posts</button></a>



     </div> </div>

	
	
	<!DOCTYPE html>
<html lang="en">

<?php if (empty($_SESSION['username'])) { ?>
<form id="loginform" >  
 <div class="form-row align-items-center">
<div class="col-auto">
 
 
<label class="sr-only" for="login_name"><b>Username</b></label>


 <input type="text" class="form-control mb-2" placeholder="Username" name="login_name" id="login_name">
 </div>

 <div class="col-auto">
<label class="sr-only" for="login_pass"><b>Password</b></label>


<input type="password" class="form-control mb-2" placeholder="Password" name="login_pass" id="login_pass">
</div>
<div class="col-auto">
<span class="errormess"></span>

</div>
  <div class="col-auto">
<button type="submit" class="btn btn-primary mb-2" id="loginbtn">Login </button>

</div>

<br>
<br>
<br>
<br><br>

<br>
</div>
</form>
<?php } ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
 <script language="Javascript">
 
   
   $('#loginform').submit(function(e) {
	  // if submit button is clicked
	 
    var username = $('#login_name').val(); // define username variable
    if (username == "") { // if username variable is empty
       $('.errormess').html('Please Insert Your Username'); // printing error message
       return false; // stop the script
    }
    var password = $('#login_pass').val(); // define password variable
    if (password == "") { // if password variable is empty
       $('.errormess').html('Please Insert Your Password'); // printing error message
       return false; // stop the script
    }
  
    $.ajax({ // JQuery ajax function
      type: "POST", // Submitting Method
      url: "<?= base_url()."checklogin"?>", // PHP processor
      data: 'username='+ username + '&password=' + password,
      dataType: "html", // type of returned data
      success: function(data) { // if ajax function results success
      if (data == username) { // if the returned data equal 0
	 	  document.location.href = "<?= base_url();?>";
      } else if (data == 0) { // if the returned data not equal 0
	   $('.errormess').html('Incorrect Login, please try again.'); // print error message
      }
      }
     });
	 return false;
});
		
	
	</script>
	
	
	<div id="test"></div>

 
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

	foreach($paginationposts as $post){

		?>
	
	
     <tr><td>
	 <?php if (!empty($_SESSION['username'])) { ?>
	 

<button type="button" class="btn" value="Upvote" name="upvotehomepage" onClick="upvote(<?php echo $post->PostID ?>)">Upvote</button>
<?php } ?>

<div class="votes" id="v<?php echo $post->PostID?>"><?php echo $post->Votes; ?></div>

<?php if (!empty($_SESSION['username'])) { ?>

<button type="button" class="btn" value="Downvote" name="downvotehomepage" onClick="downvote(<?php echo $post->PostID ?>)">Downvote</button>
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
    <strong> <?php }
	 
	 echo $links;

	 
	 ?>  
</strong>
	
   </table>
  
  
  
	


  </body>
</html>
