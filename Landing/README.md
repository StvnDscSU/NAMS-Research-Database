# Professor Research Database

The Professor Research Database is a way to display research opportunities into a single page. The issue with the current way students look up professors is that all the professors are divided into different pages based on discipline. On top of that, the information for each professor is further divided into each professor's page. It is difficult to look up keywords among different professors as students must open up multiple pages to view one professor. This database page aims to bring all of that information into one page and find a way to make a "bulletin board" system for professors to display research opportunities they have to offer students.


## The Mock Website

The purpose of this project is to come up with a model to integrate into the Stockton Website. We use the Stockton Headers and Stockton Footer to help the client understand how it would feel when implemented into the website. Furthermore, the website is hosted on an unaffiliated machine. The website, hosted at [http://142.93.9.126/](http://142.93.9.126/), serves as a vessel for the content of this project. Since the client wishes to have the project implemented into the website, there is no software to download to access the tables or make changes to the table.

![Mock Website](https://i.imgur.com/taSVFhU.png)


## The Professor Table

The professor table's special feature is that it can search for information in the professors row and display subtables upon clicking on a professor's row.
![alt text](https://i.imgur.com/URa3xN5.gif)

### The Search Bar
The search bar function operates in two parts: It looks for an input from the search bar with the id "search" as well as the dropdown "filterList" and compares the inputs to each row to see if the row is not valid. The function to hide the rows is repeated twice, hiding the rows based on Subdiscipline and once again based on the dropdown menu. The logic for the code goes as follows: 1. Show all rows, 2. checks for each row, 3. while checking, hide any subtable where the ID is the same as the main row, 4. hides the main row based on the input, then repeats steps 2-4 based on the dropdown menu.
```js
/* DROP-DOWN FILTER */

function filterList() {
  // Since filtering the table relies on the input field, simulates a keystroke
  // in the input field to activate the filter function.
  $('#search').keyup();
}

/* SEARCH FUNCTION */
// Initializes the rows of professor_table
var $rows = $('#professor_table tr.main');

// Listens for keystrokes in the #search input field
$('#search').keyup(function() {
    var val = $.trim($(this).val()).toLowerCase();
    // Show all the rows. Hide rows based on filter.
    $rows.show();

    // Apply Text Filter
    $rows.filter(function() {
      // Initialize Variable - Use Row - Specify third column - Convert to text - Lowercase
      var text = $(this).find('td').eq(2).text().toLowerCase();
      var filtered = !~text.indexOf(val);
      var rowID = this.id;

      // Follows the same logic of the main row, shows every subtable then hide if filter applies.
      $('tr#'+rowID+'.hidden').show();
      if (filtered) {$('tr#'+rowID+'.hidden').hide();}
      return filtered;
    }).hide();

    // Apply Dropdown filter. Grabs value from dropdown list.
    val = document.getElementById('filterList').value.toLowerCase();
    // Apply the same method from the previous block with one line change.
    $rows.filter(function() {
      var text = $(this).find('td').eq(1).text().toLowerCase();
      var filtered = !~text.indexOf(val);
      var rowID = this.id;

      // Does not show the hidden rows as it was done in the previous code block
      if (filtered) {$('tr#'+rowID+'.hidden').hide();}
      return filtered;
    }).hide();
});
```

### Subtables
The subtables are the tables that appear when you click on a row with open research information. Let us consider this following table using the HTML implementation rather than php implementation:
![Test Professor Table HTML](https://i.imgur.com/RKWF24D.gif)
```css
tr.hidden td div {
  max-height: 0;
  box-sizing: border-box;
  overflow: hidden;
  transition: max-height 0.6s, padding 0.3s;
}
tr.hidden.active td div {
  max-height: 800px;
  padding: 10px 10px;
  transition: max-height 2.2s, padding 0.6s;
}
```
The Table transition depends on switching css for its display. When you give a hidden row the "active" class, the div container makes an opening transition. However, as of now, the .active css must include a max-height. Setting a higher height causes the transition to move faster, even if there is no content to fill the full height. Setting a lower max-height causes some subtables with more rows or height to be cut off earlier on. To make the changes to the class, we use JQuery to detect the click and toggle the necessary class.
```javascript
/** ANIMATION **/
$('tr.main').on('click', function() {
  var rowID = this.id;
  $('tr#'+rowID+'.hidden').toggleClass('active');
});
```



#### Base HTML
The main page is composed of two main php pages: index.php and view_ajax.php. The main page merely calls view_ajax.php to add content to the table shown below. view_ajax.php contains the main table creation for the page, adding content to the following table:
```html
<table id="professor_table">
    <thead>
      <tr class="main_head">
          <th style="width:25%;">Name</th>
          <th style="width:20%;">Discipline</th>
          <th style="width:45%;">Subdiscipline</th>
          <th style="width:5%;">Openings</th>
      </tr>
    </thead>
    <tbody id="table"> <!-- ID must be "table" due to Ajax view script -->

    </tbody>
</table>
```
### View_Ajax.php
view_ajax.php contains the table creation. It has a database connection file called database.php, which establishes the connection to the database.\
view_ajax.php makes two calls to the database: one for each professor's information, and another for ongoing research, which is linked to the professor table. A variable `$rowID` is created to give each professor an identifying ID, which helps us link subtables that holds research information to the correct professor. We first create a simple row with the following format for the 13th row:
```html
 <tr class="13">
     <td>NAME</tr>
     <td>DISCIPLINE</tr>
     <td>SUBDISCIPLINE</tr>
     <td>OPENINGS</tr>
 </tr>
```
We then check to see if the row's professor's email exists in the research table. If so, we initialize the subtable with the following code:
```html

        <!--
        headerCounter serves two purposes:
         1. Creates a block of code that only activates once when $headerCounter is 0,
            this includes initializing the subrow, the subtable, and creating the header for the table.
         2. If a professor has ongoing research, then a new table is created when creating the header. We need a way to
            close the table properly. If we end the table after inputing one row of information, then professors with
            multiple ongoing projects will have multiple tables. We only want one table, so we check to see if
            $headerCounter was incremented. If so, we close the table and rows properly.

                <?php        -->
        $headerCounter = 0;
        while ($entry = $researchvalue->fetch_assoc()) { // Iterates through the Research data table
            if ($entry["Email"] == $row["Email"]) { // If a professor's name appears in both Professor and Research, create a subtable.
                if ($headerCounter++ == 0) { // Indicates that a subtable was created then increment the headerCounter.
?>
		<!-- SUBTABALE START -->
                <!-- Initialize the subtable and create the header -->
                <tr class="hidden" id="<?=$rowID;?>">
                <td colspan="4" class="hidden">
                  <div>
                    <table class="hidden">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Experience</th>
                            <th>Compensation</th>
                        </tr>
                        <?php } // Closes the header and the one-time code block ?>
                        <!-- Inputs the appropriate information in the subtable. -->
                        <tr>
                            <td><?=$entry['Name'];?></td>
                            <td><?=$entry['Description'];?></td>
                            <td><?=$entry['Experience'];?></td>
                            <td><?=$entry['Compensation'];?></td>
                        </tr>
            <?php
            }
        }
        if ($headerCounter != 0) { // If the subtable was initialized, then close the subtable.
        ?>
                    </table>
                  </div>
                </td>
                </tr>
                <?php
        }
?>
```
We first create the header. We use headerCounter to prevent us from creating the header multiple times. After each iteration, we simply execute the following block:
```html
                        <!-- Inputs the appropriate information in the subtable. -->
                        <tr>
                            <td><?=$entry['Name'];?></td>
                            <td><?=$entry['Description'];?></td>
                            <td><?=$entry['Experience'];?></td>
                            <td><?=$entry['Compensation'];?></td>
                        </tr>
```
Finally, once the hidden row is finished looping, we check to see if $headerCounter was iterated, which means that the hidden table was initialized. We close this table properly here.

## The Admin Page
The admin page is an additional feature for the Client. After talking to the school IT, it became apparent that they would be augmenting the security features to their guide lines. However, we wanted to offer our client a way to change the information in the main page and visualize the ideas our client had for her model website.
![Multiple Tabs](https://i.imgur.com/FzYEJN3.gif)

### Multi-Table Changes
The multiple tab works on utilizing div classes to house different pages and an `onclick` function to filter tables. The HTML follows the format:
```html
<!-- Buttons to select specific table -->
<div id="button">
  <button class="button act" onclick="filterButton('professors')">Professors</button> <!-- Buttons whose classes end in "act" will be highlighted. -->
  <button class="button dorm" onclick="filterButton('research')">Research</button> <!-- Buttons whose classes end in "dorm" will not be highlighted. -->
  <button class="button dorm" onclick="filterButton('users')">Users</button> <!-- Button classes change upon clicking on a button. -->
</div>
<br>

<!-- Use the Div Classes to hide and display one table at a time -->
<div id="button">
  <?php if($accesslevel == 1 || $accesslevel ==2) : ?>
  <button class="button tab" onclick="changeTab('professors')">Professors</button> <!-- Buttons whose classes end in "act" will be highlighted. -->
  <button class="button tab" onclick="changeTab('research')">Research</button> <!-- Buttons whose classes end in "dorm" will not be highlighted. -->
  <?php endif; ?>
  <?php if($accesslevel == 1) : ?>
  <button class="button tab" onclick="changeTab('users')">Users</button> <!-- Button classes change upon clicking on a button. -->
  <?php endif; ?>
</div>
<br><br>

<div class="multi" id="multi">
</div>
```
Once again, we utilize a separate Ajax script to handle the SQL queries and add content to the page. Specific buttons are only accessible when logged in certain accounts, which can be added by the admin. The feature is currently there as a way to showcase the login function and is not meant to be part of the final model if implemented into the website.

The Java script is broken into three parts: Displaying the div elements, augmenting the display to "Show", and removing the class "Show" from the div containers that were not clicked. There is an additional fourth class that changes each button's class to the correct class based on a click.
```js
function filterButton(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
  }
}

// Show filtered elements
function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current control button (highlight it)
var buttonContainer = document.getElementById("button");
var buttons = buttonContainer.getElementsByClassName("button");
for (var i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("act");
    current[0].className = current[0].className.replace(" act", "");
    this.className += " act";
  });
}
```

## Admin View_Ajax.php
The content for the table generally follows the same idea as the main row in the first page, except it is slightly modified to allow editing of the table. First, let us talk about how the SQL events. We will follow the first tab, formProfessor, for the rest of the code.

### Admin Add.php
To add professors to the database, we allow the client to input information into a form, which a button will send into a javascript function that will add the information into the database. The combined elements are as follows:
```html
  <form class="add" id='formProfessors' name='professors' method="post">
      <input style="width:20%;" type='text' name='Name' placeholder='Name' id='NameP'>
      <input style="width:23%;" type='email' name='Email' placeholder='Email' id='EmailP'>
      <input style="width:20%;" type='text' name='Discipline' placeholder='Discipline' id='DisciplineP'>
      <input style="width:35%;" type='text' name='Expertise' placeholder='Expertise' id='ExpertiseP'>
  </form>
  <button class="add" type="button" name="button" id="addProfessors" onclick="AddProfessors()">Add Professors</button>
```
The AddProfessors() function is called, which exhibits the following code:
```javascript
/* Table Add */
//Professors
function AddProfessors() {
    $("#addProfessors").attr("disabled", "disabled");
    var table = 'professors';
    var name = $('#NameP').val();
    var email = $('#EmailP').val();
    var discipline = $('#DisciplineP').val();
    var expertise = $('#ExpertiseP').val();
```
When the function is called, we look for the specific input elements that house the information of the input. Each input box has a unique ID, which we can use to collect information directly. Each entry must have a name, email, and discipline attached. Now we post the information through AJAX.
```javascript
    if(name!="" && email!="" && discipline!="" && expertise!="") {
      $.ajax({
        url: "src/add.php",
        type: "POST",
        data: {
          table: table,
          name: name,
          email: email,
          discipline: discipline,
          expertise: expertise
        },
        cache: false,
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200) {
            $('#formProfessors').find('input:text').val('');
            viewData();
            //$("#success").show();
            //$('#success').html('Data added successfully!');
          }
          else if(dataResult.statusCode==201) {
            alert("Query Error! Please Make sure no duplicate entries were input.");
          }
          $("#addProfessors").removeAttr("disabled");
        }
      });
    }
    else{
      alert('Please fill in every field!');
      $("#addProfessors").removeAttr("disabled");
    }
}
```
Here, we are presented two scenarios when we post the information through AJAX. Either the query is a success, which will add the information to the database and update the table display, or there is an error with the query, which will notify the user and do nothing. In both scenarios, the Add button is disabled to prevent spamming and then enabled at the end to allow for usage once more. Let us follow the add.php code.
```html
<?php
include 'database.php';
// Check Table Type
$table = $_POST['table'];

if ($table == 'professors') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $discipline = $_POST['discipline'];
  $expertise = $_POST['expertise'];
  $sqlP =
  "INSERT INTO professors (Name, Email, Discipline, Expertise)
   VALUES ('$name', '$email', '$discipline', '$expertise')";

   if (mysqli_query($conn, $sqlP)) {
     echo json_encode(array("statusCode"=>200));
   } else {
     echo json_encode(array("statusCode"=>201));
   }
}
```
The code is simple here. First, we check to see where the information is coming from. In this case, the information comes from the table 'professors'. Next, we read the variables from the function call. Then, we use SQL to input the information into the database. Finally, we output a code depending whether the SQL was a success.

### Admin Delete.php
Next, let us focus on deleting users from the table. To begin, note that we have a button that switches messages to confirm a deletion or start/end an edit.\
![alt text](https://i.imgur.com/HuMAA6A.gif)

We have the following events for the buttons:
```javascript
$('button.delete').on('click', function() {
  var rowID = $(this).parent().parent().attr('id');
  $('tr#'+rowID+' button.delete').toggleClass('active', false);
  $('tr#'+rowID+' button.confirm.delete').toggleClass('active', true);
});
```
When the first delete button is clicked, we hide the Delete button and display the Confirm-Delete button.
```javascript
// Use this code block to prevent AJAX from calling the Delete function multiple times after updating the table.
$('.confirm.delete').off('click').on('click', check);
function check() {
  $('.confirm.delete').off('click'); // Disable button, prevent more calls
  var table = $(this).attr('id');
  if (table == 'professors') {
    DeleteProfessor($(this));
  } else if (table == 'research') {
    DeleteResearch($(this));
  } else if (table == 'user') {
    DeleteUser($(this));
  }
  $('.confirm.delete').on('click', check); // enable the button
}
```
When pressed again, disable the button and send the information to the appropriate AJAX function to make sure no AJAX call is called multiple times. Since the calls are async, we want to disable the button immediately and enable the button only after the database returns its verdict.
```javascript
// Professors
function DeleteProfessor(thisObj) {
    var table = $(thisObj).attr('id');
    var row = $(thisObj).parent().parent();
    var rowID = $(thisObj).parent().parent().attr('id');
    var email = $(thisObj).parent().parent().find("#email").html();
    $('tr#'+rowID+' button.confirm.delete').attr("disabled", "disabled");

    $.ajax({
      url: "src/delete.php",
      type: "POST",
      cache: false,
      data:{
        table: table,
        email: email
      },
      success: function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200){
          //row.fadeOut();
          row.remove();
        }
        else {
          alert('There was an error removing the selected entry.')
          $('button.confirm.delete').removeAttr("disabled");
        }
      }
    });
  }
```
The delete function follows the same format as the Add function in Delete.php.

### Admin Delete.php
To begin, we follow the similar format for the button as the Delete button.

We have the following events for the buttons:
```javascript// Edit Button
$('button.edit').on('click', function() {
  var rowID = $(this).parent().parent().attr('id');
  editButton(rowID);
});

$('button.save').on('click', function() {
  var rowID = $(this).parent().parent().attr('id');
  var table = $(this).attr('id');
  $('tr#'+rowID+' button.save').attr("disabled", "disabled");
  identifyRow(rowID);
  if (table == 'professors') {
    SaveProfessors(this);
  } else if (table == 'research') {
    SaveResearch(this);
  } else if (table == 'user') {
    SaveUser(this);
  }
});

function editButton(rowID) {
  $('tr#'+rowID+' td.editable').toggleClass('hide');

  $('tr#'+rowID+' button.edit').toggleClass('active');
  $('tr#'+rowID+' button.save').toggleClass('active');
}
```
We also reference the Ajax function after clicking the save function, but we will not go into that step as we have looked at it twice at this point. Instead, let us look at how we make the edits:
![alt text](https://i.imgur.com/PcXt6vH.gif) \
To do this, we must make some augmentations to the cells we want to edit: make two cells per editable cell, half shown, half hidden. The hidden cells are linked to the Edit button. If the Edit button is in default, then the row is not editable. Once the button is clicked, the input box is displayed. Here, we have the two editable cells from the gif above.
```html
<td class='editable' id='disciplineInfo'><?=$rowP['Discipline'];?></td>
<td class='editable hide' id='discipline'><input type="text" name="expertise" id='discipline' value="<?=$rowP['Discipline'];?>" required></td>

<td class='editable' id='expertiseInfo'><?=$rowP['Expertise'];?></td>
<td class='editable hide' id='expertise'><input type="text" name="expertise" id='expertise' value="<?=$rowP['Expertise'];?>" required></td>
```
Whenever the row has the class 'hide', the row is hidden. To change the class, we simply use the following jquery:
```javascript
function editButton(rowID) {
  $('tr#'+rowID+' td.editable').toggleClass('hide');

  $('tr#'+rowID+' button.edit').toggleClass('active');
  $('tr#'+rowID+' button.save').toggleClass('active');
}
```
To locate the proper information, we simply look for the elements from the button's position in the HTML doc.
```javascript
  var email = $(thisObj).parent().parent().find("#email").html();
  var discipline = $(thisObj).parent().parent().find("#discipline").find('input').val();
  var expertise = $(thisObj).parent().parent().find("#expertise").find('input').val();
```
Finally, instead of refreshing the table, we simply change the rows client-side when successful rather than requesting the information from the server.
```javascript
        $('.locate').toggleClass('locate', false);
        $('.identify td#disciplineInfo').toggleClass('locate');
        $('.identify td#expertiseInfo').toggleClass('locate');

        $('.identify td#disciplineInfo').html(discipline);
        $('.identify td#expertiseInfo').html(expertise);
```
.identify helps us identify certain rows. To identify, we simply use the row's ID and change the class according to the following:
```javascript
function identifyRow(rowID) {
  $('.identify').toggleClass('identify', false);
  $('tr#'+ rowID).toggleClass('identify');
}
```
