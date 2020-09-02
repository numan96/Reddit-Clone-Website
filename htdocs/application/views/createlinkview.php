<?php
session_start();

if (empty($_SESSION['username'])) { // if the session variable is not exists

echo '  Sorry, you are not logged in.';
}
else { // if the session variable is exists

   $session_value = $_SESSION['username'];
  
	 foreach($userids as $uids){
		 if($uids->username == $session_value){
			 $user_id = $uids->userID;
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

<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
 
 
 <!-- Header of the site. -->
 <h1><a href="<?= base_url()?>">Fakeit</a> </h1>                        
      
	  <br>
	  <!-- twitter bootstrap layout -->
		   <p class="navbar-brand">
		 <div class="btn-group btn-group-justified">
		 
		  <!-- Navigation buttons -->
		  
<div class="btn-group">
<a href="<?= base_url()."CreateLink"?>"><button type="button" class="btn btn-primary">Create Post</button></a>
</div>

 <div class="btn-group">
<a href="<?= base_url()."TopPosts"?>"><button type="button" class="btn btn-primary">Top Posts</button></a>
</div>

 <div class="btn-group">
<a href="<?= base_url()."NewPosts"?>"><button type="button" class="btn btn-primary">New Posts</button></a>
</div>

 </div></p>



<!-- Calling submitLink function from controller on submit. -->
<form action="<?= base_url()."submitLink"?>" method="post" id="linkform" class="form-horizontal">
  

<input type="hidden" class="form-control" name="user_id" id="user_id" value=<?php echo $user_id?> >

<div class="form-group">
<label class="control-label col-sm-2" for="Link">Link:</label>

<div class="col-xs-6">
<input type="text" class="form-control" name="post_link" id="post_link">
</div>
</div>


<div class="form-group">
<label class="control-label col-sm-2" for="Description">Description:</label>

<div class="col-sm-8">
<textarea class="form-control" name="post_desc" id="post_desc"></textarea>
</div>
</div>


<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn">Submit</button>
</div>
</div>

</form>
  </body>
</html>
