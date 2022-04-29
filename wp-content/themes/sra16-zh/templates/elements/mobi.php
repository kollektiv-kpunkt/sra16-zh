<?php
if ($args["url"]) {
    $url = $args["url"];
} else {
    $url = get_permalink();
}
$message = $args["message"];
$message_ch = "";
if (isset($args["message_ch"])) {
    $message_ch = $args["message_ch"];
}
?>

<div id="sra-mobi-container" class="mt-8">
    <h3 class="text-3xl mb-1">Hilf mit!</h3>
    <p>Wir haben dir hier einen kleinen Text vorbereitet, welchen du an dein Umfeld weiterschicken kannst. Danke für deine Unterstützung!</p>
    <div class="mt-5" id="sra-mobimessage" data-autoresize data-mobi-url="<?= $url ?>">
        <div id="sra-msg-de" contenteditable="true"><?= substr($message,8,-8) ?></div>
        <div id="sra-msg-ch" contenteditable="true" hidden><?= substr($message_ch,8,-8) ?></div>
        <?php
        if (isset($args["message_ch"])) : ?>
        <span id="sra-mobi-changelang" data-mobi-lang="de" class="text-xs p-1">CH-Deutsch</span>
        <?php
        endif;
        ?>
    </div>
    <div id="sra-mobi-buttons" class="flex flex-wrap gap-2 mt-3">
        <button id="sra-mobi-whatsApp" data-type="whatsapp" class="sra-button">Auf WhatsApp teilen</button>
        <button id="sra-mobi-telegram" data-type="telegram" class="sra-button">Auf Telegram teilen</button>
        <button id="sra-mobi-facebook" data-type="facebook" class="sra-button">Auf Facebook teilen</button>
        <button id="sra-mobi-twitter" data-type="twitter" class="sra-button">Auf Twitter teilen</button>
        <button id="sra-mobi-copy" data-type="copy" class="sra-button">Nachricht kopieren</button>
        <button id="sra-mobi-email" data-type="email" class="sra-button sra-button-sec">Per Email teilen</button>
    </div>
</div>