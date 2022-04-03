<div class="HeroineWrapper">
    <div id="heroine-inner">
        <div id="heroine-bg-container">
            <img src="<?= get_template_directory_uri() ?>/public/heroines/florine_bg.jpg">
        </div>
        <div id="heroine-hash-container">
            <?php
            get_template_part( "templates/partials/hash");
            ?>
        </div>
        <div id="heroine-vignette-container">

        </div>
        <div id="heroine-img-container">
            <div id="heroine-img-wrapper">
                <div id="heroine-img-inner">
                    <img src="<?= get_template_directory_uri() ?>/public/heroines/florine_heroine.png">
                </div>
            </div>
        </div>
        <div id="heroine-content-container" class="flex flex-col justify-center">
            <div class="largeContainer">
                <div id="heroine-content-inner">
                    <div id="heroine-content-title-container">
                        <div class="heroine-content-title"><h1>Stimme für</h1></div>
                        <div class="heroine-content-title"><h1>meine Stimme</h1></div>
                        <p class="font-bold text-2xl text-white">Am 15. Mai stimmen wir im Kanton Zürich über die Einführung des Stimm- und Wahlrechtsalter 16 ab. Wir sind bereit – seid ihr es auch?</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="#argumente" class="sra-button sra-button-arrowdown" id="more-button">Mehr erfahren</a>
    </div>
</div>