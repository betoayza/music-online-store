    <?php

        include "./index.php";

        try{
            if(extension_loaded('mysqli')){
                $connection = mysqli_connect('localhost', 'alber', '1234', 'Chinook');
                
                if(!$connection) {
                    echo "Connection failed :(";

                } else {
                    $query = "SELECT * FROM Employee";                    
                    $result = mysqli_query($connection, $query);

                    if(!$result) {
                        echo "Query in incorrect :(";
                    } else {
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
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["EmployeeId"] . "</td>"; 
                            echo "<td>" . $row["FirstName"] . "</td>";
                            echo "<td>" . $row["LastName"] . "</td>";
                            echo "<td>" . $row["Title"] . "</td>";
                            echo "<td>" . $row["Reports To"] . "</td>";
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
                    }
                }




            } else {
                echo "You have to enable 'mysqli' extension";
            }

        } catch(Exception $e) {
            echo $e->getMessage();
        }

        mysqli_close($connection);
    
    ?>

