<?php
// https://api.raisenow.com/epayment/api/berpa-5734/transactions/search?sort[0][field_name]=created&sort[0][order]=desc&filters[0][field_name]=stored_campaign_name&filters[0][type]=fulltext&filters[0][value]=Allgemeines%20Spendenformular&filters[1][field_name]=last_status&filters[1][type]=term&filters[1][value]=final_success
// Make PHP Curl Get Request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.raisenow.com/epayment/api/berpa-5734/transactions/search?sort[0][field_name]=created&sort[0][order]=desc&filters[0][field_name]=stored_campaign_name&filters[0][type]=fulltext&filters[0][value]=fundraising_form&filters[1][field_name]=last_status&filters[1][type]=term&filters[1][value]=final_success");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_USERPWD, $_ENV["RNWAPIUSER"] . ":" . $_ENV["RNWAPIPW"]);
$transactions = json_decode(curl_exec($ch), true)["result"]["transactions"];

$sum = 0;
$goal = 0;
$count = 0;

if($transactions) {
    foreach ($transactions as $transaction) {
        $sum += $transaction["amount"];
        $count++;
    }
}


$sum = $sum / 100;
$sum += 360;



if ($sum > 7500) {
    $sum = 7500;
}
if ($sum > 5000) {
    $goal = 7500;
} else if ($sum > 3000) {
    $goal = 5000;
} else if ($sum > 1000) {
    $goal = 3000;
} else {
    $goal = 1500;
}

$milestones = [
    [
        "id" => 0,
        "title" => "700 Sticker drucken und verschenken",
        "value" => "100"
    ],
    [
        "id" => 1,
        "title" => "650 Menschen auf Google erreichen",
        "value" => "250"
    ],
    [
        "id" => 2,
        "title" => "5'000 Flyer drucken und verteilen",
        "value" => "500"
    ],
    [
        "id" => 3,
        "title" => "175 Aussenplakate drucken und aufstellen",
        "value" => "1000"
    ],
    [
        "id" => 4,
        "title" => "17 der konservativsten Gemeinden in Zürich beflyern",
        "value" => "2000"
    ],
    [
        "id" => 5,
        "title" => "Inserat im «20 Minuten»",
        "value" => "4670"
    ],
];

$i=0;
foreach ($milestones as $milestone) {
    if ($sum >= $milestone["value"]) {
        $milestones[$i]["reached"] = true;
    } else {
        $milestones[$i]["reached"] = false;
    }
    $i++;
}

$currentId = array_values(array_filter($milestones, function($milestone) {
    return $milestone['reached'] == false;
}))[0]["id"];

$percentage = round(($sum - $milestones[$currentId - 1]["value"]) / ($milestones[$currentId]["value"] - $milestones[$currentId - 1]["value"]) * 100, 2);
?>


<div id="sra-fundraising-container" class="mt-10">
    <div id="sra-fundraising-milestones">
        <h1 class="text-4xl">Unsere Meilensteine:</h1>
        <?php
        foreach ($milestones as $milestone) :
        ?>
        <?php
        if ($milestone["id"] == $currentId): ?>
            <div id="sra-fundraising-counter-container" class="mt-8 mb-4" style="--goal: <?= $percentage ?>%">
                <div id="sra-fundraising-counter-upper" class="flex justify-between">
                    <div class="sra-fundraising-counter-number text-sm text-neutral-500" id="sra-fundraising-counter-start">CHF <?= number_format($milestones[$currentId-1]["value"], 0,"","'") ?></div>
                    <div class="sra-fundraising-counter-number text-sm text-neutral-500" id="sra-fundraising-counter-goal">CHF <?= number_format($milestone["value"], 0,"","'") ?></div>
                </div>
                <div id="sra-fundraising-counter-lower" class="mt-2">
                    <div id="sra-fundraising-bar-outer" class="flex">
                        <div id="sra-fundraising-bar-inner"></div>
                        <div id="sra-fundraising-bar-percentage" class="text-xs leading-none<?= ($percentage > 20) ? " percentage-left" : "" ?>"><?= $percentage ?>%</div>
                    </div>
                </div>
            </div>
        <?php
        endif;
        ?>
        <div class="sra-fundraising-milestone-wrapper px-4 mb-4<?= ($milestone["id"] == $currentId) ? " current-milestone" : "" ?><?= ($milestone["reached"]) ? " milestone-reached" : "" ?>">
            <p class="text-xl leading-none sra-fundraising-milestone"><b>CHF <?= number_format($milestone["value"], 0,"","'") ?>:</b> <?= $milestone["title"] ?></p>
            <span class="sra-fundraising-milestone-tag text-xs leading-none p-1"><?= ($milestone["reached"]) ? "Meilenstein erreicht!" : "" ?><?= ($milestone["id"] == $currentId) ? "Aktueller Meilenstein!" : "" ?></span>
        </div>
        <?php
        endforeach;
        ?>
    </div>
    <div id="sra-fundraising-donation-container" class="mt-16">
        <h2 class="text-3xl">Hilf auch mit unsere Ziele zu erreichen!</h2>
        <div id="donation-widget" class="mt-8"></div>
    </div>
</div>


<style>

html.ds-1 {
    --rnw-color-primary: var(--color30);
    --rnw-color-secondary: var(--color10);
    --rnw-color-ter: var(--color30);
}

html.ds-2 {
    --rnw-color-primary: var(--color60);
    --rnw-color-secondary: var(--color30);
    --rnw-color-ter: var(--color60);
}

html.ds-3 {
    --rnw-color-primary: var(--color60);
    --rnw-color-secondary: var(--color10);
    --rnw-color-ter: var(--color60);
}

html.ds-4 {
    --rnw-color-primary: var(--color60);
    --rnw-color-secondary: var(--color30);
    --rnw-color-ter: var(--color60);
}

html.ds-5 {
    --rnw-color-primary: var(--color10);
    --rnw-color-secondary: var(--color30);
    --rnw-color-ter: var(--color10);
}

:root {
    --tamaro-primary-color: var(--rnw-color-primary);
    --tamaro-primary-bg-color: var(--rnw-color-secondary);
    --tamaro-border-color: var(--rnw-color-ter);
}
</style>



<script src="https://tamaro.raisenow.com/berpa-0798/latest/widget.js"></script>
<script>
window.rnw.tamaro.runWidget('#donation-widget', {
    language: 'de',
    testMode: false,
    debug: false,
    purposes: ['p1'],
    translations: {
        de: {
            purposes: {
                p1: 'Kampagne zum Stimmrechtsalter 16',
            },
        },
    },
    paymentFormPrefill: {
    stored_campaign_name: "fundraising_form"
    }
})
</script>