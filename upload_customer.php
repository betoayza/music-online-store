<?php

include './index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["firstName"];
    $last_name = $_POST["lastName"];
    $company = $_POST["company"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $postal_code = $_POST["postalCode"];
    $phone = $_POST["phone"];
    $fax = $_POST["fax"];
    $email = $_POST["email"];
    $support_rep_ID = intval($_POST["supportRepID"]);

    echo "$first_name $last_name $company $address $city $state $country $postal_code $fax $email $support_rep_ID" . gettype($support_rep_ID);

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);

        if (!$connection)
            echo 'Connection error: ' . mysqli_connect_error();
        else {
            $query = "INSERT INTO Customer (FirstName, LastName, Company, Address, City, State, Country, PostalCode, Phone, Fax, Email, SupportRepId) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'sssssssssssi', $first_name, $last_name, $company, $address, $city, $state, $country, $postal_code, $phone, $fax, $email, $support_rep_ID);
            mysqli_stmt_execute($stmt);
            $num_rows = mysqli_stmt_affected_rows($stmt);

            if ($num_rows > 0) {
                echo 'Customer added! ;)';
            } else {
                echo 'Error customer not added :(';
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        mysqli_close($connection);
    }

} else {
    echo "Some went wrong :(";
}

?>