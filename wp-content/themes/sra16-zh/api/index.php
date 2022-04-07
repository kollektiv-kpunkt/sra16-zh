<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter as Router;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();
header("Content-Type: application/json");

$mail = new PHPMailer(true);
global $mail;
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $_ENV["MAILSERVER"];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV["MAILUSER"];
    $mail->Password   = $_ENV["MAILPW"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $_ENV["MAILPORT"];
    $mail->CharSet = 'UTF-8';
} catch (Exception $e) {
    echo "Error setting up Email: {$mail->ErrorInfo}";
}


include_once __DIR__ . "/../../../../wp-load.php";

Router::get('/api/v1/freischalten/{uuid}', function($uuid) {
    include(__DIR__ . "/freischalten.php");
    exit;
});

Router::post('/api/v1/komitee/', function() {
    $mcapi = $_ENV["MCAPI"];
    $mclistid = $_ENV["MCLISTID"];
    $mcserver = $_ENV["MCSERVER"];
    $client = new \MailchimpMarketing\ApiClient();
    $client->setConfig([
        'apiKey' => $mcapi,
        'server' => $mcserver
    ]);

    $mtmpageid = $_ENV["MATOMOID"];
    $mtmurl = $_ENV["MATOMOURL"];
    $mtmtoken = $_ENV["MATOMOTOKEN"];
    $mtm = new MatomoTracker((int)$mtmpageid, $mtmurl);

    $mtm->setTokenAuth($mtmtoken);

    include(__DIR__ . "/komitee.php");
    exit;
});

Router::post('/api/v1/newsletter/', function() {
    $mcapi = $_ENV["MCAPI"];
    $mclistid = $_ENV["MCLISTID"];
    $mcserver = $_ENV["MCSERVER"];
    $client = new \MailchimpMarketing\ApiClient();
    $client->setConfig([
        'apiKey' => $mcapi,
        'server' => $mcserver
    ]);

    $mtmpageid = $_ENV["MATOMOID"];
    $mtmurl = $_ENV["MATOMOURL"];
    $mtmtoken = $_ENV["MATOMOTOKEN"];
    $mtm = new MatomoTracker((int)$mtmpageid, $mtmurl);

    $mtm->setTokenAuth($mtmtoken);

    include(__DIR__ . "/newsletter.php");
    exit;
});


Router::post('/api/v1/testimonial/picture', function() {
    require(__DIR__ . "/testimonial/picture.php");
    exit;
});

Router::get('/api/v1/testimonial/view/{uuid}', function($uuid) {
    header("Content-type: text/html");
    require(__DIR__ . "/testimonial/presentation.php");
    exit;
});

Router::get('/api/v1/testimonial/', function() {
    header("Content-type: text/html");
    require(__DIR__ . "/testimonial/list.php");
    exit;
});

Router::post('/api/v1/testimonial/data', function() {
    $mcapi = $_ENV["MCAPI"];
    $mclistid = $_ENV["MCLISTID"];
    $mcserver = $_ENV["MCSERVER"];
    $client = new \MailchimpMarketing\ApiClient();
    $client->setConfig([
        'apiKey' => $mcapi,
        'server' => $mcserver
    ]);

    $mtmpageid = $_ENV["MATOMOID"];
    $mtmurl = $_ENV["MATOMOURL"];
    $mtmtoken = $_ENV["MATOMOTOKEN"];
    $mtm = new MatomoTracker((int)$mtmpageid, $mtmurl);

    $mtm->setTokenAuth($mtmtoken);

    require(__DIR__ . "/testimonial/data.php");
    exit;
});


// Start the routing
Router::start();
?>