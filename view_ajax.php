<?php
	include 'database.php';
	$sql = "SELECT * FROM professors";
    $result = $conn->query($sql);
    $query = "SELECT research.name AS Name, research.email AS Email, research.experience AS Experience, Description, Compensation FROM research left join professors on research.email = professors.email";
    $researchvalue = $conn->query($query); // We use this line within a While loop later on.
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?=$row['Name'];?></td>
            <td><?=$row['Discipline'];?></td>
            <td><?=$row['Expertise'];?></td>
        </tr>

        <?php
        $researchvalue = $conn->query($query);
        $headerCounter = 0;
        while ($entry = $researchvalue->fetch_assoc()) {
            if ($entry["Email"] == $row["Email"]) {
                if ($headerCounter++ == 0) {
        ?>
                <tr>
                <td colspan="3">
                    <table id="hidden">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Experience</th>
                            <th>Compensation</th>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td><=$entry['Name'];?></td>
                            <td><=$entry['Description'];?></td>
                            <td><=$entry['Experience'];?></td>
                            <td><=$entry['Compensation'];?></td>
                        </tr>

                    </table>
                </td>
                </tr>
                <?php

            }
        }
    }
}
else {
    echo "0 results";
}
mysqli_close($conn);
?>
