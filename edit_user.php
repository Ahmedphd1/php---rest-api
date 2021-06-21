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

        $keyarray = array_keys($_GET);

        if ($keyarray[1] == "Ansettelsesdato" || $keyarray[1] == 'Erfaring') {

            $myquery = 'UPDATE ansættelse SET ';
            
            $returnquery = $this->buildquery($keyarray[1], $myquery, $keyarray[0]);

            $data = $db->prepare($returnquery);

        } else if ($keyarray[1] == "Firma" || $keyarray[1] == 'Lon') {

            $myquery = 'UPDATE stillinginfo SET ';
            
            $returnquery = $this->buildquery($keyarray[1], $myquery, $keyarray[0]);

            $data = $db->prepare($returnquery);

        } else {

            $myquery = 'UPDATE personale SET ';
            
            $returnquery = $this->buildquery($keyarray[1], $myquery, $keyarray[0]);

            $data = $db->prepare($returnquery);

        }

        try {

            $data->execute();

        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $sucess = array("CODE" => "SUCCESS", "Status" => "Database updated");

        echo json_encode($sucess);
    }

    function buildquery($querykey, $query, $addresskey) {

        $myvalue = $_GET[$querykey];
        $addressvalue = $_GET[$addresskey];

        $query .= "$querykey = $myvalue WHERE Adresse = '$addressvalue'";
    
        return $query;
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