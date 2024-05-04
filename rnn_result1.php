<?php
$x_rnn1 = "";
$con = mysqli_connect("localhost","root","","library");
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	 $x_rnn1 = $_POST['x_rnn'];
	 if(!$con){
		 echo "Connection ERROR ".mysqli_connect_error();
		 die('Could not Connect:'.mysql_error());
		 }
	 $insert="INSERT INTO `rnn_tbl`(`r_request`, `r_state`, `user_id`) VALUES ('$x_rnn1', 0 , 1);";	
	 mysqli_query($con , $insert) or die('cannot execute query');
	 echo "inserted in database";
	 header("Location: rnn_result.php");
	 mysqli_close($con);
	
}

?>

