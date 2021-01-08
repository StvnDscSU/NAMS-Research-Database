function changeTab(tab) {
  myVar = tab;
  filterButton(tab)
}

function viewData() {
	$.ajax({
		url: "view_ajax.php",
		type: "POST",
    data:{"tabChoice":myVar},
		cache: false,
		success: function(data) {
			$('#multi').html(data);
		}
	});
}

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

/*** TABLE AUGMENTATIONS ***/


/* Table Add */
function AddProfessors() {
    $("#addProfessors").attr("disabled", "disabled");
    var table = 'professors';
    var name = $('#NameP').val();
    var email = $('#EmailP').val();
    var discipline = $('#DisciplineP').val();
    var expertise = $('#ExpertiseP').val();

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

function AddResearch() {
  $("#addResearch").attr("disabled", "disabled");
  var table = 'research';
  var name = $('#NameR').val();
  var email = $('#EmailR').val();
  var description = $('#DescriptionR').val();
  var experience = $('#ExperienceR').val();
  var compensation = $('#CompensationR').val();
  console.log('Provided Variables:\nname: ' + name + '\nemail: ' + email + '\ndiscipline: ' + description + '\nexperience: ' + experience + '\ncompensation: ' + compensation);

  if(name!="" && email!="" && description!="" && experience!="") {
    $.ajax({
      url: "src/add.php",
      type: "POST",
      data: {
        table: table,
        name: name,
        email: email,
        description: description,
        experience: experience,
        compensation: compensation
      },
      cache: false,
      success: function(dataResult) {
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200) {
          $('#formResearch').find('input:text').val('');
          viewData();
          //$("#success").show();
          //$('#success').html('Data added successfully!');
        }
        else if(dataResult.statusCode==201) {
          alert("Query Error! Please Make sure no duplicate entries were input.");
        }
        $("#addResearch").removeAttr("disabled");
      }
    });
  }
  else{
    alert('Please fill in every field!');
    $("#addResearch").removeAttr("disabled");
  }
}

function AddUser() {

}

/* Table Delete */
  $(document).on("click", ".confirm.delete", function() {
    var table = 'professors';
    var row = $(this).parent().parent();
    var rowID = $(this).parent().parent().attr('id');
    var email = $(this).parent().parent().find("#email").html();
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
          $('button#'+rowID+'.confirm.delete').removeAttr("disabled");
        }
      }
    });
  });

/* Buttons */
$('button.delete').on('click', function() {
  var rowID = $(this).parent().parent().attr('id');
  $('tr#'+rowID+' button.delete').toggleClass('active', false);
  $('tr#'+rowID+' button.confirm.delete').toggleClass('active', true);
});

$('button.edit').on('click', function() {
  var rowID = $(this).parent().parent().attr('id');
  editButton(rowID);
});

$('button.save').on('click', function() {
  var rowID = $(this).parent().parent().attr('id');
  $('tr#'+rowID+' button.save').attr("disabled", "disabled");
  identifyRow(rowID);
  SaveProfessors(this);
});

var press = 0;
function editButton(rowID) {
  //alert(++press);
  $('tr#'+rowID+' td.editable').toggleClass('hide');

  $('tr#'+rowID+' button.edit').toggleClass('active');
  $('tr#'+rowID+' button.save').toggleClass('active');
}

/* Identifier */
function identifyRow(rowID) {
  $('.identify').toggleClass('identify', false);
  $('tr#'+ rowID).toggleClass('identify');
}

/* Table Edit */
// Professors

function SaveProfessors (thisObj) {
  var rowID = $(thisObj).parent().parent().attr('id');
  var table = 'professors';
  var email = $(thisObj).parent().parent().find("#email").html();
  var discipline = $(thisObj).parent().parent().find("#discipline").find('input').val();
  var expertise = $(thisObj).parent().parent().find("#expertise").find('input').val();
  //alert('Pre: Looking to change row "' + rowID + '" with the following information:\nDiscipline: ' + discipline + '\nExpertise: ' + expertise);


  $.ajax({
    url: "src/update.php",
    type: "POST",
    data: {
      table: table,
      email: email,
      discipline: discipline,
      expertise: expertise
    },
    cache: false,
    success: function(dataResult) {
      var dataResult = JSON.parse(dataResult);
      if(dataResult.statusCode==200) {
        $('tr#'+rowID+' button.save').removeAttr("disabled");
        editButton(rowID);

        $('.locate').toggleClass('locate', false);
        $('.identify td#disciplineInfo').toggleClass('locate');
        $('.identify td#expertiseInfo').toggleClass('locate');
        console.log('tr#' + rowID + ' td#disciplineInfo');

        $('.identify td#disciplineInfo').html(discipline);
        $('.identify td#expertiseInfo').html(expertise);
        //$("#success").show();
        //$('#success').html('Data added successfully!');
      }
      else if(dataResult.statusCode==201) {
        alert("Query Error!");
        $('tr#'+rowID+' button.save').removeAttr("disabled");
      }
    }
  });

};
