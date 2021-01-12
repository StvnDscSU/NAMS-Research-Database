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

<html>
<div class="header-image"></div>
<body>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="script.js"></script>
</head>

<div class="content">
  <!-- Introduction -->
  <h2 class="page-title">Administrator Page</h2>
  <hr>
  <p><span style="font-size: 14pt;">
    Welcome to the administrator page! Please click one of the following tabs to begin
    editing professor information. If you would like to add a professor to the table,
    then first input a professor's email and add the email to the table.
    To edit or add research opportunities, click on the Research tab and follow the prompts.
    To add administrators, go to the Users page and add the account information to the tab.
    Users with Access Level 1 will have access to every page, whereas users with Access Level 2
    will only have access to Professors and Research.
  </span></p>
  <hr>
<!-- Buttons to select specific table -->
<div id="button">
  <?php if($accesslevel == 1 || $accesslevel ==2) : ?>
  <button class="button tab" onclick="changeTab('professors')">Professors</button> <!-- Buttons whose classes end in "act" will be highlighted. -->
  <button class="button tab" onclick="changeTab('research')">Research</button> <!-- Buttons whose classes end in "dorm" will not be highlighted. -->
  <?php endif; ?>
  <?php if($accesslevel == 1) : ?>
  <button class="button tab" onclick="changeTab('users')">Users</button> <!-- Button classes change upon clicking on a button. -->
  <?php endif; ?>
</div>
<br><br>

<div class="multi" id="multi">

</div>

<script>
changeTab('professors');
viewData();
</script>
</div>
</body>
<div class="footer-image"></div>
</html>
