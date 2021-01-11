<html>
<body>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<!-- Determine the login user's access level. Access level is defaulted to -1 in case someone enters without logging in, 1 is for admin users, 2 is for assistants. -->
<?php
include 'database.php';
$accesslevel = -1;

session_start();
if(isset($_SESSION['login_user'])) {
  $query = "SELECT accesslevel FROM user WHERE username = '" . $_SESSION['login_user'] . "'";
  $temp = mysqli_query($conn, $query)->fetch_row();
  if($temp != null && $temp[0] != null)$accesslevel = $temp[0];
}

?>

<!-- Buttons to select specific table -->
<div id="button">
  <?php if($accesslevel == 1 || $accesslevel ==2) : ?>
  <button class="button act" onclick="changeTab('professors')">Professors</button> <!-- Buttons whose classes end in "act" will be highlighted. -->
  <button class="button dorm" onclick="changeTab('research')">Research</button> <!-- Buttons whose classes end in "dorm" will not be highlighted. -->
  <?php endif; ?>
  <?php if($accesslevel == 1) : ?>
  <button class="button dorm" onclick="changeTab('users')">Users</button> <!-- Button classes change upon clicking on a button. -->
  <?php endif; ?>
</div>
<br><br>

<div class="multi" id="multi">

</div>

<script>
changeTab('professors');
viewData();
</script>
</body>
</html>
