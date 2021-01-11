<!-- START THE SESSION -->
<!-- Paired with the login form. -->
<?php
session_start();

include 'database.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form

  $myusername = mysqli_real_escape_string($conn,$_POST['username']);
  $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

  $sql = "SELECT accesslevel FROM user WHERE username = '$myusername' and password = '$mypassword'";
  $user = $conn->query($sql);
  $row = mysqli_fetch_array($user,MYSQLI_ASSOC);

  $count = mysqli_num_rows($user);

  if($count == 1) {
    $_SESSION['login_user'] = $myusername;

    header("location: Admin/index.php?sessionid='" . session_id() . "'");
  } else {
    print("Your username or password is invalid.");
  }
}
?>

<html>
<div class="header-image"></div>
<body>
<head>
    <title>NAMS Professor Database</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<div class="content">
  <!-- LOGIN FUNCTION -->
  <form action = "" method = "post">
    <input type = "text" name = "username" class = "box" placeholder="Username"/>
    <input type = "password" name = "password" class = "box" placeholder="Password"/>
    <input type = "submit" value = " Administrator Login "/>
  </form>

  <!-- SEARCH FUNCTION -->
  <input type="text" id="search" placeholder="Type to search">
  <select id="filterList" onchange="filterList()" class='form-control'>
  <option></option>
  <option>Mathematics</option>
  <option>Chemistry</option>
  <option>Physics</option>
  </select>
  <br><br>

	<table id="professor_table">
    <thead>
      <tr class="main_head">
          <th>Name</th>
          <th>Discipline</th>
          <th>Subdiscipline</th>
          <th>Openings</th>
      </tr>
    </thead>
    <tbody id="table"> <!-- ID must be "table" due to Ajax view script -->

    </tbody>
  </table>
</div>
<script>
	$.ajax({
		url: "view_ajax.php",
		type: "POST",
		cache: false,
		success: function(data){
			$('#table').html(data);
		}
	});
</script>
</body>
<div class="footer-image"></div>
</html>
