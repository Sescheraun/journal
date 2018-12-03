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

echo json_encode("{'data':{'result':'the call worked'}}");

?>