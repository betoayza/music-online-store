<?php

include './index.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $term = $_GET["term"];

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    $connection = mysqli_connect($server, $user, $pass, $db);

    if (!$connection)
        die("Connection error: " . mysqli_connect_error());
    else {
        $number = intval($term);
        $term = '%' . strtoupper($term) . '%';

        if ($number == 0) { // is not a number
            $query = "SELECT * FROM Customer WHERE UPPER(FirstName) LIKE ? OR UPPER(LastName) LIKE ? OR UPPER(Company) LIKE ? OR UPPER(Address) LIKE ? OR UPPER(City) LIKE ? OR UPPER(State) LIKE ? OR UPPER(Country) LIKE ? OR UPPER(PostalCode) LIKE ? OR UPPER(Phone) LIKE ? OR UPPER(Fax) LIKE ? OR UPPER (Email) LIKE ?";

            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "sssssssssss", $term, $term, $term, $term, $term, $term, $term, $term, $term, $term, $term);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

        } else {
            $query = "SELECT * FROM  Customer WHERE CustomerId=? OR SupportRepId=?";

            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "ii", $number, $number);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

        }
        if (!$result) {
            echo 'Hay un error en la consulta, checkear';
        } else {

            ?>
            <center class="mb-5 text-center"> <!-- VER PORQUE NO MUESTRA -->
                <?php
                echo "<h2>Customers</h2>";
                echo "<table class='table table-bordered'>";
                echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Company</th><th>Address</th><th>City</th><th>State</th><th>Country</th><th>Postal Code</th><th>Phone</th><th>Fax</th><th>Email</th><th>Support Rep ID</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row["CustomerId"] . "</td><td>" . $row["FirstName"] . "</td><td>" . $row["LastName"] . "</td> <td>" . $row["Company"] . "</td> <td>" . $row["Address"] . "</td> <td>" . $row["City"] . "</td> <td>" . $row["State"] . "</td> <td>" . $row["Country"] . "</td> <td>" . $row["PostalCode"] . "</td> <td>" . $row["Phone"] . "</td> <td>" . $row["Fax"] . "</td> <td>" . $row["Email"] . "</td> <td>" . $row["SupportRepId"] . "</td> </tr>";
                }
                echo "</table>";
                ?>
            </center>
            <?php
        }

    }
} else {
    echo 'Some error happened :(';
}

?>