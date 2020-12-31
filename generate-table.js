function displayMath(){
  document.write(5 + 6);
}

function appendEnd(){
  // Reference to the table body
  var tbodyRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];

  // Append a row to the tbody section
  var newRow = tbodyRef.insertRow();

  // Insert cell within the new row
  var newCell1 = newRow.insertCell();
  var newCell2 = newRow.insertCell();

  // Add text to the cell
  var newText = document.createTextNode('AAAAA');
  newCell1.appendChild(newText);

  newText = document.createTextNode('BBBBB');
  newCell2.appendChild(newText);
}
