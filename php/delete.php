<?php 
    /********************************************************************************
    **                                   Header                                    **
    **                                and Includes                                 **
    ********************************************************************************/        
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once("Database.php");
    include_once('Journal.php');
    include_once('Subject.php');
    include_once('User.php');

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
    $user = new User($db);

    /********************************************************************************
    **                       Validate the user's credentials                       **
    ********************************************************************************/ 
    $user->userName = $_POST["userName"];
    $user->password = $_POST["password"];
    
    /********************************************************************************
    **                     Get and add the data to the objects                     **
    ********************************************************************************/ 
    $id = $_POST["id"];
    $journal->id = $id;

    /********************************************************************************
    **                     process the data into the Database                      **
    ********************************************************************************/     
    if ($user->readUsers()){
        if ($journal->delete() ) {
            echo json_encode('{"data":{"result":"Post was deleted"}}');
        } else {
            echo json_encode('{"data":{"result":"Post was not deleted"}}');
        }
    } else {
        echo json_encode('{"data":{"result":"Bad credentials.  Post was not deleted"}}');
    }
?>