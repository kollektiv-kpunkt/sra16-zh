<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if ($data["stored_customer_email"]) {
    try {
        $response = $client->lists->createListMemberNote(
            $mclistid,
            strtolower(md5($data["stored_customer_email"])),
            [
                "note" => "Donation Amount: {$data["datatrans_amount"]} {$data["datatrans_currency"]} / Donation ID: {$data["epp_transaction_id"]}",
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
    echo(json_encode(
        [
            "status" => "success",
            "message" => "Donation logged successfully.",
            "code" => 200
        ]
    ));
} else {
    exit;
}