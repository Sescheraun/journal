<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once("Database.php");
include_once('Journal.php');


$dBase = new Database();
$db = $dBase->getConnection();

//Call the read method bassed on what was asked for

$journal = new Journal($db);
if (isset($_GET['id'])){
    //readByID not ready yet
    echo json_encode("{'data':{'result':'Read by ID not ready yet'}}");
    $result = "";
    die;
} else if(isset($_GET['subject'])){
    //readBySubject not ready yet
    echo json_encode("{'data':{'result':'Read by subject not ready yet'}}");
    $result = "";
    die;
} else {
    $result = $journal->readAll();
}


/** Process the results and return as JSON */
$rows = $result->rowCount();

if ($rows > 0) {
    $journalArray = array();
    $journalArray['data'] = array();

    while ($rows = $result->refch(PDO::FETCH_ASSOC)) {
        exrtract($rows);

        $journalEntry = array(
            'id' => $id,
            'date' => $dateOfEntry,
            'subject' => $subject_description,
            'entry' => html_entity_decode($entry)
        );

        array_push($journalArray['data'], $journalEntry);
    }

    echo json_encode($journalArray);
} else {
    echo json_encode("{'data':{'result':'There were no resutls'}}");
}

?>