<?php
    include "./index.php";

    try {
        if (extension_loaded('mysqli')) {
            // Realizar la solicitud a la BBDD
            $connection = mysqli_connect('localhost', 'alber', '1234', 'Chinook');
            if (!$connection) {
                die("La conexión falló :( : " . mysqli_connect_error());

            } else {
                $query = "SELECT * FROM Album";
                $result = mysqli_query($connection, $query);              

?>
                <button type="button" class="btn btn-light" id="buttonUploadAlbum">Subir</button>

                <div class="modal-dialog modal-dialog-centered d-none" id="modal-upload">
                    <p>Modal elements</p>
                    <button type="button" class="btn btn-primary">Upload</button>
                </div>

                <center>
                    <?php
                        echo "<h2>Albums</h2>";

                        echo "<table class='table table-bordered'>";
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

    const buttonUpload = document.getElementById('buttonUploadAlbum');
    const modalUpload = document.getElementById('modal-upload');

    buttonUpload.addEventListener("click", () => {
        if(modalUpload.classList.contains("d-none")){
            modalUpload.classList.remove("d-none");
        }
    });

</script>