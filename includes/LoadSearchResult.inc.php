
<?php
// if(isset(mysqli_real_escape_string($conn,['searchSubmit'])){

//     $json_string = json_encode(mysqli_real_escape_string($conn,);

//     $file_handle = fopen('my_filename.json', 'w');
//     fwrite($file_handle, $json_string);
//     fclose($file_handle);
// }
// else{
//     echo json_encode(mysqli_real_escape_string($conn,);
// }

error_reporting(0);
require 'dbHandler.inc.php';
$city = mysqli_real_escape_string($conn, $_POST['cityName']);
$address = mysqli_real_escape_string($conn,$_POST['address']);
$minPrice = $_POST['minPrice'];
$maxPrice = $_POST['maxPrice'];
$numBedroom = $_POST['numBedroom'];
$schoolCB = mysqli_real_escape_string($conn,$_POST['schoolCB']);
$hospitalCB = mysqli_real_escape_string($conn,$_POST['hospitalCB']);
$parkCB = mysqli_real_escape_string($conn,$_POST['parkCB']);
$kinCB = mysqli_real_escape_string($conn,$_POST['kinCB']);
$bikeCB = mysqli_real_escape_string($conn,$_POST['bikeCB']);
$carCB = mysqli_real_escape_string($conn,$_POST['carCB']);
$gymCB = mysqli_real_escape_string($conn,$_POST['gymCB']);
$securityCB = mysqli_real_escape_string($conn,$_POST['securityCB']);
$poolCB = mysqli_real_escape_string($conn,$_POST['poolCB']);
$redNoteCB = mysqli_real_escape_string($conn,$_POST['redNoteCB']);
$pinkNoteCB = mysqli_real_escape_string($conn,$_POST['pinkNoteCB']);
$constructionPaperCB = mysqli_real_escape_string($conn,$_POST['constructionPaperCB']);
//Create a variable to store the returned result
$rowReturned = array();
//Remove all ,

//print_r($_POST);

$sqlText = "SELECT * FROM batdongsan WHERE city =? ";

if("" != trim($_POST['address'])){
    $address = str_replace(",", " ", $address);
    $arrayString = explode(' ',$address);
    foreach($arrayString as $value) {
        $sqlText .= "AND address LIKE '%" . $value . "%' ";

    }
    unset($value);
}

if("" != trim($_POST['minPrice'])) {
    $sqlText .= "AND price >= " . strval($minPrice) . " ";
}

if("" != trim($_POST['maxPrice'])){
    $sqlText .="AND price <= " . strval($maxPrice) . " ";
}
if("" != trim($_POST['numBedroom'])){
    $sqlText .="AND bedroom >= " . strval($numBedroom) . " ";
}




//print_r($_POST);

if(isset($_POST['schoolCB'])) {
    $sqlText .= "AND places_nearby LIKE '%gần trường%' ";
}

if(isset($_POST['hospital'])) {
    $sqlText .= "AND places_nearby LIKE '%gần bệnh viện%' ";
}

if(isset($_POST['parkCB'])) {
    $sqlText .= "AND places_nearby LIKE '%gần công viên%' ";
}

if(isset($_POST['kinCB'])) {
    $sqlText .= "AND places_nearby LIKE '%gần nhà trẻ%' ";
}

if(isset($_POST['bikeCB'])) {
    $sqlText .= "AND utilities LIKE '%chỗ để xe máy %' ";
}

if(isset($_POST['carCB'])) {
    $sqlText .= "AND utilities LIKE '%chỗ để ô tô%' ";
}

if(isset($_POST['gymCB'])) {
    $sqlText .= "AND utilities LIKE '%trung tâm thể dục%' ";
}

if(isset($_POST['securityCB'])) {
    $sqlText .= "AND utilities LIKE '%hệ thông an ninh%' ";
}

if(isset($_POST['poolCB'])) {
    $sqlText .= "AND utilities LIKE '%Hồ bơi%' ";
}

if(isset($_POST['redNoteCB'])) {
    $sqlText .= "AND legal LIKE '%sổ đỏ%' ";
}

if(isset($_POST['pinkNoteCB'])) {
    $sqlText .= "AND legal LIKE '%sổ hồng%' ";
}

if(isset($_POST['constructionCB'])) {
    $sqlText .= "AND legal LIKE '%xây dựng%' ";
}

//echo $sqlText;
// echo $city;

// $result = mysqli_query($conn, "SELECT * FROM batdongsan WHERE city ='Hà Nội'");
// var_dump($result);
// while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
//     var_dump($row);
 
// }

$nRow = 0;
$sqlStatement = mysqli_stmt_init($conn);
if($sqlStatement = mysqli_prepare($conn, $sqlText)) {
    mysqli_stmt_bind_param($sqlStatement, "s", $city);
    mysqli_stmt_execute($sqlStatement);
    $result = mysqli_stmt_get_result($sqlStatement);
    
    while($row = mysqli_fetch_assoc($result)){
        ++$nRow; 
        $rowReturned[] = array(
            "id" => $row['id'],
            "title" => $row['title'],
            "price" => $row['price'],
            "area" => $row['area'],
            "address" => $row['address'],
            "image" => $row['image']
        ); 
    }
    file_put_contents('test.txt' , $rowReturned); 
    echo json_encode($rowReturned);
}





mysqli_stmt_close($sqlStatement);
mysqli_close($conn);
// //exit;


?>
