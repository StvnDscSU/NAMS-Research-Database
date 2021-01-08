<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">

<div class="multi" id='multi'></div>

<script>
var myVar = "testext";

$.ajax({
  url: "echo.php",
  type: "POST",
  data:{"myData":myVar},
  cache: false,
  success: function(data){
    $('#multi').html(data);
  }
});
</script>

<script>
function viewData()
{
  var professors = "professors";
	$.ajax({
    url: "echo.php",
    type: "POST",
    data:{"myData":myVar},
		cache: false,
    success: function(data){
      $('#multi').html(data);
    }
	});
}
</script>
