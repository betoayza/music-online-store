<?php
if (isset($_POST["isActive"], $_POST["id"])) {
    $isActivate = $_POST["isActive"];
    $id = $_POST["id"];

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);

        if (!$connection)
            die('Connection error: ' . mysqli_connect_error());
        else {
            $query = "UPDATE Customer SET isActive=? WHERE CustomerId=?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'ii', $isActivate, $id);
            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if ($affected_rows > 0) {
                echo 'Update successful!';
            } else {
                echo 'Update couldn\'t be done';
            }
        }

    } catch (Exception $e) {
        $e->getMessage();
    }

} else {
    echo 'Variables didn\'t pass :(';
}
?>