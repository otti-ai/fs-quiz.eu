<?php
if(isset($data) && $data != null){
    //if(count($data)>0){
        $status = 200;
}else{
    $data = array();
}

$typ = isset($_GET["type"]) ? $_GET["type"] : "json";
$status = isset($status) ? $status : 501;

if ($status>200){
    switch ($status) {
        case 202:
            $error = "Accepted";
            break;
        case 204:
            $status = 404;
            $error = "Content not found";
            break;
        case 400:
            $error = "Bad Request";
            break;
        case 401:
            $error = "Unauthorized";
            break;
        case 403:
            $error = "Forbidden";
            break;
        case 404:
            $error = "Not Found";
            break;
        case 429:
            $error = "Too Many Requests";
            break;
        case 500:
            $error = "Internal Server Error";
            break;
        case 501:
            $error = "Not Implemented";
            break;
    }
}

if (isset($error)){
    $data += array (
        'status' => array (
           'code' => $status,
           'massage' => $error
           ),
        );
}
//print
http_response_code($status);
switch ($typ) {
    case "csv":
        //header('Content-Type: application/csv');
        //echo array2csv($list);
        break;
    case "xml":
        header('Content-Type: application/xml');
        $xml = new SimpleXMLElement('');
        array_walk_recursive($array, array ($xml,'addChild'));
        print $xml->asXML();
        break;
    default:
        header('Content-Type: application/json');
        echo json_encode($data);
}
?>