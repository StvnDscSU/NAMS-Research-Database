<p> Text </ph>
<p class="multi" id="multi">

</p>

<script>

$.ajax({
  url: "echo.php",
  type: "POST",
  cache: false,
  success: function(data){
    $('#multi').html(data);
  }
});

</script>
