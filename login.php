<?php

 ob_start();
 session_start();
 require_once 'dbconnect.php';
 if ( isset($_SESSION['member'])!="" ) {
  header("Location: home.php");
  exit;
 }

 $error = false;

 if( isset($_POST['btn-login']) ) {

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);


  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  
  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
   } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }

  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }

 

  // if there's no error, continue to login

  if (!$error) {

   $password = hash('sha256', $pass); // password hashing using SHA25z
   $res=mysqli_query($conn, "SELECT pk_Member_id, First_name, Cust_pass FROM member WHERE Email_address='$email'");
   $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
   $count = mysqli_num_rows($res);

   //$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
   if( $count == 1 && $row['Cust_pass']==$password ) {
    $_SESSION['member'] = $row['pk_Member_Id'];
    header("Location: home.php");
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }  

  }

 }

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous"> 
<title>Login &amp; Registration System</title>
</head>
<body style="background-color: #ADD8E6">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <div class="container">
    <div class="col-lg-4"></div>
    <div class="col-lg-4"></div>
      <div class="jumbotron" style="margin-top:150px">

             <h2> Login.</h2>
             <hr />
            <?php
   if ( isset($errMSG) ) {
echo $errMSG; ?>
           <?php

   }

   ?>

   
             <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>"  />

             <span class="text-danger"><?php echo $emailError; ?></span>
             <input type="password" name="pass" class="form-control" placeholder="Your Password"  />
             <span class="text-danger"><?php echo $passError; ?></span>
             <hr />

             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Login </button>

             <hr />

             <a href="register.php">Sign Up Here...</a>
        
    </form>

    </div>

</div>

</body>

</html>

<?php ob_end_flush(); ?>


