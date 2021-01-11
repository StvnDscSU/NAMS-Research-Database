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
  <!-- Introduction -->
  <!-- Heading Text, explaining the usage of this page to a new student -->
  <h2 class="page-title">Professor Research</h2>
  <hr>
  <p><span style="font-size: 14pt;">
  Welcome to the Professor Research Database!
  This page contains a list of professors partnered with the NAMS department
  to help students find research opportunities on campus.
  Stockton University offers students a vast selection of undergraduate research
  opportunities which spans over many fields. Stockton University believes in
  hands-on learning and encourages research to enrich one's learning process and
  prepare undergraduates for a post-graduate career. When research is combined
  with class work, students will fully grasp the concept of their field in terms
  of knowledge and experience.
  </span></p>
  <p><span style="font-size: 14pt;">
  <b>How does this page work?</b>
  To use this page, use the search bar below to search for specific terms,
  disciplines, or professors. When you find a professor with ongoing research,
  click on their name to view their research opportunities and copy their email.
  </span></p>
  <hr>

  <!-- LOGIN FUNCTION -->
  <form class="login" action = "" method = "post">
    <input type = "text" name = "username" class = "box" placeholder="Username"/>
    <input type = "password" name = "password" class = "box" placeholder="Password"/>
    <input type = "submit" value = " Administrator Login "/>
  </form>

  <!-- SEARCH FUNCTION -->
  <input class="search" type="text" id="search" placeholder="Search Subdiscipline">
  <select class="search" id="filterList" onchange="filterList()" class='form-control'>
    <option></option>
    <option>Mathematics</option>
    <option>Chemistry</option>
    <option>Physics</option>
  </select>
  <br><br>

	<table id="professor_table">
    <thead>
      <tr class="main_head">
          <th style="width:25%;">Name</th>
          <th style="width:20%;">Discipline</th>
          <th style="width:45%;">Subdiscipline</th>
          <th style="width:5%;">Openings</th>
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
