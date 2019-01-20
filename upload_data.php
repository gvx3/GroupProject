<?php
ini_set('display_errors', 'On');

echo '<pre>';

require "F:/vendor/autoload.php";

function convertDateFormat($date_str) {
    $date = date_create($date_str);
    return date_format($date, "d/m/Y");
}

function calculatePrice($price, $priceUnit, $indexName) {
    if ($indexName == "buy") {
        if ($priceUnit == "millions") return number_format((float)$price / 1000, 1, '.', '');
        else return number_format((float)$price, 1, '.', '');
    } else {
        if ($priceUnit == "millions") return number_format((float)$price, 1, '.', '');
        else return number_format((float)$price * 1000, 1, '.', '');
    }
}

$client = Algolia\AlgoliaSearch\SearchClient::create(
    'MQ39V1L64H',
    '89090a11fec2dfe035ee55d52a4d1f7a'
);

if ($_POST["ad_type"] == "For sale") {
    $indexName = "buy";
} else {
    $indexName = "rent";
}

$index = $client->initIndex($indexName);
// Push the record onto Algolia
$formInfo = [
    "title" => $_POST["title"],
    "description" => $_POST["description"],
    "start_date" => convertDateFormat($_POST["start_date"]),
    "expiry_date" => convertDateFormat($_POST["expiry_date"]),
    "housing_type" => $_POST["housing_type"],
    "address" => $_POST["address"],
    "price" => calculatePrice($_POST["price"], $_POST["price_unit"], $indexName),
    "surface_area" => $_POST["surface_area"],
    "poster_name" => $_POST["poster_name"],
    "poster_email" => $_POST["poster_email"],
    "poster_phone" => $_POST["poster_phone"],
];
print_r($formInfo);
$response = $index->saveObject(
    $formInfo,
    [
        "autoGenerateObjectIDIfNotExist" => true
    ]
);

// Save images to server
$response = (array) $response;
$newObjectId = $response["\0*\0apiResponse"][0]["objectIDs"][0];

$uploaded_images_dir = 'uploaded_images/' . $newObjectId;
$mkdirSucceeded = mkdir($uploaded_images_dir, 0755, true);
echo $mkdirSucceeded . "\n";

$img_paths = array();
$total_img_count = count($_FILES["images"]["name"]);
$success_count = 0;
foreach ($_FILES["images"]["error"] as $key => $error) {
    $uploadOk = 1;

    $tmp_name = $_FILES["images"]["tmp_name"][$key];
    $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);

    if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    $path_on_server = $uploaded_images_dir . "/" . $success_count . "." . $ext;
    $full_path = dirname(__FILE__) . "/" . $path_on_server;
    echo $full_path . "\n";
    if ($error == UPLOAD_ERR_OK && $uploadOk == 1) {
        if (move_uploaded_file($tmp_name, $full_path)) {
            $success_count += 1;
            array_push($img_paths, $path_on_server);
        }
    }
}

print_r($_FILES);

echo "Succesfully uploaded " . $success_count . "/" . $total_img_count . " images\n";

$index->partialUpdateObject(
    [
      'img_links' => $img_paths,
      'objectID' => $newObjectId
    ]
);

print "</pre>";

?>
