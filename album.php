<?php
include "./index.php";

try {
    if (extension_loaded('mysqli')) {
        // Realizar la solicitud a la BBDD
        $server = 'localhost';
        $user = 'alber';
        $pass = '1234';
        $db = 'Chinook';

        $connection = mysqli_connect($server, $user, $pass, $db);
        if (!$connection) {
            die("La conexión falló :( : " . mysqli_connect_error());

        } else {
            $query = "SELECT * FROM Album";
            $result = mysqli_query($connection, $query);

            ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Album</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="upload_album.php" method="POST">
                                <input type="text" placeholder="Title..." class="form-control" name="title" required>
                                <input type="number" placeholder="Artist ID..." class="form-control" name="artistID" required>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- PENDIENTE: BUSCAR UN ALTERNATIVA A D-FLEX JUSTIFY-CONTENT-CENTER PARA FORMS -->
            <div class="mt-3 mb-3">
                <form action="search_album.php" class="w-auto">
                    <div class="form-group d-flex justify-content-center">
                        <input type="text" class="form-control" placeholder="ID or title..." size="35" name="term">
                        <button type="submit" class="btn btn-warning">Send</button>
                    </div>
                </form>
            </div>

            <center class="mb-5 text-center">
                <?php
                echo "<h2>Albums</h2>";
                echo "<table class='table table-bordered'>";
                echo "<tr><th>ID</th><th>Title</th><th>Artist ID</th><th>Action</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["isActive"] == 1)
                        echo "<tr><td>" . $row["AlbumId"] . "</td><td>" . $row["Title"] . "</td><td>" . $row["ArtistId"] . "</td>" . "<td><button onclick='deleteAlbum(" . $row['AlbumId'] . ")' id='deleteButton' type='button' class='btn btn-danger'>Delete</button></td>" . "</tr>";
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
    const deleteAlbum = async (id) => {
        if (confirm('Are yor sure?')) {

            $.ajax({
                url: 'delete_album.php',
                type: 'POST',
                data: { isActive: 0, id: id },
                success: function (result) {
                    console.log(result)
                },
                error: function (error) {
                    console.log('error')
                }
            })
        }
    }
</script>