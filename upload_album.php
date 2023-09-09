<?php

include './index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $artist_ID = $_POST["artistID"];

    $server = 'localhost';
    $user = 'alber';
    $password = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $password, $db);

        if (!$connection)
            echo 'Connection problems :( ... ' . mysqli_connect_error();
        else {
            $query = "INSERT INTO Album (Title, ArtistId) VALUES (?,?)";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'si', $title, $artist_ID);
            mysqli_stmt_execute($stmt);
            $num_rows = mysqli_stmt_affected_rows($stmt);

            if ($num_rows > 0) {
                echo 'Album uploaded successfuly! :)';
            } else {
                echo 'Error in statement :(';
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        mysqli_close($connection);
    }

} else {
    echo 'Something went wrong :/';
}

?>