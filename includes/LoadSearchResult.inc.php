<?php

if(isset($_POST['searchSubmit'])){
    file_put_contents("PostValues.txt", print_r($_POST, true), FILE_APPEND);
}
else{
    echo json_encode(array('errorType' => 'search button not clicked'));
}

?>