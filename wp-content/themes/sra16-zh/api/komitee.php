<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Komitee Signup", "Final", $data["uuid"]);
}

global $wpdb;

if ($wpdb->query($wpdb->prepare("SELECT * from `wp_supporters` WHERE `email` = %s", array($data["email"]))) != 0) {
    echo json_encode(array("status" => "error", "message" => "Diese E-Mail Adresse wurde bereits verwendet!"));
    exit;
}

$result = $wpdb->insert("wp_supporters", [
    "uuid" => $data["uuid"],
    "fname" => $data["fname"],
    "lname" => $data["lname"],
    "position" => $data["position"],
    "email" => $data["email"],
    "optin" => $data["optin"]
]);

if ($result != 1) {
    echo json_encode(
        [
            "status" => "error",
            "message" => "Da ist etwas schief gelaufen, bitte versuch es nochmals.",
            "code" => 501
        ]);
    exit;
}

if ($data["optin"]) {
    try {
        $response = $client->lists->setListMember($mclistid, strtolower(md5($data["email"])), [
            "email_address" => $data["email"],
            'merge_fields' => [
                    "FNAME" => $data["fname"],
                    "LNAME" => $data["lname"]
            ],
            'tags' => ["Komitee"],
            "status" => "subscribed",
        ]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
    $return = [
      "status" => "error",
      "message" => "Da ist etwas schief gelaufen, bitte versuch es nochmals.",
      "content" => $e->getResponse()->getBody()->getContents(),
      "errors" => [$e->getMessage()]
    ];
    echo json_encode($return);
    exit;
    }

    try {
        $response = $client->lists->createListMemberNote(
            $mclistid,
            strtolower(md5($data["email"])),
            [
                "note" => "Form submission: " . $data["uuid"]
            ]
        );
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $return = [
        "sucess" => false,
        "content" => $e->getResponse()->getBody()->getContents(),
        "errors" => [$e->getMessage()]
        ];
        echo json_encode($return);
        exit;
    }
}

$emailcontent = <<<EOD
<div style="font-family: sans-serif">
    <p>Hallo {$data["fname"]} {$data["lname"]},</p>
    <p>vielen Dank f??r deine Unterst??tzung des Stimmrechtsalters 16! Wir werden deinen Eintrag im Komitee so bald wie m??glich freischalten.</p>
    <p>Solltest du uns noch weiter unterst??tzen k??nnen, w??ren wir dir <a href="{$actual_link}/spenden">f??r eine Spende ausgesprochen dankbar</a>.</p>
    <p>Viele Gr????e,<br>
    <b>Das Kampagnenteam</b></p>
<div>
EOD;

global $mail;
$mail->setFrom('info@sra16-zh.ch');
$mail->addAddress($data["email"], "{$data["fname"]} {$data["lname"]}");
$mail->isHTML(true);
$mail->Subject = "Danke f??r deine Unterst??tzung!";
$mail->Body    = $emailcontent;

try {
    $mail->send();
} catch (Exception $e) {
    $return = [
      "status" => "error",
      "message" => "Da ist etwas schief gelaufen, bitte versuch es nochmals.",
      "errors" => $mail->ErrorInfo
    ];
    echo json_encode($return);
    exit;
}

$emailcontent = <<<EOD
<div style="font-family: sans-serif">
    <p>Hallo!</p>
    <p>Es gab einen neuen Eintrag ins Komitee vom Stimmrechtsalter 16.</p>
    <p>Bitte ??berpr??fe den Eintrag und schalte ihn frei, falls er g??ltig ist:</p>
    <ul>
        <li>Vorname: {$data["fname"]}</li>
        <li>Nachname: {$data["lname"]}</li>
        <li>Position: {$data["position"]}</li>
        <li>E-Mail: {$data["email"]}</li>
        <li>Opt-In: {$data["optin"]}</li>
    </ul>
    <p>Falls du den Eintrag freischalten m??chtest, kannst du das hier tun: <a href="{$actual_link}/api/v1/freischalten/{$data["uuid"]}">{$actual_link}/api/v1/freischalten/{$data["uuid"]}</a></p>
    <p>Viele Gr????e,<br>
    <b>Timothy</b></p>
<div>
EOD;


$mail->setFrom('info@sra16-zh.ch');
$mail->clearAllRecipients( );
$mail->addAddress($_ENV["ADMINEMAIL"]);
$mail->isHTML(true);
$mail->Subject = "Neuer Eintrag im Komitee: {$data["fname"]} {$data["lname"]}";
$mail->Body    = $emailcontent;

try {
    $mail->send();
} catch (Exception $e) {
    $return = [
      "status" => "error",
      "message" => "Da ist etwas schief gelaufen, bitte versuch es nochmals.",
      "errors" => $mail->ErrorInfo
    ];
    echo json_encode($return);
    exit;
}


echo json_encode(
    [
        "status" => "success",
        "message" => "Danke f??r deinen Eintrag! Wir werden ihn so schnell wie m??glich freischalten!",
        "code" => 200
    ]
);
exit;