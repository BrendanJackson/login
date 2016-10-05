<?php  /*password incryption http://php.net/manual/en/function.crypt.php*/
/*better code http://stackoverflow.com/questions/23305300/check-if-username-exists-pdo*/
require ("inc/encrypt.php");

session_start(); /*stores variables across multiple pages*/
$errmsg_arr = array(); /* declares $errmsg_arr is an array*/
$errflag = false; /*decalres $errflag is false */
// configuration
$dbhost 	= "localhost";  /* sets PDO to query localhost */
$dbname		= "pdo_ret";    /* */
$dbuser		= "root";       /* */
$dbpass		= "evanetra";   /* */

// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

// new data
//catches form data sent w/ POST method, action being reg.php page
$username = $_POST['username'];
$pass_hash = PassHash::hash($_POST['password']);
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$age = $_POST['age'];
$email = $_POST['email'];



/*Username verification, does this already exist in the database?*/
if($username == '') {
    $errmsg_arr[] = 'You must enter your User Name';
    $errflag = true;
}
/*
if(isset($username)){

    //sets query for sql to have usernames = $username variable. this function is named user_sql
    $user_sql = ("SELECT * FROM table_name where username='$username'");
    $mysql_get_users = $conn->prepare($user_sql);//preps query to be made

    $get_rows = conn->rowCount($conn);

    if($get_rows >=1){
        echo "user exists";
        die();
    }

    else{
        echo "user do not exists";
    }

}
*/


/*Password verification*/
if(/*$password*/$pass_hash == '') {
    $errmsg_arr[] = 'You must enter your Password';
    $errflag = true;
}
if($fname == '') {
    $errmsg_arr[] = 'You must enter your First Name';
    $errflag = true;
}
if($lname == '') {
    $errmsg_arr[] = 'You must enter your Last Name';
    $errflag = true;
}
if($age == '') {
    $errmsg_arr[] = 'You must enter your Age';
    $errflag = true;
}
/*PDO MAILER EMAIL VERIFY*/
if($email == '') {
    $errmsg_arr[] = 'You must enter a valid Email Address';
    $errflag = true;
}
require("inc/phpmailer/class.phpmailer.php");

$mail = new PHPMailer; //validates email address

if (!$mail->ValidateAddress($email)) {
    echo "failed!";
    exit;
}

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: register.php");
    exit();
}
// query : for whatever reason, it seems to be requiring these ridiculous fucking key values :asaf, etc,
// it hasn't worked without them. I don't know wtf is wrong with this shit. transfer suggest page
//http://stackoverflow.com/questions/22238406/selecting-mysql-table-data-into-an-array-using-pdo-class
//Don't inject values into your SQL queries. Use parameter binding instead

/*http://stackoverflow.com/questions/23305300/check-if-username-exists-pdo*/
if(!isset($error)){
//no error
    $query = $conn->prepare("SELECT username, email  FROM members WHERE username = :usr OR email = :email");
    $query->bindParam(':usr', $username);
    $query->bindParam(':email', $email);
    $query->execute();

    if($query->rowCount() > 0){
       header("location: registration_fail.php");
      //  echo "<p class='return-reg'>Username or Email already exists in the database</p>";
       // echo "<a class='return-reg btn btn-primary' href='register.php'>Return to registration page</a>";



    } else {
        //Securly insert into database
        $sql = 'INSERT INTO members (username,password,fname,lname,age,email) VALUES (:usr,:pw,:fname,:lname,:age,:email)';
        $query = $conn->prepare($sql);

        $query->execute(array(

            ':usr' => $username,
            ':pw' => $pass_hash,
            ':fname' => $fname,
            ':lname' => $lname,
            ':age' => $age,
            ':email' => $email
        ));

        $_SESSION['from'] = "You Successfully Registered";
        header("location: home.php");
    }
}else{
    echo "error occured: ".$error;
    exit();
}
/*
try {
    $sql = "INSERT INTO members (username,password,fname,lname,age,email) VALUES (:usr,:pw,:fname,:lname,:age,:email)";
    $query = $conn->prepare($sql);
    $query ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query ->execute(array(':usr' => $username, ':pw' => $pass_hash, ':fname' => $fname, ':lname' => $lname, ':age' => $age,
        ':email' => $email));

    $_SESSION['from'] = "You Successfully Registered";
    

    header("location: home.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
*/
/* consider adding username to the home completion page
    $result = $conn ->prepare('SELECT * FROM members WHERE username= :usr ');
    $result->bindParam(':usr', $username);
    $result->execute();
    $rows = $result->fetch(PDO::FETCH_ASSOC);

    $_SESSION['username'] = $_POST['username'];
*/


/*
// MySQL returned an empty result set (i.e. zero rows)
That just means that for your query, it didn't return anything. That is normal for an INSERT,
as it isn't a SELECT query and as such doesn't specifiy anything to return, so it doesn't return anything.
*/



//dbconnect
//http://stackoverflow.com/questions/17736421/how-to-prevent-duplicate-usernames-when-people-register-php-mysql



?>