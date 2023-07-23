<?php

include "./index.html";

try {
    if (extension_loaded('mysqli')) {
        // echo 'La extensión MySQLi está habilitada en este servidor.';

        // Realizar la solicitud a la BBDD
        $connection = mysqli_connect('localhost', 'alber', '1234', 'Chinook');
        if (!$connection) {
            die("La conexión falló :( : " . mysqli_connect_error());
        } else {
            $query = "SELECT * FROM Album";
            $result = mysqli_query($connection, $query);      
        

?>
        <center>
            <?php
            echo "<h2>Albums</h2>";

            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Title</th><th>Artist ID</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["AlbumId"] . "</td><td>" . $row["Title"] . "</td><td>" .  $row["ArtistId"] . "</td></tr>";
            }
            echo "</table>";

            ?>
        </center>
<?php
        }
    } else {
        echo 'La extensión MySQLi no está habilitada en este servidor.';
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

mysqli_close($connection);
?>

<script>
    function redirect() {
        window.location.href = "index.php";
    }
</script>