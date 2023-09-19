<?php

if (isset($_POST['id'], $_POST['title'], $_POST['idArtist'])) {
    $idAlbum = intval($_POST['id']);
    $title = $_POST['title'];
    $idArtist = intval($_POST['idArtist']);

    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);

        if (!$connection)
            die('Connection error: ' . mysqli_connect_error());
        else {
            $query = "UPDATE Album SET Title=?, ArtistId=? WHERE AlbumId=?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'sii', $title, $idArtist, $idAlbum);
            mysqli_stmt_execute($stmt);
            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if ($affected_rows > 0)
                echo 'Edit album successful!';
            else
                echo 'Edit album failed :(';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

} else {
    echo 'Variables didn\'t pass :(';
}

?>