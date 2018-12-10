<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');



include_once("Database.php");
include_once('User.php');



$dBase = new Database();
$db = $dBase->getConnection();

$user = new User($db);

$user->password = "password";
$user->userName = "userName";



$user->createUser();

echo "read user /n";

$user->readUser();

?>