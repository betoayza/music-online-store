<?php

include "./index.php";

try {
    if (extension_loaded('mysqli')) {
        $connection = mysqli_connect('localhost', 'alber', '1234', 'Chinook');

        if (!$connection) {
            echo "Connection failed: " . mysqli_connect_error();

        } else {
            $query = "SELECT * FROM Employee";
            $result = mysqli_query($connection, $query);

            ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Album...</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="upload_customer.php" method="POST">
                                <input type="text" placeholder="Title..." class="form-control" name="title" require>
                                <input type="number" placeholder="Artist ID..." class="form-control" name="artistID" require>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- PENDIENTE: BUSCAR UN ALTERNATIVA A D-FLEX JUSTIFY-CONTENT-CENTER PARA FORMS -->
            <div class="mt-3 mb-3">
                <form action="search_employee.php" class="w-auto">
                    <div class="form-group d-flex justify-content-center">
                        <input type="text" class="form-control" placeholder="Enter field..." size="35" name="term">
                        <button type="submit" class="btn btn-warning">Send</button>
                    </div>
                </form>
            </div>

            <?php
            if (!$result) {
                echo "No employees yet :(";
            } else {
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
        }

    } else {
        echo "You have to enable 'mysqli' extension";
    }

} catch (Exception $e) {
    echo $e->getMessage();
}

mysqli_close($connection);

?>