<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

echo(json_encode($data));