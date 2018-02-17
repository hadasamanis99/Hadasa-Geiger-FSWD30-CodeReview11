<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 if( !isset($_SESSION['member']) ) {
  header("Location: index.php");
  exit;
 }

 $res=mysqli_query($conn, "SELECT * FROM member WHERE pk_Member_id=".$_SESSION['member']);
 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
</head>
<body>
            Hi' <?php echo $userRow['userEmail']; ?>
            <a href="logout.php?logout">Sign Out</a>
</body>
</html>
<?php ob_end_flush(); ?>