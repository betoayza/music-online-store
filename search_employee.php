<?php

include './index.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $term = $_GET["term"];

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);

        if (!$connection)
            echo 'Conection error: ' . mysqli_connect_error();
        else {
            // 2 casos: es un nro o un string
            $number = intval($term);

            if ($number == 0) {
                $term = '%' . strtoupper($term) . '%';
                $query = "SELECT * FROM Employee WHERE UPPER(FirstName) LIKE ? OR UPPER(LastName) LIKE ? OR UPPER(Title) LIKE ? OR UPPER(ReportsTo) LIKE ? OR UPPER(BirthDate) LIKE ? OR UPPER(HireDate) LIKE ? OR UPPER(Address) LIKE ? OR UPPER(City) LIKE ? OR UPPER(State) LIKE ? OR UPPER(Country) LIKE ? OR UPPER(PostalCode) LIKE ? OR UPPER(Phone) LIKE ? OR UPPER(Fax) LIKE ? OR UPPER(Email) LIKE ?";

                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, 'ssssssssssssss', $term, $term, $term, $term, $term, $term, $term, $term, $term, $term, $term, $term, $term, $term);
                mysqli_stmt_execute($stmt);

            } else {
                $query = "SELECT * FROM Employee WHERE EmployeeId=? OR ReportsTo=?";

                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, 'ii', $number, $number);
                mysqli_stmt_execute($stmt);
            }

            $result = mysqli_stmt_get_result($stmt);

            echo "<h2>Employees</h2>";
            echo "<center class='mb-5 text-center'>";
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Title</th>";
            echo "<th>Reports To</th>";
            echo "<th>Birthdate</th>";
            echo "<th>Hire date</th>";
            echo "<th>Address</th>";
            echo "<th>City</th>";
            echo "<th>State</th>";
            echo "<th>Country</th>";
            echo "<th>Postal Code</th>";
            echo "<th>Phone</th>";
            echo "<th>Fax</th>";
            echo "<th>Email</th>";
            echo "</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["EmployeeId"] . "</td>";
                echo "<td>" . $row["FirstName"] . "</td>";
                echo "<td>" . $row["LastName"] . "</td>";
                echo "<td>" . $row["Title"] . "</td>";
                echo "<td>" . $row["ReportsTo"] . "</td>";
                echo "<td>" . $row["BirthDate"] . "</td>";
                echo "<td>" . $row["HireDate"] . "</td>";
                echo "<td>" . $row["Address"] . "</td>";
                echo "<td>" . $row["City"] . "</td>";
                echo "<td>" . $row["State"] . "</td>";
                echo "<td>" . $row["Country"] . "</td>";
                echo "<td>" . $row["PostalCode"] . "</td>";
                echo "<td>" . $row["Phone"] . "</td>";
                echo "<td>" . $row["Fax"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</center>";
        }

    } catch (Exception $e) {
        echo $e->getMessage();

    } finally {
        mysqli_close($connection);
    }




} else {
    echo 'Some error has happened :(';
}

?>