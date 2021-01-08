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
  <form id='formProfessors' name='professors' method="post">
      <input type='text' name='Name' placeholder='Name' id='NameP'>
      <input type='email' name='Email' placeholder='Email' id='EmailP'>
      <input type='text' name='Discipline' placeholder='Discipline' id='DisciplineP'>
      <input type='text' name='Expertise' placeholder='Expertise' id='ExpertiseP'>
  </form>
  <button type="button" name="button" id="addProfessors" onclick="AddProfessors()">Add Professors</button>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Discipline</th>
        <th>Expertise</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
<?php
$counter = 0;
if ($resultP->num_rows > 0) {
    while($rowP = $resultP->fetch_assoc()) {
        $counter++;?>
        <tr id='<?=$counter?>'>
            <td><?=$rowP['Name'];?></td>
            <td id='email'><?=$rowP['Email'];?></td>

            <td class='editable' id='disciplineInfo'><?=$rowP['Discipline'];?></td>
            <td class='editable hide' id='discipline'><input type="text" name="expertise" id='discipline' value="<?=$rowP['Discipline'];?>" required></td>

            <td class='editable' id='expertiseInfo'><?=$rowP['Expertise'];?></td>
            <td class='editable hide' id='expertise'><input type="text" name="expertise" id='expertise' value="<?=$rowP['Expertise'];?>" required></td>

            <td>
                <button type="button" id="professors" class='delete active'>Delete</button>
                <button type="button" id="professors" class='confirm delete'>Confirm</button>

                <button type="button" id="professors" class='edit active'>Edit</button>
                <button type="button" id="professors" class='save'>Save</button>
            </td>
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
  <form id='formResearch' name='professors' method="post">
      <input type='text' name='Name' placeholder='Name' id='NameR'>
      <select class='Email' name='Email' placeholder='Email' id='EmailR'>
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
      <input type='text' name='Description' placeholder='Description' id='DescriptionR'>
      <input type='text' name='Experience' placeholder='Experience' id='ExperienceR'>
      <input type='text' name='Compensation' placeholder='Compensation' id='CompensationR'>
  </form>
  <button type="button" name="button" id="addResearch" onclick="AddResearch()">Add Research</button>


  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Description</th>
        <th>Experience</th>
        <th>Compensation</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($resultR->num_rows > 0) {
          while($rowR = $resultR->fetch_assoc()) {
              $counter++;?>
              <tr id='<?=$counter?>'>
                  <td id='name'><?=$rowR['name'];?></td>
                  <td id='email'><?=$rowR['email'];?></td>


                  <td class='editable' id='descriptionInfo'><?=$rowR['description'];?></td>
                  <td class='editable hide' id='description'><input type="text" name="description" id='description' value="<?=$rowR['description'];?>" required></td>

                  <td class='editable' id='experienceInfo'><?=$rowR['experience'];?></td>
                  <td class='editable hide' id='experience'><input type="text" name="experience" id='experience' value="<?=$rowR['experience'];?>" required></td>

                  <td class='editable' id='compensationInfo'><?=$rowR['compensation'];?></td>
                  <td class='editable hide' id='compensation'><input type="text" name="compensation" id='compensation' value="<?=$rowR['compensation'];?>" required></td>


                  <td>
                      <button type="button" id="research" class='delete active'>Delete</button>
                      <button type="button" id="research" class='confirm delete'>Confirm</button>

                      <button type="button" id="research" class='edit active'>Edit</button>
                      <button type="button" id="research" class='save'>Save</button>
                  </td>
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
<script src='databaseUpdate.js'>

</script>
