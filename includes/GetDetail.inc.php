<?php
    if(isset($_GET["id"])){
        //We do our code here
        require 'dbHandler.inc.php';
        //get all the column data from batdongsan
        $sqlText = "SELECT * FROM batdongsan WHERE id = ?";

        $sqlStatement = mysqli_stmt_init($conn);
        if($sqlStatement = mysqli_prepare($conn, $sqlText)) {
            mysqli_stmt_bind_param($sqlStatement, "i", $_GET['id']);
            mysqli_stmt_execute($sqlStatement);
            $result = mysqli_stmt_get_result($sqlStatement);
            
            while($row = mysqli_fetch_assoc($result)){
                $title = $row['title'];
                $imageLink = ;
                $bedroom = $row['bedroom'];
                $address = $row['address'];
                $price = $row['address'];
                $area = $row['area'];
                $utilities = $row['utilities'];
                $places_neaby = $row['places_nearby'];
                $legal = $row['legal'];
                $city = $row['city'];
                $posterID = $row['posterID'];
            }
        }

        //get all the poster data from table poster
        $sqlText = "SELECT * FROM poster WHERE posterID = ?";

        $sqlStatement = mysqli_stmt_init($conn);
        if($sqlStatement = mysqli_prepare($conn, $sqlText)) {
            mysqli_stmt_bind_param($sqlStatement, "i", $posterID);
            mysqli_stmt_execute($sqlStatement);
            $result = mysqli_stmt_get_result($sqlStatement);
            
            while($row = mysqli_fetch_assoc($result)){
                $posterName = $row['name'];
                $posterMail = $row['email'];
                $posterPhone = $row['phone'];
            }
        }

        mysqli_stmt_close($sqlStatement);
        mysqli_close($conn);
    }   
    else {
        echo "Illegal access, get out";
    }

?>