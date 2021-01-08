
<?php
include 'database.php';

// Check Table Type
$table = $_POST['table'];

if ($table == 'professors') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $discipline = $_POST['discipline'];
  $expertise = $_POST['expertise'];
  $sql =
  "INSERT INTO professors (Name, Email, Discipline, Expertise)
   VALUES ('$name', '$email', '$discipline', '$expertise')";

   if (mysqli_query($conn, $sql)) {
     echo json_encode(array("statusCode"=>200));
   }
   else {
     echo json_encode(array("statusCode"=>201));
   }
}

?>
