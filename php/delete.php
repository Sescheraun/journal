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
    **                     Get and add the data to the objects                     **
    ********************************************************************************/ 
    $id = $_POST["id"];
    $journal->id = $id;

    /********************************************************************************
    **                     process the data into the Database                      **
    ********************************************************************************/     
    if ($journal->delete()) {
        echo json_encode('{"data":{"result":"Post was deleted"}}');
    } else {
        echo json_encode('{"data":{"ERROR":"Post was not deleted"}}');
    }
?>