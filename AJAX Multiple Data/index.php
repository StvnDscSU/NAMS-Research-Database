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
  <button class="button act" onclick="changeTab('professors')">Professors</button> <!-- Buttons whose classes end in "act" will be highlighted. -->
  <button class="button dorm" onclick="changeTab('research')">Research</button> <!-- Buttons whose classes end in "dorm" will not be highlighted. -->
  <button class="button dorm" onclick="changeTab('users')">Users</button> <!-- Button classes change upon clicking on a button. -->
</div>
		<input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
<br>
<button class="button dorm" onclick="viewData()">Update View</button> <!-- Button classes change upon clicking on a button. -->

<div class="multi" id="multi">

</div>



<script>
var myVar = "professors";
function changeTab(tab) {
  myVar = tab;
  filterButton(tab)
}

viewData();
function viewData()
{
	$.ajax({
		url: "view_ajax.php",
		type: "POST",
    data:{"tabChoice":myVar},
		cache: false,
		success: function(data){
			$('#multi').html(data);
		}
	});
}



</script>
<script src="script.js"></script>
</body>
</html>