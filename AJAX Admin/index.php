<html>
<body>
<head>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<div class="container">
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
          <th>Expertise</th>
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
</html>
