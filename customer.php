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

            <!-- UPLOAD CUSTOMER -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadCustomerModal">
                Add
            </button>

            <!-- Modal UPLOAD CUSTOMER-->
            <div class="modal fade" id="uploadCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Customer</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="upload_customer.php" method="POST">
                                <input type="text" placeholder="First Name" class="form-control mb-2" name="firstName" required>
                                <input type="text" placeholder="Last Name" class="form-control mb-2" name="lastName" required>
                                <input type="text" placeholder="Company" class="form-control mb-2" name="company">
                                <input type="text" placeholder="Address" class="form-control mb-2" name="address">
                                <input type="text" placeholder="City" class="form-control mb-2" name="city">
                                <input type="text" placeholder="State" class="form-control mb-2" name="state">
                                <input type="text" placeholder="Country" class="form-control mb-2" name="country">
                                <input type="text" placeholder="Postal Code" class="form-control mb-2" name="postalCode">
                                <input type="text" placeholder="Phone" class="form-control mb-2" name="phone">
                                <input type="text" placeholder="Fax" class="form-control mb-2" name="fax">
                                <input type="text" placeholder="Email" class="form-control mb-2" name="email">
                                <input type="number" placeholder="Support Rep ID" class="form-control mb-2" name="supportRepID"
                                    required>

                                <button type="submit" class="btn btn-primary mt-2">Upload</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- SEARCH CUSTOMER -->
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

                echo "<center class='mb-5 text-center'>";
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
                echo "<th>Actions</th>";
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
                    echo "<td>" . " <button type='button' data-bs-toggle='modal' data-bs-target='#editCustomerModal' class='btn btn-secondary' onclick=getDataCustomer(" . $row['CustomerId'] . ") >Edit</button> " . (($row['isActive'] == 1) ? "<button type='button' class='btn btn-danger' onclick='deleteCustomer(" . $row["CustomerId"] . ")'>Delete</button>" : "<button type='button' class='btn btn-success' onclick='activateCustomer(" . $row["CustomerId"] . ")'>Activate</button>") . "</td>";
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

<script>
    let dataCustomer = {};

    const deleteCustomer = (id) => {
        $.ajax({
            type: "POST",
            url: 'delete_customer.php',
            data: { isActive: 0, id: id },
            success: function (result) {
                console.log(result);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    const activateCustomer = (id) => {
        console.log(id);

        $.ajax({
            type: "POST",
            url: 'activate_customer.php',
            data: { isActive: 1, id: id },
            success: function (result) {
                console.log(result);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    const editCustomer = (customer) => {
        $.ajax({
            type: 'POST',
            url: 'edit_customer.php',
            data: {
                firstName: '',
                lastName: '',
                company: '',
                address: '',
                city: '',
                state: '',
                country: '',
                postalCode: '',
                phone: '',
                fax: '',
                email: '',
                supportRepId: ''
            }
        });
    }

    const getDataCustomer = (id) => {
        $.ajax({
            type: "GET",
            url: 'get_customer.php',
            data: { id: id },
            success: function (response) {
                dataCustomer = JSON.parse(response);
                console.log(dataCustomer);

                document.getElementById("idCustomerEdit").value = dataCustomer.CustomerId;
                document.getElementById("firstNameEdit").value = dataCustomer.FirstName;
                document.getElementById("lastNameEdit").value = dataCustomer.LastName;
                document.getElementById("companyEdit").value = dataCustomer.Company;
                document.getElementById("addressEdit").value = dataCustomer.Address;
                document.getElementById("cityEdit").value = dataCustomer.City;
                document.getElementById("stateEdit").value = dataCustomer.State;
                document.getElementById("countryEdit").value = dataCustomer.Country;
                document.getElementById("postalCodeEdit").value = dataCustomer.PostalCode;
                document.getElementById("phoneEdit").value = dataCustomer.Phone;
                document.getElementById("faxEdit").value = dataCustomer.Fax;
                document.getElementById("emailEdit").value = dataCustomer.Email;
                document.getElementById("supportRepIdEdit").value = dataCustomer.SupportRepId;

            },
            error: function (error) {
                console.log(error);
            }
        });
    }
</script>

<!-- Modal EDIT CUSTOMER-->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit_customer.php" method="POST">
                    <input type="hidden" id="idCustomerEdit" name="idCustomer">
                    <input type="text" id="firstNameEdit" placeholder="First Name" class="form-control mb-2"
                        name="firstName" required>
                    <input type="text" id="lastNameEdit" placeholder="Last Name" class="form-control mb-2"
                        name="lastName" required>
                    <input type="text" id="companyEdit" placeholder="Company" class="form-control mb-2" name="company">
                    <input type="text" id="addressEdit" placeholder="Address" class="form-control mb-2" name="address">
                    <input type="text" id="cityEdit" placeholder="City" class="form-control mb-2" name="city" required>
                    <input type="text" id="stateEdit" placeholder="State" class="form-control mb-2" name="state">
                    <input type="text" id="countryEdit" placeholder="Country" class="form-control mb-2" name="country">
                    <input type="text" id="postalCodeEdit" placeholder="Postal Code" class="form-control mb-2"
                        name="postalCode">
                    <input type="text" id="phoneEdit" placeholder="Phone" class="form-control mb-2" name="phone">
                    <input type="text" id="faxEdit" placeholder="Fax" class="form-control mb-2" name="fax">
                    <input type="text" id="emailEdit" placeholder="Email" class="form-control mb-2" name="email"
                        required>
                    <input type="number" id="supportRepIdEdit" placeholder="Support Rep ID" class="form-control mb-2"
                        name="supportRepID" required>

                    <button type="submit" class="btn btn-primary mt-2">Edit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>