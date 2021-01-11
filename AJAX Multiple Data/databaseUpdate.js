<script src="script.js"></script>


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
    var table = $(this).attr('id');
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
          $('button.confirm.delete').removeAttr("disabled");
        }
      }
    });
  });
