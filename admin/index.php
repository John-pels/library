<?php
session_start();
require_once "../includes/script.php";
if ( isset($_SESSION['id']) ) {
    header ("location: dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../images/rasmed_favicon.png" type="image/x-icon">
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_login.css">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

    <title>Administrator Login</title>
</head>
<body>
    <div class="container">
    <div class="row">
    <div class=" col-lg-6 col-lg-offset-4 col-md-6 col-md-offset-4 col-sm-12 d-flex">
 <div class="form-popup" id="myForm">
            <form action="" class="form-container" method="post" enctype="multipart/form-data">
                        <center><img src="../images/rasmedlogo-01.png" width="200" height="50" class="img-responsive"></center>
                        
                <h2 style="color: #23415C; text-align: center;">Administrator Login</h2>
                            <div><?php echo $error_message; ?></div> 
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Username" name="username" required tabindex="1" autofocus>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required tabindex="2">

                <button type="submit" class="btn" name="adminLogin" tabindex=3>Login</button>
            </form>
</div>
    </div>
    </div>
    </div>
    
</body>
</html>