
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
} else if ($table == 'research') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $description = $_POST['description'];
  $experience = $_POST['experience'];
  $compensation = $_POST['compensation'];
  $sql = "UPDATE research SET description = '$description', experience = '$experience', compensation = '$compensation' WHERE Email = '$email'";

   if (mysqli_query($conn, $sql)) {
     echo json_encode(array("statusCode"=>200));
   }
   else {
     echo json_encode(array("statusCode"=>201));
   }
} else if ($table == 'user') {
  $username = $_POST['username'];
  $accesslevel = $_POST['accesslevel'];
  $sql = "UPDATE user SET accesslevel = '$accesslevel' WHERE username = '$username'";

   if (mysqli_query($conn, $sql)) {
     echo json_encode(array("statusCode"=>200));
   }
   else {
     echo json_encode(array("statusCode"=>201));
   }
}

?>
