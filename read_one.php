<?php
require_once __DIR__ .'./class_database.php';

class readone {
    function Select($address){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $db = new connect;
        $users = array();
        $data = $db->prepare('SELECT Fornavn, Efternavn, Postnummer, Bydel, Dato, p.Adresse, Stilling, Ansettelsesdato, Erfaring, Firma, Lon FROM personale p LEFT JOIN ansættelse o ON o.Adresse = p.Adresse LEFT JOIN stillinginfo ON o.Adresse = stillinginfo.Adresse');
        $data->execute();
        try {

            while($outputdata = $data->fetch(PDO::FETCH_ASSOC)){
                $users[] = array(
                    'Fornavn' => $outputdata['Fornavn'],
                    'Efternavn' => $outputdata['Efternavn'],
                    'Postnummer' => $outputdata['Postnummer'],
                    'Bydel' => $outputdata['Bydel'],
                    'Dato' => $outputdata['Dato'],
                    'Adresse' => $outputdata['Adresse'],
                    'Stilling' => $outputdata['Stilling'],
                    'Ansettelsesdato' => $outputdata['Ansettelsesdato'],
                    'Erfaring' => $outputdata['Erfaring'],
                    'Firma' => $outputdata['Firma'],
                    'Lon' => $outputdata['Lon']
                );
            }

            if (count($users) == 0) {
                throw new Exception("Data is empty");
            }

        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        foreach ($users as $key => $value) {
            if ($value['Adresse'] == $address) {
                echo json_encode($value);
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    echo "GET not allowed";
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

    try {
        $api = new readone;
        echo $api->Select($_GET['address']);
    } catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }
}
?>