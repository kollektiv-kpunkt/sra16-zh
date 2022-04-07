<?php
$supporters = $wpdb->get_results("SELECT * from `wp_supporters` WHERE `status` = 1 ORDER BY `fname` ASC", ARRAY_A);
?>

<div class="komitee-wrapper">
    <p class="text-xl">Ausserdem unterstützen folgende Personen das Stimmrechtsalter 16:</p>
    <p class="text-sm"><?php
    $i = 0;
    foreach ($supporters as $supporter): ?>

    <b><?= $supporter["fname"] ?> <?= $supporter["lname"] ?><?php if ($supporter["position"] && $supporter["position"] != ""): ?>,</b> <?= $supporter["position"] ?><?php endif; ?><?= ($i < count($supporters) - 1) ? ";" : "" ?>
    <?php
    $i++;
    endforeach;
    ?>
    </p>
    <div class="komitee-form-wrapper mt-10" id="beitreten">
        <h3 class="text-xl mb-2">Möchtest du dem Komitee beitreten?</h3>
        <p>Dann füll bitte dieses Formular aus:</p>
        <form id="komitee-form" class="mt-4">
            <div class="alertBar p-3 leading-none my-4" hidden>
            </div>
            <div class="form-wrapper flex flex-wrap gap-6 justify-end">
                <div class="input-wrapper flex flex-col gap-2">
                    <label for="fname">Vorname</label>
                    <input type="text" name="fname" id="fname" required>
                </div>
                <div class="input-wrapper flex flex-col gap-2">
                    <label for="lname">Nachname</label>
                    <input type="text" name="lname" id="lname" required>
                </div>
                <div class="input-wrapper flex flex-col gap-2">
                    <label for="position">Position (Beruf, Amt etc.)</label>
                    <input type="text" name="position" id="position" placeholder="optional">
                </div>
                <div class="input-wrapper flex flex-col gap-2">
                    <label for="email">E-Mail Adresse</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-wrapper checkbox fullwidth">
                    <input type="checkbox" name="optin" id="optin" checked>
                    <label for="optin" class="text-xs">Ich bin einverstanden, dass das Komitee mich auf dem Laufenden hält.</label>
                </div>
                <div class="input-wrapper">
                    <button type="submit" class="sra-button">Jetzt beitreten</button>
                </div>
            </div>
        </form>
    </div>
</div>