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


/* EMAIL */
$(document).ready(function() {

	// Add class to mailto link
	// Needed to separate the disabling of the default action AND copy email to clipboard
	$('a[href^=mailto]').addClass('mailto-link');

	var mailto = $('.mailto-link');
	var messageCopy = 'Click to copy email address';
	var messageSuccess = 'Email address copied to clipboard';

	mailto.append('<span class="mailto-message"></span>');
	$('.mailto-message').append(messageCopy);

	// Disable opening your email client. yuk.
	$('a[href^=mailto]').click(function() {
		return false;
	})

	// On click, get href and remove 'mailto:' from value
	// Store email address in a variable.
	mailto.click(function() {
		var href = $(this).attr('href');
		var email = href.replace('mailto:', '');
		copyToClipboard(email);
		$('.mailto-message').empty().append(messageSuccess);
		setTimeout(function() {
			$('.mailto-message').empty().append(messageCopy);}, 2000);
	});

});

// Grabbed this from Stack Overflow.
// Copies the email variable to clipboard
function copyToClipboard(text) {
    var dummy = document.createElement("input");
    document.body.appendChild(dummy);
    dummy.setAttribute('value', text);
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
}
