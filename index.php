<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Ajax</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
  <h2>View data</h2>
	<table class="table table-bordered table-sm" >
    <thead>
      <tr>
          <th>Name</th>
          <th>Discipline</th>
          <th>Expertise</th>
      </tr>
    </thead>
    <tbody id="table">

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
