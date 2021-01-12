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
  <form class="add" id='formProfessors' name='professors' method="post">
      <input style="width:20%;" type='text' name='Name' placeholder='Name' id='NameP'>
      <input style="width:23%;" type='email' name='Email' placeholder='Email' id='EmailP'>
      <input style="width:20%;" type='text' name='Discipline' placeholder='Discipline' id='DisciplineP'>
      <input style="width:35%;" type='text' name='Expertise' placeholder='Expertise' id='ExpertiseP'>
  </form>
  <button class="add" type="button" name="button" id="addProfessors" onclick="AddProfessors()">Add Professors</button>

  <table>
    <thead>
      <tr>
        <th style="width:15%;">Name</th>
        <th style="width:20%;">Email</th>
        <th style="width:15%;">Discipline</th>
        <th style="width:33%;">Expertise</th>
        <th style="width:12%;">Edit</th>
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
  <form style="width:100%" class="add" id='formResearch' name='professors' method="post">
      <input style="width:20%" type='text' name='Name' placeholder='Name' id='NameR'>
      <select style="width:20%" class='Email' name='Email' placeholder='Email' id='EmailR'>
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
      <input style="width:38%" type='text' name='Description' placeholder='Description' id='DescriptionR'>
      <input style="width:10%" type='text' name='Experience' placeholder='Experience' id='ExperienceR'>
      <input style="width:10%" type='text' name='Compensation' placeholder='Compensation' id='CompensationR'>
  </form>
  <button class="add" type="button" name="button" id="addResearch" onclick="AddResearch()">Add Research</button>


  <table>
    <thead>
      <tr>
        <th style="width:15%;">Name</th>
        <th style="width:15%;">Email</th>
        <th style="width:37%;">Description</th>
        <th style="width:10%;">Experience</th>
        <th style="width:10%;">Compensation</th>
        <th style="width:13%;">Edit</th>
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

<!-- user Tab -->
<div class="filterDiv users">
  <form class="add" id='formUser' name='professors' method="post">
      <input type='text' name='Username' placeholder='Username' id='Username'>
      <input type='text' name='Pin' placeholder='Pin' id='Pin'>
      <select name="AccessLevel" placeholder='Access Level' id='AccessLevel'>
        <option value="">Access Level</option>
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
  </form>
  <button class="add" type="button" name="button" id="addUser" onclick="AddUser()">Save User</button>

  <table>
    <thead>
      <tr>
        <th style="width:25%;">Username</th>
        <th style="width:25%;">Pin</th>
        <th style="width:25%;">Access Level</th>
        <th style="width:25%;">Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($resultU->num_rows > 0) {
          while($rowU = $resultU->fetch_assoc()) {
              $counter++;?>
              <tr id='<?=$counter?>'>
                  <td id='username'><?=$rowU['username'];?></td>
                  <td><?=$rowU['password'];?></td>

                  <td class='editable' id='accesslevelInfo'><?=$rowU['accesslevel'];?></td>
                  <td class='editable hide' id='accesslevel'>
                    <select class='editable hide' id='accessleveldropdownmenu'>
                      <option value="<?=$rowU['accesslevel'];?>"><?=$rowU['accesslevel'];?></option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                    </select>
                  </td>

                  <td>
                      <button type="button" id="user" class='delete active'>Delete</button>
                      <button type="button" id="user" class='confirm delete'>Confirm</button>

                      <button type="button" id="user" class='edit active'>Edit</button>
                      <button type="button" id="user" class='save'>Save</button>
                  </td>
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

</script>
