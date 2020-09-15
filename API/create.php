<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 include '../personnagesManager.php';
 include '../personnage.php';


    // get posted data
   $data = json_decode(file_get_contents("php://input"));
   $db = new PDO('mysql:host=localhost;dbname=combats', 'root', '');

    $manager = new PersonnagesManager($db);

    echo json_encode(array("message" => $data));

// make sure data is not empty
if(!empty($data->nom)){

    // make sure is unique

    $res = $manager->existsByName($data->nom);
    if (!$res) {

         // set product property values

        $perso = new Personnage(["nom" => $data->nom]);


     
     
        // create the user
        if($manager->add($perso)){
     
            // set response code - 201 created
            http_response_code(201);
     
            // tell the user
            echo json_encode(array("message" => "User was created."));
        }
     
        // if unable to create the product, tell the user
        else{
     
            // set response code - 503 service unavailable
            http_response_code(503);
     
            // tell the user
            echo json_encode(array("message" => "Unable to create user; this field is required."));
        }

    } else {

         // set response code - 503 service unavailable
            http_response_code(503);
     
            // tell the user
            echo json_encode(array("message" => "Unable to create user because it's unique."));
            
        }
 
   
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}
?>