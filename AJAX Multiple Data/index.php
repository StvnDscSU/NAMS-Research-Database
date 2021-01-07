<html>
<body>
<head>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<!-- Buttons to select specific table -->
<div id="button">
  <button class="button act" onclick="filterButton('professors')">Professors</button> <!-- Buttons whose classes end in "act" will be highlighted. -->
  <button class="button dorm" onclick="filterButton('research')">Research</button> <!-- Buttons whose classes end in "dorm" will not be highlighted. -->
  <button class="button dorm" onclick="filterButton('users')">Users</button> <!-- Button classes change upon clicking on a button. -->
</div>
<br>
<div class="multi" id="multi">

</div>

<script>
	$.ajax({
		url: "view_ajax.php",
		type: "POST",
		cache: false,
		success: function(data){
			$('#multi').html(data);
		}
	});
</script>
</body>
</html>
