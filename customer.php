<?php    
    include "./index.php";

    try {
        if (extension_loaded('mysqli')) {
            $connection = mysqli_connect('localhost', 'alber', '1234', 'Chinook');

            if (!$connection) {
                die("Problema en la conexión: " . mysqli_connect_error());
            } else {
                $query = "SELECT * FROM Customer";
                $result = mysqli_query($connection, $query);

                echo "<h2>Customers</h2>";

                echo "<table class='table table-bordered'>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Company</th>";
                echo "<th>Address</th>";
                echo "<th>City</th>";
                echo "<th>State</th>";
                echo "<th>Country</th>";
                echo "<th>Postal Code</th>";
                echo "<th>Phone</th>";
                echo "<th>Fax</th>";
                echo "<th>Email</th>";
                echo "<th>Support Rep ID</th>";
                echo "</tr>";

                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row["CustomerId"] . "</td>";
                    echo "<td>" . $row["FirstName"] . "</td>";
                    echo "<td>" . $row["LastName"] . "</td>";
                    echo "<td>" . $row["Company"] . "</td>";
                    echo "<td>" . $row["Address"] . "</td>";
                    echo "<td>" . $row["City"] . "</td>";
                    echo "<td>" . $row["State"] . "</td>";
                    echo "<td>" . $row["Country"] . "</td>";
                    echo "<td>" . $row["PostalCode"] . "</td>";
                    echo "<td>" . $row["Phone"] . "</td>";
                    echo "<td>" . $row["Fax"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["SupportRepId"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>"; 

            }
        } else {
            echo 'La extensión MYSQLI no está instalada, hágalo';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    mysqli_close($connection);
    
?>