<?php
$copres = [
    [
        "name" => "Sonja Gehrig",
        "party" => "GLP",
        "function" => "Kantonsrätin",
        "image" => "sonja_gehrig.jpg"
    ],
    [
        "name" => "Dominic Täubert",
        "party" => "",
        "function" => "Co-Präsident Junge EVP CH",
        "image" => "Taeubert_Dominic.jpg"
    ],
    [
        "name" => "Nicola Yuste",
        "party" => "SP",
        "function" => "Kantonsrätin",
        "image" => "Nicola_Juste.jpg"
    ],
    [
        "name" => "Julian Croci",
        "party" => "",
        "function" => "GL-Mitglied Grüne / Vorstandsmitglied Junge Grüne",
        "image" => "Julian_Groci.jpg"
    ],
    [
        "name" => "Mike Halbheer",
        "party" => "",
        "function" => "Co-Präsident Die Junge Mitte ZH",
        "image" => "Mike_Halbheer.jpg"
    ],
    [
        "name" => "Florian Fuss",
        "party" => "",
        "function" => "Vorstandsmitglied JGLP",
        "image" => "Florian-Fuss.jpg"
    ],
    [
        "name" => "Laura Fischer",
        "party" => "",
        "function" => "Co-Präsidentin JUSO Kanton Zürich",
        "image" => "Laura_Fischer.jpg"
    ],
    [
        "name" => "Anne-Claude Hensch",
        "party" => "AL",
        "function" => "Kantonsrätin",
        "image" => "Anne-Claude_Hensch.jpg"
    ],
    [
        "name" => "Nicolo Carle",
        "party" => "",
        "function" => "Co-Präsident Jugenparlament",
        "image" => "Nicolo_Carle.jpg"
    ],
];
?>


<div class="komitee-copres-wrapper">
    <h2 class="text-3xl">Co-Präsidium</h2>
    <div class="komitee-copres-inner flex gap-6 flex-wrap justify-center">
        <?php
        foreach ($copres as $key => $copre) : ?>
        <div class="sra-member">
            <div class="sra-member-inner flex flex-col gap-2">
                <div class="sra-member-image">
                    <img src="<?= get_template_directory_uri() ?>/public/presidency/<?= $copre["image"] ?>" alt="">
                </div>
                <div class="sra-member-info">
                    <h3 class="text-xl mb-1 leading-none"><?= $copre["name"] ?></h3>
                    <p class="text-sm"><?= $copre["function"] ?><?php if ($copre["party"] != ""): ?>, <?= $copre["party"] ?> <?php endif; ?></p>
                </div>
            </div>
        </div>
        <?php
        endforeach;
        ?>
    </div>
</div>