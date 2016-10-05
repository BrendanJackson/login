<?php
/**
 * Created by PhpStorm.
 * User: brendan
 * Date: 6/12/16
 * Time: 5:12 PM

 */
session_start();

include ('inc/header.php');
?>

    <div class="wrapper">


        <div class="registration_fail">
            <p class='return-reg'>Username or Email already exists in the database</p><br>
            <a class='return-reg btn btn-primary' href='register.php'>Return to registration page</a>

        </div>

    </div>


<?php include ('inc/footer.php'); ?>