<?php  /*refactored from http://www.sourcecodester.com/tutorials/php/6093/how-create-registration-page-phpmysql-using-pdo-query.html*/
session_start();/*A session is a way to store information (in variables) to be used across multiple pages.
Unlike a cookie, the information is not stored on the users computer.
 A session will last on a number of pages until the user closes the browser
 A session is started with the session_start() function.

  http://www.w3schools.com/php/php_sessions.asp */
?>
<?php //$_SESSION == Session variables are set with the PHP global variable: $_SESSION
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
    /* count, counts elements in an array. If an errmsg_arr is set,
   and variable is an array, and that array is greater than 0 do the following*/
    echo '<ul style="padding:0; color:red;">';
    foreach($_SESSION['ERRMSG_ARR'] as $msg) {
        echo '<li>',$msg,'</li>';
        /*set each array element as the variable $msg and make it a red list item*/
    }
    echo '</ul>';
    unset($_SESSION['ERRMSG_ARR']);
    /*forget/unset the session variable/array errmsg_arr*/
}


include ('inc/header.php');
?>
<div class="wrapper">

    <!--POST - Submits data to be processed to a specified resource, in our case username and password -->
    <div class="register">
    <form action="reg.php" method="POST">
        Username<br>
        <input type="text" name="username" /><br>
        Password<br>
        <input type="password" name="password" /><br>
        First Name<br>
        <input type="text" name="fname" /><br>
        Last Name<br>
        <input type="text" name="lname" /><br>
        Age<br>
        <input type="text" name="age" /><br>
        Email<br>
        <input type="email" name="email" /><br>
        <br>
        <input class='btn btn-primary' type="submit" value="Save" />
    </form>
    </div>

</div>

<?php

include ('inc/footer.php');