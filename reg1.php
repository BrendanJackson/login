<?php
/**
 * Created by PhpStorm.
 * User: brendan
 * Date: 6/12/16
 * Time: 5:12 PM
 */


session_start();

require("inc/encrypt.php");

$errmsg_arr = array();
$errflag = false;
// configuration
$dbhost 	= "localhost";
$dbname		= "pdo_ret";
$dbuser		= "root";
$dbpass		= "evanetra";

// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

// new data

$username  = $_POST['username'];
$password = $_POST['password'];


if($username == '') {
    $errmsg_arr[] = 'You must enter your Username';
    $errflag = true;
}
if($password == '') {
    $errmsg_arr[] = 'You must enter your Password';
    $errflag = true;
}

// query
$result = $conn->prepare("SELECT * FROM members WHERE username= :usr"); /*AND password= :pw*/
$result->bindParam(':usr', $username);
//$result->bindParam(':pw', $password/*$pass_hash*/);
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);


$pw_hash = $rows['password'];
if (PassHash::check_password($pw_hash, $_POST['password'])) {
    $_SESSION['from']  = "You Successfully Logged";
    header("location: home.php");
    
}else{
$errmsg_arr[] = 'Username and Password are not found';
$errflag = true;
    echo'$rows:';
    var_dump($rows);
    echo '<br> $pw_hash:';
    var_dump($pw_hash);
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: login.php");
    exit();
}



?>
