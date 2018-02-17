<?php

 ob_start();

 session_start(); // start a new session or continues the previous

 if( isset($_SESSION['member'])!="" ){

  header("Location: home.php"); // redirects to home.php

 }

 include_once 'dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {

  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);  

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  $count = 0;


  // basic name validation

  if (empty($name)) {

   $error = true;
   $nameError = "Please enter your full name.";
   } else if (strlen($name) < 3) {
   $error = true;


   $nameError = "Name must have atleat 3 characters.";
   } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
  

   $nameError = "Name must contain alphabets and space.";
    }
   

  //basic email validation

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
     $error = true;

  $emailError = "Please enter valid email address.";
   
  } else {
  

   // check whether the email exist or not

   $query = "SELECT Email_address FROM member WHERE userEmail='$email'";
   //$result = mysqli_query($conn, $query); 
   $result = $conn->query($query);
   //$count = mysqli_num_rows($result);
   $count = $result->num_rows;

  
   if($count!=0){
  $error = true;
   
   $emailError = "Provided Email is already in use.";
    }

  }

  // password validation

  if (empty($pass)){
    $error = true;
    $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
    $error = true;
  
    $passError = "Password must have at least 6 characters.";
  }
    

  // password encrypt using SHA256();

  $password = hash('sha256', $pass);

 

  // if there's no error, continue to signup

  if( !$error ) {
    // did not set autoincrement ...
   $qry = "SELECT Email_address FROM member";
   $result = $conn->query($qry);
   $count = $result->num_rows;

   $query = "INSERT INTO member(pk_Member_id,First_Name,Email_address,Cust_pass) VALUES($count  + 100,'$name','$email','$password')";

   $res = mysqli_query($conn, $query);

   if ($res) {

    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);

   } else {

    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later... " . $query;

   }

  }

 }

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous"> 
<title>Login & Registration System</title>
</head>
<body style="background-color: #ADD8E6">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <div class="container">
        <div class="col-lg-4"></div>
          <div class="col-lg-4"></div>
      <div class="jumbotron" style="margin-top:150px">
             <h2>Sign Up.</h2>

             <hr />
            <?php

   if ( isset($errMSG) ) {
    ?>

             <div class="alert">

 <?php echo $errMSG; ?>

             </div>

 <?php

   }

   ?>
             <input type="text" name="name" class="form-control" placeholder="Enter Name"  value="<?php echo $name ?>" />
                <span class="text-danger"><?php echo $nameError; ?></span>

             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" value="<?php echo $email ?>" />

                <span class="text-danger"><?php echo $emailError; ?></span>

             <input type="password" name="pass" class="form-control" placeholder="Enter Password" />

                <span class="text-danger"><?php echo $passError; ?></span>

             <hr />

             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>

             <hr />

             <a href="index.php">Sign in Here...</a>

    </form>

</body>

</html>

<?php ob_end_flush(); ?>
