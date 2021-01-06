/** ANIMATION **/
$('tr.main').on('click', function() {
  var rowID = this.id;
  $('tr#'+rowID+'.hidden').toggleClass('active');
});

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
