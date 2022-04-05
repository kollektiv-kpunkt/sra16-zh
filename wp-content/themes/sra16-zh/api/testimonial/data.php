<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Testimonial Creation", "Final", $data["uuid"]);
}

global $wpdb;

$result = $wpdb->insert("wp_testimonials", [
    "uuid" => $data["uuid"],
    "testimonial_picture" => $data["testimonial_picture"],
    "testimonial" => $data["testimonial"],
    "fname" => $data["fname"],
    "lname" => $data["lname"],
    "position" => $data["position"],
    "email" => $data["email"],
    "over18" => $data["over18"],
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
    <p>vielen Dank für deine Unterstützung des Stimmrechtsalters 16 und danke, dass du dein Testimonial auf möglichst vielen Kanälen mit all deinen Freund*innen teilst!</p>
    <p>Solltest du uns noch weiter unterstützen können, wären wir dir <a href="{$actual_link}/spenden">für eine Spende ausgesprochen dankbar</a>.</p>
    <p>Viele Grüße,<br>
    <b>Das Kampagnenteam</b></p>
<div>
EOD;

global $mail;
$mail->setFrom('info@sra16-zh.ch');
$mail->addAddress($data["email"], "{$data["fname"]} {$data["lname"]}");
$mail->isHTML(true);
$mail->Subject = "Danke für deine Unterstützung!";
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
        "uuid" => $data["uuid"],
        "code" => 200
    ]
);
exit;