<?php
$orgas = array_values(array_filter(scandir(__DIR__ . "/../../public/orgas"), function($var) {
    return !(substr( $var, 0, 1 ) === ".");
}));
?>


<div class="komitee-orga-wrapper">
    <h2 class="text-3xl mb-0">Organisationen</h2>
    <div class="komitee-orga-inner flex gap-4 flex-wrap">
        <?php
        foreach ($orgas as $key => $orga) : ?>
        <img class="orga-logo" src="<?= get_template_directory_uri(  )?>/public/orgas/<?= $orga ?>">
        <?php
        endforeach
        ?>
    </div>
</div>