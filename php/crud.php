<?php
    require_once("subject.php");
    require_once("jornal.php");

    $httpVerb = $_SERVER('REQUEST_METHOD');

    switch($httpVerb)
    {
        case 'POST':
            return"{'category': 'create'}";
            break;
        
        case 'GET':
            return"{'category': 'read'}";
            break;

        case 'PUT':
            return"{'category': 'update'}";
            break;

        case 'delete':
            return"{'category': 'delete'}";
            break;
    }

>