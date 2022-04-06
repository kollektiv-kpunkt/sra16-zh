<?php
$bodyclasses = [];
if (is_front_page()) {
    $design_system = "ds-1";
} else {
    $design_system = "ds-" . rand(1,5);
}

global $template;
array_push($bodyclasses, explode(".php", end(explode('/', $template)))[0]);


if (is_front_page()) {
    array_push($bodyclasses, 'home');
}
array_push($bodyclasses, $design_system);


?>

<!DOCTYPE html>
<html <?= get_language_attributes() ?> class="<?= $design_system ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <?php
    wp_head();
    ?>
</head>
<body class="<?php
        $i=0;
        foreach($bodyclasses as $bodyclass):
            echo($bodyclass);
            if ($i < count($bodyclasses)-1) {
                echo " ";
            }
            $i++;
        endforeach;
        ?>" data-ds="<?= $design_system ?>">
    <?php
    get_template_part( "templates/partials/navbar" );
    ?>
    <div id="main-content">