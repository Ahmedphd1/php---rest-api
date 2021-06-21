<?php

require_once __DIR__ .'./class_database.php';

class readone {
    function Select(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $db = new connect;
        $users = array();

        $addressvalue = $_GET['address'];

        $data = $db->prepare("DELETE FROM personale WHERE Adresse = '$addressvalue'");

        $data->execute();

        try {

            
            $data = $db->prepare("DELETE FROM personale WHERE Adresse = '$addressvalue'");

            $data->execute();

            $sucess = array("CODE" => "SUCCESS", "Status" => "User Deleted");

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