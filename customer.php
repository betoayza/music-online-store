<?php

    try {
        if (extension_loaded('mysqli')) {
            $connection = mysqli_connect('localhost', 'alber', '1234', 'Chinook');

            if (!$connection) {
            }
        } else {
            echo 'La extensión MYSQLI no está instalada, hágalo';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    mysqli_close($connection);

?>