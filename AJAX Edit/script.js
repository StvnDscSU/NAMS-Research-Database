$('button.edit').on('click', function() {
  var rowID = this.id;
  $('tr#'+rowID+' td').toggleClass('active');
});
