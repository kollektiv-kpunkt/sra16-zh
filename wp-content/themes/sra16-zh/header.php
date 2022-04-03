<!DOCTYPE html>
<html lang="<?= get_language_attributes() ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <?php
    wp_head();
    ?>
</head>
<body>
    <?php
    get_template_part( "templates/partials/navbar" );
    ?>
    <div id="main-content">