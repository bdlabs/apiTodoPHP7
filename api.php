<?php
declare (strict_types = 1);

include './SimpleDB.php';
include './MyApi.php';

$method = $_SERVER['REQUEST_METHOD'];
$query = $_SERVER['QUERY_STRING'];
$input = file_get_contents('php://input');
$input = trim($input);

$db = new SimpleDB('./database.txt');
$myapi = MyApi::getInstance();

$myapi->register("/todo/list", eMyApiMethods::GET, function (array $args) use ($db): string{
    return json_encode(array("status" => "ok", "result" => $db->select()));
});

$myapi->register("/todo/add", eMyApiMethods::PUT, function (array $args) use ($db): string {
    if (!is_string($args['input'])) {
        return json_encode(array("status" => "Wrong format"));
    }

    $db->insert(array("label" => $args['input'], "done" => 0));
    return json_encode(array("status" => "ok"));
});

$myapi->register("/todo/remove", eMyApiMethods::DELETE, function (array $args) use ($db): string {
    if (!is_numeric((int) $args['input'])) {
        return json_encode(array("status" => "Wrong format"));
    }

    if (empty($db->select((int) $args['input']))) {
        return json_encode(array("status" => "Id is Wrong"));
    }

    $db->delete((int) $args['input']);
    return json_encode(array("status" => "ok"));
});

$myapi->register("/todo/mark-as-don", eMyApiMethods::POST, function (array $args) use ($db): string {
    if (!is_numeric((int) $args['input'])) {
        return json_encode(array("status" => "Wrong format"));
    }

    $record = $db->select((int) $args['input']);

    if (empty($record)) {
        return json_encode(array("status" => "Id is Wrong"));
    }

    $record['done'] = 1;
    $record = $db->update((int) $args['input'], $record);

    return json_encode(array("status" => "ok"));
});

header('Content-Type: application/json');

if ($query != "") {
    echo $myapi->call($query, $method, array("input" => $input));
} else {
    echo json_encode(array("status" => "error - Wrong format"));
}
