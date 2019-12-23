<?php
 include "includes/head_imports_main.php";
 include "config/connect.php";

if(isset($_POST['send_my_password']))
{
	$email=mysqli_real_escape_string($signup,$_POST['login_username']);
	$query="select * from users where user_email='$email'";
	$result=$signup->query($query);
	if($row =$result->fetch_assoc())
	{
		$password=$row['user_password'];
		if(mail($email,"Your Password!!","Your password is :$password","From: shah73415@gmail.com"))	
		{
			header("Location:forgot_password.php?success=".urlencode("Your Password has been sent to your email!!"));
			exit();
		}
		else
		{
			header("Location:forgot_password.php?err=".urlencode("Sorry we could not send you password at this time!!"));
			exit();
		}
		
	}
	else
	{
			header("Location:forgot_password.php?err=".urlencode("Sorry there is no user with provided Email"));
			exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    
     <form method="post" action="forgot_password.php" class="col-lg-4" style="margin-top:35px;">
     <h2>Retrieve Password</h2>
      <?php
			if(isset($_GET['success']))
			{
				echo '<div class="alert alert-success">'.$_GET['success'].'</div>';
			
			}
			if(isset($_GET['err']))
			{
				echo '<div class="alert alert-danger">'.$_GET['err'].'</div>';
			
			}
		?>
     <hr/>
        <div class="form-group" >
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" class="form-control"  placeholder="Email" required>
        </div>
        <button type="submit" name="send_my_password" class="btn btn-info">Send My Password</button>
        <a href="index.php" class="btn btn-danger">Cancel</a>
    </form>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>
