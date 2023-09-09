<?php

include './index.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $term = $_GET["term"];

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);

        if (!$connection)
            die("Error en la conexión! :( " . mysqli_connect_error());
        else {
            $id = intval($term);

            // PENDIENTE
            if ($id == 0) { // If term is not a number
                $term = '%' . strtoupper($term) . '%';
                $query = "SELECT * FROM Album WHERE UPPER(Title) LIKE '$term'"; // PENDIENTE: modificar para que interprete coincidencias imprecisas + insensitividad y agregar los prepared
            } else {
                $query = "SELECT * FROM Album WHERE AlbumId='$id'";
            }

            // make query
            $result = mysqli_query($connection, $query);

            if (!$result) {
                echo 'No matches :/';
            } else {

                ?>

                <center class="mb-5 text-center">
                    <?php
                    echo "<h2>Albums</h2>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr><th>ID</th><th>Title</th><th>Artist ID</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row["AlbumId"] . "</td><td>" . $row["Title"] . "</td><td>" . $row["ArtistId"] . "</td></tr>";
                    }
                    echo "</table>";
                    ?>
                </center>

                <?php
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        mysqli_close($connection);
    }

} else {
    echo 'Unexpected error :(';
}

?>