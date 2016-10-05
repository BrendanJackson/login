<?php //refactored from http://www.sourcecodester.com/tutorials/php/6102/how-create-login-page-phpmysql-using-pdo-query.html
/**
 * Created by PhpStorm.
 * User: brendan
 * Date: 6/12/16
 * Time: 5:09 PM
 */

include ('inc/header.php');


?>

<div class="wrapper">


    <div class="login">
    <form action="reg1.php" method="POST"> <!--reg1.php-->
        Username<br>
        <input type="text" name="username" /><br>
        Password<br>
        <input type="password" name="password" /><br>
        <br>
        <input class="btn btn-primary" type="submit" value="Login" /> <p>Or</p>
        <a class="btn btn-primary" href="register.php">Register</a>
    </form>
<?php
session_start();
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
    echo '<ul style="font-size:3em; padding:0; color:red;">';
    foreach($_SESSION['ERRMSG_ARR'] as $msg) {
        echo '<li>',$msg,'</li>';

        echo'<li>$rows:';
        var_dump($rows);
        echo '</li><br><li> $pw_hash:';
        var_dump($pw_hash);
        echo '</li>';
    }
    echo '</ul>';
    unset($_SESSION['ERRMSG_ARR']);
}
?>
    </div>

</div>


<?php include ('inc/footer.php');