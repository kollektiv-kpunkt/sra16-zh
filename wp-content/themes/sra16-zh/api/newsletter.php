<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("CtA Action", "Newsletter", $data["uuid"]);
}

if ($data["optin"]) {
    try {
        $response = $client->lists->setListMember($mclistid, strtolower(md5($data["email"])), [
            "email_address" => $data["email"],
            'merge_fields' => [
                    "FNAME" => $data["fname"]
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
echo json_encode(
    [
        "status" => "success",
        "message" => "Danke, dass du unseren Newsletter abonniert hast!",
        "code" => 200
    ]
);

?>