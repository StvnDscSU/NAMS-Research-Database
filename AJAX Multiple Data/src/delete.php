<?php
include 'database.php';

// Check Table Type
$table = $_POST['table'];
if ($table == 'professors') {
  $email=$_POST['email'];
	$sql = "DELETE FROM professors WHERE Email='$email'";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	}
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
}

?>
