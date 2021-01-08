<?php
include 'database.php';

// Check Table Type
$table = $_POST['table'];
  $email=$_POST['email'];
if ($table == 'professors') {
  $email=$_POST['email'];
	$sqlP = "DELETE FROM professors WHERE Email='$email'";
	if (mysqli_query($conn, $sqlP)) {
		echo json_encode(array("statusCode"=>200));
	}
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
} else if ($table == 'research') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sqlR = "DELETE FROM research WHERE name='$name' and email='$email'";
   if (mysqli_query($conn, $sqlR)) {
     echo json_encode(array("statusCode"=>200));
   } else {
     echo json_encode(array("statusCode"=>201));
   }
}


?>
