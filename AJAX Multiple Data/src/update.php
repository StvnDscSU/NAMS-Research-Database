
<?php
include 'database.php';

// Check Table Type
$table = $_POST['table'];

if ($table == 'professors') {
  $email = $_POST['email'];
  $discipline = $_POST['discipline'];
  $expertise = $_POST['expertise'];
  $sql = "UPDATE professors SET Discipline = '$discipline', Expertise = '$expertise' WHERE Email = '$email'";

   if (mysqli_query($conn, $sql)) {
     echo json_encode(array("statusCode"=>200));
   }
   else {
     echo json_encode(array("statusCode"=>201));
   }
}

?>
