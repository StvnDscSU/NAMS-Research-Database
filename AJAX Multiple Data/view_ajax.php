<script src="script.js"></script>
<?php
// Database Connection setup beforehand.
include 'database.php';

$sqlP = "SELECT * FROM professors";
$resultP = $conn->query($sqlP);

$sqlR = "SELECT * FROM research";
$resultR = $conn->query($sqlR);
// Forces administrator to use a valid email from an existing professor.
$sqlEmailR = "SELECT DISTINCT Email FROM professors";
$emailListR = $conn->query($sqlEmailR);

$sqlU = "SELECT * FROM user";
$resultU = $conn->query($sqlU);
?>
<!-- Professors Tab -->
<div class="filterDiv professors">
<!-- Success Test
  <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
    <p>Hello there!</p>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
-->
  </div>
  <form id='formProfessors' name='professors' method="post">
      <input type='text' name='Name' placeholder='Name' id='Name'>
      <input type='email' name='Email' placeholder='Email' id='Email'>
      <input type='text' name='Discipline' placeholder='Discipline' id='Discipline'>
      <input type='text' name='Expertise' placeholder='Expertise' id='Expertise'>
  </form>
  <button type="button" name="button" id="addProfessors" onclick="AddProfessors()">Add Professors</button>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Discipline</th>
        <th>Expertise</th>
        <th></th>
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
            <td class="delete" id='<?=$rowP['Email'];?>'><?=$rowP['Email'];?></td>
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

      <select class='Email' name='Email' placeholder='Email' id='Email'>
        <option value="">Email</option>
        <?php
        if ($emailListR->num_rows > 0) {
          while($entryP = $emailListR->fetch_assoc()) {
            ?>
            <option value="<?=$entryP['Email'];?>"><?=$entryP['Email'];?></option>
            <?php
          }
        }
        ?>
      </select>

      <input type='text' name='Description' placeholder='Description' id='Description'>
      <input type='text' name='Experience' placeholder='Experience' id='Experience'>
      <input type='text' name='Compensation' placeholder='Compensation' id='Compensation'>
  </form>
  <button type="button" name="button" id="saveResearch">Save to Database</button>

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
  <button type="button" name="button" id="saveUsers">Save to Database</button>

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


<!-- We pass a variable to indicate the tab we want Ajax to select when refreshing the table. -->
<!-- We call the table in here because if we select the tab in index.php, the table fails to load -->
<!-- In time before the tab is selected. When the tab is selected, it fails to update the table. -->
<!-- This is mainly an issue when the table needs updating, such as when the user first loads the page. -->
<!-- Otherwise, we can directly call filterButton() instead of passing the variable to here. -->
<?php $tab = isset($_REQUEST['tabChoice'])?$_REQUEST['tabChoice']:""; ?>
<script>filterButton('<?php echo $tab ?>');</script>
