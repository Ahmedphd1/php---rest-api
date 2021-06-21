<?php

require_once __DIR__ .'./class_database.php';

require_once __DIR__ .'./class_user.php';

class readone {
    function Select(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        try {

            $user = new person($_GET['fornavn'], $_GET['efternavn'], intval($_GET['postnummer']), $_GET['bydel'], $_GET['adresse'], $_GET['stilling'], $_GET['erfaring'], $_GET['firma'], intval($_GET['løn']));

            $db = new connect;

            $user->createuser($db);

            $sucess = array("CODE" => "SUCCESS", "Status" => "User created");

            echo json_encode($sucess);

        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
}

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        echo "GET not allowed";
    } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            $api = new readone;
            echo $api->Select();
        } catch(Exception $e) {
            echo 'Parameters cannot be found: ' .$e->getMessage();
        }
    }
    
?>