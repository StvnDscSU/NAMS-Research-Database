<?php
// Database Connection setup beforehand.
include 'database.php';
// Query the Professor Table and sets up a query for the subtables.
$sql = "SELECT * FROM professors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $rowID = 0; // Links each row with each subtable by providing both elements with the same ID.
    while($row = $result->fetch_assoc()) {
        $rowID++;
        ?>
        <!-- Populates the main table with each professor's Name, Discipline, and Expertise -->
        <tr class="main" id="<?=$rowID;?>"> <!-- Class is main to distinguish styling between Professor rows and subtables -->
            <td><?=$row['Name'];?></td>
            <td><?=$row['Email'];?></td>
            <td><?=$row['Discipline'];?></td>
            <td><?=$row['Expertise'];?></td>
        </tr>
<?php
    }
}
else {
    echo "0 results";
}
mysqli_close($conn);
?>

<script src="script.js"></script>
