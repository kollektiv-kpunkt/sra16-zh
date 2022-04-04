<?php
global $db;
$stmt = $db->prepare("SELECT * FROM supporters;");
$stmt->execute();
$suppoters = $stmt->fetchAll();
?>

<div class="komitee-wrapper">
    <p class="text-xl">Ausserdem unterstützen folgende Personen das Stimmrechtsalter 16:</p>
    <p class="text-sm"><?php
    $i = 0;
    foreach ($suppoters as $suppoter): ?>

    <b><?= $suppoter["fname"] ?> <?= $suppoter["lname"] ?>,</b> <?= $suppoter["position"] ?><?= ($i < count($suppoters) - 1) ? ";" : "" ?>

    <?php
    $i++;
    endforeach;
    ?>
    </p>
</div>