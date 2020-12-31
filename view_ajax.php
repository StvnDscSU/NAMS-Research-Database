<?php
	include 'database.php';
	//Query the Professor Table and sets up a query for the subtables.
	$sql = "SELECT * FROM professors";
    $result = $conn->query($sql);
    $query = "SELECT research.name AS Name, research.email AS Email, research.experience AS Experience, Description, Compensation FROM research left join professors on research.email = professors.email";
    $researchvalue = $conn->query($query); // We use this line within a While loop later on.
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <!-- Populates the main table with each professor's Name, Discipline, and Expertise -->
        <tr>
            <td><?=$row['Name'];?></td>
            <td><?=$row['Discipline'];?></td>
            <td><?=$row['Expertise'];?></td>
        </tr>

        <?php
        // Re-initializes $researchvalue for each professor.
        $researchvalue = $conn->query($query);
        /*
        headerCounter serves two purposes:
         1. Creates a block of code that only activates once when $headerCounter is 0,
            this includes initializing the subrow, the subtable, and creating the header for the table.
         2. If a professor has ongoing research, then a new table is created when creating the header. We need a way to
            close the table properly. If we end the table after inputing one row of information, then professors with
            multiple ongoing projects will have multiple tables. We only want one table, so we check to see if
            $headerCounter was incremented. If so, we close the table and rows properly.
        */
        $headerCounter = 0;
        while ($entry = $researchvalue->fetch_assoc()) { // Iterates through the Research data table
            if ($entry["Email"] == $row["Email"]) { // If a professor's name appears in both Professor and Research, create a subtable.
                if ($headerCounter++ == 0) { // Indicates that a subtable was created then increment the headerCounter.
        ?>
                <!-- Initialize the subtable and create the header -->
                <tr>
                <td colspan="3">
                    <table>
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
                </td>
                </tr>
                <?php
        }
    }
}
else {
    echo "0 results";
}
mysqli_close($conn);
?>
