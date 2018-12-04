<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once("Database.php");
include_once('Journal.php');
include_once('Subject.php');


$dBase = new Database();
$db = $dBase->getConnection();

$journal = new Journal($db);
$subject = new Subject($db);

$table = "";

if(isset($_GET['table'])) {
    $table = $_GET['table'] ;
}
 
if ($table == "subject") {
    $result = $subject->read();
  
} else if (isset($_GET['id'])){
    $table = "journal";
    //readByID not ready yet
    echo json_encode("{'data':{'result':'Read by ID not ready yet'}}");
    $result = "";
    die;

} else if(isset($_GET['subject'])){
    $table = "journal";
    //readBySubject not ready yet
    echo json_encode("{'data':{'result':'Read by subject not ready yet'}}");
    $result = "";
    die;

} else {
    $table = "journal";
    $result = $journal->readAll();
}


/** Process the results and return as JSON */
$rows = $result->rowCount();

if ($rows > 0) {
    $responseArray = array();
    $responseArray['data'] = array();


    
    while ($rows = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($rows);
        if ($table == "journal") {
            $responseEntry = array(
                'id' => $id
                , 'date' => $dateOfEntry
                , 'subject' => $subject_description
                , 'subject_ID' => $subject
                , 'entry' => html_entity_decode($entry)
            );
            
        } else if ($table = "subject") {
            $responseEntry = array(
                'id' => $id,
                'category' => $category
            );
            //  echo json_encode($responseEntry);
        }

        array_push($responseArray['data'], $responseEntry);
    }

    echo json_encode($responseArray);
} else {
    echo json_encode('{"data":{"result":"There were no results"}}');
}

?>