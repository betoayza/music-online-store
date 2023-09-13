<?php
if (isset($_POST["isActive"], $_POST["id"])) {
    $isActive = intval($_POST["isActive"]);
    $id = intval($_POST["id"]);

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);

        if (!$connection)
            die('Connection error: ' . mysqli_connect_error());
        else {
            $query = "UPDATE Album SET isActive=? WHERE AlbumId=?";

            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'ii', $isActive, $id);
            mysqli_stmt_execute($stmt);
            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if ($affected_rows > 0) {
                echo 'Album activated ;)';
            } else {
                echo 'Activation failed :(';
            }

        }

    } catch (Exception $e) {
        $e->getMessage();
    }

} else {
    echo 'Variables didn\'t pass :(';
}

?>