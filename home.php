<?php //this would be much better for the registration page completion
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

	<!--trade out entered with a variable that knows if you you're coming from login or registration screens-->
	<div class="home">
		Congratulations <!-- add username here. $_SESSION['username']; -->!<br>
		<?php if (isset($_SESSION['from'])){ echo $_SESSION['from'];} Else { echo 'You Are'; } ?><br>
		In The<br>
		System<br>
		<a class="btn btn-primary" href="index.php">Click Here To Return Home</a>
	</div>

</div>


<?php include ('inc/footer.php'); ?>