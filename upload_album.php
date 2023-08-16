<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $artist_ID = $_POST["artistID"];

    echo "$title" . " " . "$artist_ID";

    // ver si hay que poner la conexion devuelta
    $server = 'localhost';
    $user = 'alber';
    $password = '1234';
    $db = 'Chinook';

    $connection = mysqli_connect($server, $user, $password, $db);

    if (!$connection) {
        echo 'Connection problems :( ... ' . mysqli_connect_error();

    } else {
        try {
            // query
            $query = "INSERT INTO Album (Title, ArtistId) VALUES ('$title', '$artist_ID')";
            $result = mysqli_query($connection, $query);

            echo "$result";

            if ($result) {
                echo 'Album updated succesffuly! :)'; // PENDIENTE: es exitoso, pero no aparece en la tabla

            } else {
                echo 'Error in query, check that ;)';
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

} else {
    echo 'Something went wrong :/';
}

mysqli_close($connection);

?>