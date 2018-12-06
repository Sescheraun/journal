<?php 
    /********************************************************************************
    **                                   Header                                    **
    **                                and Includes                                 **
    ********************************************************************************/        


    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once("Database.php");
    include_once('Journal.php');
    include_once('Subject.php');

    /********************************************************************************
    **                       Initialize The Database connection                    **
    ********************************************************************************/        
    $dBase = new Database();
    $db = $dBase->getConnection();

    /********************************************************************************
    **                          Initialize The table objects                       **
    ********************************************************************************/ 
    $journal = new Journal($db);
    $subject = new Subject($db);

    /********************************************************************************
    **                       Get and add the data to the objects                   **
    ********************************************************************************/ 

    $id = $_POST["id"];
    $subject = $_POST["subject"];
    $entry = $_POST["entry"];

    $journal->subject = $subject;
    $journal->entry = $entry;
    $journal->id = $id;

    /********************************************************************************
    **                     process the data into the Database                      **
    ********************************************************************************/     

    if ($journal->update()) {
        echo json_encode('{"data":{"result":"Post was updated"}}');
    } else {
        echo json_encode('{"data":{"ERROR":"Post was not not"}}');
    }
?>