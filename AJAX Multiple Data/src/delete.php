<?php
include 'database.php';

// Check Table Type
$table = $_POST['table'];
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
  $sqlR = "DELETE FROM research WHERE name='$name' and email='$email'";
   if (mysqli_query($conn, $sqlR)) {
     echo json_encode(array("statusCode"=>200));
   } else {
     echo json_encode(array("statusCode"=>201));
   }
} else if ($table == 'user') {
  $username = $_POST['username'];
  $sql = "DELETE FROM user WHERE username = '$username'";

   if (mysqli_query($conn, $sql)) {
     echo json_encode(array("statusCode"=>200));
   }
   else {
     echo json_encode(array("statusCode"=>201));
   }
}


?>
