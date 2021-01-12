<?php
include 'database.php';
// Check Table Type
$table = $_POST['table'];

if ($table == 'professors') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $discipline = $_POST['discipline'];
  $expertise = $_POST['expertise'];
  $sqlP =
  "INSERT INTO professors (Name, Email, Discipline, Expertise)
   VALUES ('$name', '$email', '$discipline', '$expertise')";

   if (mysqli_query($conn, $sqlP)) {
     echo json_encode(array("statusCode"=>200));
   } else {
     echo json_encode(array("statusCode"=>201));
   }
} else if ($table == 'research') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $description = $_POST['description'];
  $experience = $_POST['experience'];
  $compensation = $_POST['compensation'];
  $sqlR = "INSERT INTO research (name, email, description, experience, compensation)
   VALUES ('$name', '$email', '$description', '$experience', '$compensation')";

   if (mysqli_query($conn, $sqlR)) {
     echo json_encode(array("statusCode"=>200));
   } else {
     echo json_encode(array("statusCode"=>201));
   }
} else if ($table == 'user') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $accesslevel = $_POST['accesslevel'];
  $sqlR = "INSERT INTO user (username, password, accesslevel)
   VALUES ('$username', '$password', '$accesslevel')";

   if (mysqli_query($conn, $sqlR)) {
     echo json_encode(array("statusCode"=>200));
   } else {
     echo json_encode(array("statusCode"=>201));
   }
}

?>
