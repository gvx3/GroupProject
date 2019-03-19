<?php
    require 'dbHandler.inc.php';
    ini_set('max_execution_time', 90);
    error_reporting(0);
    function calculateDistance($addressFrom, $addressTo){
        //key
        $apiKey = 'AIzaSyBbr6z-IAFZfOY-_IaKhTMI0FRbLFPYwYQ';
        
        // plus + to link
        $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
        $formattedAddrTo     = str_replace(' ', '+', $addressTo);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,  'https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
        $geocodeFrom  = curl_exec($ch);
        curl_close($ch);
    
        // geocoding API request 
        $outputFrom = json_decode($geocodeFrom);
        if(!empty($outputFrom->error_message)){
            return $outputFrom->error_message;
            
        }
    
        //final
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,  'https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
        $geocodeTo  = curl_exec($ch);
        curl_close($ch);
    
        $outputTo = json_decode($geocodeTo);
        if(!empty($outputTo->error_message)){
            return $outputTo->error_message;
        }
        
        // Get lat and lng
        $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
        $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
        $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo    = $outputTo->results[0]->geometry->location->lng;

        // Calculate distance between latitude and longitude
        $theta    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        return round($miles * 1609.344, 2);
    }

    function longest_common_substring($words) {
        $words = array_map('strtolower', array_map('trim', $words));
        $sort_by_strlen = create_function('$a, $b', 'if (strlen($a) == strlen($b)) { return strcmp($a, $b); } return (strlen($a) < strlen($b)) ? -1 : 1;');
        usort($words, $sort_by_strlen);
        // We have to assume that each string has something in common with the first
        // string (post sort), we just need to figure out what the longest common
        // string is. If any string DOES NOT have something in common with the first
        // string, return false.
        $longest_common_substring = array();
        $shortest_string = str_split(array_shift($words));
    
        while (sizeof($shortest_string)) {
            array_unshift($longest_common_substring, '');
            foreach ($shortest_string as $ci => $char) {
                foreach ($words as $wi => $word) {
                    if (!strstr($word, $longest_common_substring[0] . $char)) {
                        // No match
                        break 2;
                    } // if
                } // foreach
                // we found the current char in each word, so add it to the first longest_common_substring element,
                // then start checking again using the next char as well
                $longest_common_substring[0].= $char;
            } // foreach
            // We've finished looping through the entire shortest_string.
            // Remove the first char and start all over. Do this until there are no more
            // chars to search on.
            array_shift($shortest_string);
        }
        // If we made it here then we've run through everything
        usort($longest_common_substring, $sort_by_strlen);
        return array_pop($longest_common_substring);
    }







    //$houseID = $_POST['houseID'];
    $houseID = 1;
    $sqlText = "SELECT * FROM batdongsan WHERE id =".$houseID;

    if ($result = mysqli_query($conn, $sqlText)) {

        /* fetch associative array */
        while ($row = mysqli_fetch_assoc($result)) {
            $houseAddress = $row['address'];
            $houseCity = $row['city'];
            $housePrice = $row['price'];
            $houseUtilities = $row['utilities'];
            $housePlacesNerby = $row['places_nearby'];
        }
    
        /* free result set */
        mysqli_free_result($result);
    }
    

    //Now we query all recors having the same city
    $sqlText = "SELECT * FROM batdongsan where city = ? ORDER BY RAND() limit 70";
    // AN array to store all houses

    $allHouses = array();
    $sqlStatement = mysqli_stmt_init($conn);
    if($sqlStatement = mysqli_prepare($conn, $sqlText)) {
        mysqli_stmt_bind_param($sqlStatement, "s", $houseCity);
        mysqli_stmt_execute($sqlStatement);
        $result = mysqli_stmt_get_result($sqlStatement);
        
        while($row = mysqli_fetch_assoc($result)){
            $utilityArray = array();
            $utilityArray[] = $row['utilities'];
            $utilityArray[] = $houseUtilities;

            $placesArray = array();
            $placesArray[] = $row['places_nearby'];
            $placesArray[] = $housePlacesNerby;
            if($row['address'] == $houseAddress){
                continue;
            }
            else if($row['price'] - $housePrice >= 1) {
                continue;
            } 
            else if(longest_common_substring($utilityArray) === '' && $houseUtilities !== ''){
                continue;
            }
            else if(longest_common_substring($placesArray) === '' && $housePlacesNerby !== '' ){
                continue;
            }
            $distance = calculateDistance($houseAddress, $row['address']);
            if($distance >= 4000){
                continue;
            }
            $allHouses[] = array(
                "id" => $row['id'],
                "title" => $row['title'],
                "price" => $row['price'],
                "address" => $row['address'],
                "utilities" => $row['utilities'],
                "places_nearby" =>$row['places_nearby'],
                "distanceToHouse" => $distance
            ); 
        }
        //Now we sort the array
        usort($allHouses, function($a, $b) {
            return $a['distanceToHouse'] - $b['distanceToHouse'];
        });
        if(sizeof($allHouses) >= 10){
            $top10 = array_slice($allHouses, 0, 9);
            //print_r($top10);
        }
        else if(sizeof($allHouses) <= 10 && sizeof($allHouses) > 5){
            $top10 = array_slice($allHouses, 0, sizeof($allHouses)-1);
            //print_r($top10);
        }
        else{
            $top10 = $allHouses;
            mysqli_close($conn);
            echo json_encode($top10);
            exit();
        }

        mysqli_close($conn);
        echo json_encode($top10);
        exit();

    }


?>