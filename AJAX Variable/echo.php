<?php
    $data = isset($_REQUEST['myData'])?$_REQUEST['myData']:"";
?>
<script>
function speak() {
  alert('<?php echo $data ?>');
}
speak();
</script>
