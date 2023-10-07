<?php 
    $server = 'localhost';
    $user = 'alber';
    $pass = '1234';
    $db = 'Chinook';

    try {
        $connection = mysqli_connect($server, $user, $pass, $db);
    
        if(!$connection)
            die('Connection error: ' . mysqli_connect_error());
        else {
            $query = "SELECT * FROM Album";
            $result = mysqli_query($connection, $query);
    
            if(mysqli_num_rows($result) > 0){
                $albums = array();

                while($row = mysqli_fetch_assoc($result)){
                    $albums[] = $row; //add row to array
                }

                // echo $albums;
                echo json_encode($albums); // returns an JSON array
            }
            else echo 'No albums yet :(';
        }

    } catch (Exception $e) {
        echo $e->getMessage();
 
    } finally {
        mysqli_close($connection);
    }
?>