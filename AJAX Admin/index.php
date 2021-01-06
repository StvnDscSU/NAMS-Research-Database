<html>
<body>
<head>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

  <div id="button">
  <!-- BUTTONS -->
  <button class="button act" onclick="filterButton('professors')">Professors</button> <!-- Buttons whose classes end in "act" will be highlighted. -->
    <button class="button dorm" onclick="filterButton('research')">Research</button> <!-- Buttons whose classes end in "dorm" will not be highlighted. -->
    <button class="button dorm" onclick="filterButton('users')">Users</button> <!-- Button classes change upon clicking on a button. -->
  </div>
  <br><br>


  <!-- Use the Div Classes to hide and display one table at a time -->
  <div class="container">

    <div class="filterDiv professors">
      <table id="professor_table">
        <thead>
          <tr class="main_head">
            <th>Name</th>
            <th>Email</th>
            <th>Discipline</th>
            <th>Expertise</th>
          </tr>
        </thead>
        <tbody id="professor"> <!-- ID must be "table" due to Ajax view script -->

        </tbody>
      </table>
    </div>

    <div class="filterDiv research">
      <table id="research_table">
        <thead>
          <tr class="main_head">
            <th>Name</th>
            <th>Email</th>
            <th>Description</th>
            <th>Compensation</th>
          </tr>
        </thead>
        <tbody id="research"> <!-- ID must be "table" due to Ajax view script -->

        </tbody>
      </table>
    </div>
    <div class="filterDiv users">
      <table id="user_table">
        <thead>
          <tr class="main_head">
            <th>Username</th>
            <th>Password</th>
            <th>Security Access Level</th>
          </tr>
        </thead>
        <tbody id="user"> <!-- ID must be "table" due to Ajax view script -->

        </tbody>
      </table>
    </div>
  </div>

<script>
</script>

<script>
	$.ajax({
		url: "view_ajax.php",
		type: "POST",
		cache: false,
		success: function(data){
			$('#professor').html(data);
		}
	});
</script>
</body>
</html>
