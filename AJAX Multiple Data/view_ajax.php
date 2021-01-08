<?php
// Database Connection setup beforehand.
include 'database.php';

$sqlP = "SELECT * FROM professors";
$resultP = $conn->query($sqlP);

$sqlR = "SELECT * FROM research";
$resultR = $conn->query($sqlR);

$sqlU = "SELECT * FROM user";
$resultU = $conn->query($sqlU);
?>

<!-- Professors Tab -->
<div class="filterDiv professors">
  <form id='formProfessors' name='professors' method="post">
      <input type='text' name='Name' placeholder='Name' id='Name'>
      <input type='email' name='Email' placeholder='Email' id='Email'>
      <input type='text' name='Discipline' placeholder='Discipline' id='Discipline'>
      <input type='text' name='Expertise' placeholder='Expertise' id='Expertise'>
  </form>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Discipline</th>
        <th>Expertise</th>
      </tr>
    </thead>
    <tbody>
<?php
if ($resultP->num_rows > 0) {
    while($rowP = $resultP->fetch_assoc()) {
        ?>
        <tr>
            <td><?=$rowP['Name'];?></td>
            <td><?=$rowP['Email'];?></td>
            <td><?=$rowP['Discipline'];?></td>
            <td><?=$rowP['Expertise'];?></td>
        </tr>
<?php
    }
}
?>

    </tbody>
  </table>
</div>

<!-- Research Tab -->
<div class="filterDiv research">
  <form id='formProfessors' name='professors' method="post">
      <input type='text' name='Name' placeholder='Name' id='Name'>
      <input type='email' name='Email' placeholder='Email' id='Email'>
      <input type='text' name='Description' placeholder='Description' id='Description'>
      <input type='text' name='Experience' placeholder='Experience' id='Experience'>
      <input type='text' name='Compensation' placeholder='Compensation' id='Compensation'>
  </form>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Description</th>
        <th>Experience</th>
        <th>Compensation</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($resultR->num_rows > 0) {
          while($rowR = $resultR->fetch_assoc()) {
              ?>
              <tr>
                  <td><?=$rowR['name'];?></td>
                  <td><?=$rowR['email'];?></td>
                  <td><?=$rowR['description'];?></td>
                  <td><?=$rowR['experience'];?></td>
                  <td><?=$rowR['compensation'];?></td>
              </tr>
      <?php
          }
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Users Tab -->
<div class="filterDiv users">
  <form id='formProfessors' name='professors' method="post">
      <input type='text' name='Username' placeholder='Username' id='Username'>
      <input type='text' name='Pin' placeholder='Pin' id='Pin'>
      <input type='text' name='accesslevel' placeholder='Access Level' id='accesslevel'>
  </form>

  <table>
    <thead>
      <tr>
        <th>Username</th>
        <th>Pin</th>
        <th>Access Level</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($resultU->num_rows > 0) {
          while($rowU = $resultU->fetch_assoc()) {
              ?>
              <tr>
                  <td><?=$rowU['username'];?></td>
                  <td><?=$rowU['password'];?></td>
                  <td><?=$rowU['accesslevel'];?></td>
              </tr>
      <?php
          }
      }
      mysqli_close($conn);
      ?>
    </tbody>
  </table>
</div>



<script src="script.js"></script>
<script>

</script>
