<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

$path = __DIR__ . "/../../public/testimonials/";
$name = uniqid("image_") . ".jpg";
$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data["croppedimage"]));
file_put_contents($path . $name, $data);

echo json_encode([
    "status" => "success",
    "imgurl" => "{$actual_link}/wp-content/themes/sra16-zh/public/testimonials/{$name}"
]);