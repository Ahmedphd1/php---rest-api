<?php

require_once __DIR__ .'/class_database.php';

class readall {
    function Select(){

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
        return json_encode($users);
        }
}

$api = new readall;
echo $api->Select();

?>