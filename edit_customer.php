<?php

if (isset($_POST["idCustomer"], $_POST["firstName"], $_POST["lastName"], $_POST["company"], $_POST["address"], $_POST["city"], $_POST["state"], $_POST["country"], $_POST["postalCode"], $_POST["phone"], $_POST["fax"], $_POST["email"], $_POST["supportRepID"])) {

    $id = $_POST["idCustomer"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $company = $_POST["company"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $postalCode = $_POST["postalCode"];
    $phone = $_POST["phone"];
    $fax = $_POST["fax"];
    $email = $_POST["email"];
    $suppRepID = $_POST["supportRepID"];

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);

        if (!$connection)
            die('Connection error: ' . mysqli_connect_error());
        else {
            $query = "UPDATE Customer SET FirstName=?, LastName=?, Company=?, Address=?, City=?, State=?, Country=?, PostalCode=?, Phone=?, Fax=?, Email=?, SupportRepId=? WHERE CustomerId=?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'sssssssssssii', $firstName, $lastName, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email, $suppRepID, $id);
            mysqli_stmt_execute($stmt);
            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if ($affected_rows > 0) {
                echo 'Updated successfuly';
            } else {
                echo 'Update error :(';
            }
        }
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        mysqli_close($connection);
    }

} else {
    echo 'All variables didn\'t pass :( ';
}
?>