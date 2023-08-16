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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Customer</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="upload_customer.php" method="POST">
                                <input type="text" placeholder="First Name" class="form-control" name="firstName" require>
                                <input type="text" placeholder="Last Name" class="form-control" name="lastName" require>
                                <input type="text" placeholder="Company" class="form-control" name="company" require>
                                <input type="text" placeholder="Address" class="form-control" name="address" require>
                                <input type="text" placeholder="City" class="form-control" name="city" require>
                                <input type="text" placeholder="State" class="form-control" name="state" require>
                                <input type="text" placeholder="Country" class="form-control" name="country" require>
                                <input type="text" placeholder="Postal Code" class="form-control" name="postalCode" require>
                                <input type="text" placeholder="Phone" class="form-control" name="phone" require>
                                <input type="text" placeholder="Fax" class="form-control" name="fax" require>
                                <input type="text" placeholder="Email" class="form-control" name="email" require>
                                <input type="number" placeholder="Support Rep ID" class="form-control" name="supportRepID" require>

                                <button type="submit" class="btn btn-primary mt-3">Upload</button>
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
                <form action="search_customer.php" class="w-auto">
                    <div class="form-group d-flex justify-content-center">
                        <input type="text" class="form-control" placeholder="Enter field..." size="35" name="term">
                        <button type="submit" class="btn btn-warning">Send</button>
                    </div>
                </form>
            </div>

            <?php

            if (!$result) {
                echo 'No customers yet :\'(';
            } else {
                echo "<h2>Customers</h2>";

                ?>



                <?php

                echo "<center class='mb-5'>";
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

                while ($row = mysqli_fetch_assoc($result)) {
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
                echo "</center>";
            }
        }
    } else {
        echo 'La extensión MYSQLI no está instalada, hágalo';
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

mysqli_close($connection);

?>