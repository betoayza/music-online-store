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
            echo 'Connection error :(';
        else {
            $query = "UPDATE Album SET isActive=? WHERE AlbumId=?";

            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'ii', $isActive, $id);
            mysqli_stmt_execute($stmt);
            $num_rows = mysqli_stmt_affected_rows($stmt);

            if ($num_rows > 0)
                echo 'Update successful!';
            else {
                echo 'Error in update :(';
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        mysqli_close($connection);
    }

} else {
    echo "Variables didn't pass :(";
}
?>