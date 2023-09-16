<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);

        if (!$connection)
            die('Connection error: ' . mysqli_connect_error());
        else {
            $query = "SELECT * FROM Album WHERE AlbumId=?";

            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if (!$result)
                echo 'Album not found :(';
            else {
                $album = mysqli_fetch_assoc($result);
                echo json_encode($album);
            }
        }
    } catch (Exception $e) {
        $e->getMessage();
    }


} else {
    echo 'ID album didn\' pass :(';
}
?>