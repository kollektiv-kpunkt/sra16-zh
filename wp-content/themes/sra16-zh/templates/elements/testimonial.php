<?php
$Browser = new foroco\BrowserDetection();
$useragent = $_SERVER['HTTP_USER_AGENT'];
$browserAgent = $Browser->getBrowser($useragent);
?>

<div class="testimonial-wrapper"<?= ($browserAgent["browser_safari_original"]) ? " data-browser='fuckusafari'" : ""; ?>>
    <form id="testimonial-form" class="mt-4">
        <div class="form-step-container" data-testimonial-step="1">
            <?php
            if ($browserAgent["browser_safari_original"]): ?>
                <p class="text-xs mb-4 text-neutral-500">Wir haben bemerkt, dass du Safari benutzt. Das <i>kann</i> zu Problemen mit deinem Testimonial führen. Falls es nicht funktioniert, versuch es bitte mit einem anderen Browser.</p>
            <?php
            endif;
            ?>
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
                    <input type="text" name="position" id="position" required>
                </div>
                <div class="input-wrapper flex flex-col gap-2">
                    <label for="email">E-Mail Adresse</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-wrapper checkbox fullwidth">
                    <input type="checkbox" name="over18" id="over18" checked>
                    <label for="over18">Bist du über 18 Jahre alt?</label>
                </div>
                <div class="input-wrapper textarea fullwidth flex flex-col gap-2">
                    <label for="testimonial">Zitat</label>
                    <textarea name="testimonial" class="autoresize" id="testimonial" row="3" maxlength="150" required>Ich sage Ja zum Stimmrechtsalter 16, weil </textarea>
                </div>
                <div class="input-wrapper checkbox fullwidth">
                    <input type="checkbox" name="optin" id="optin" checked>
                    <label for="optin" class="text-xs">Ich bin einverstanden, dass das Komitee mich auf dem Laufenden hält.</label>
                </div>
                <div class="input-wrapper">
                    <button type="submit" class="sra-button sra-button-arrow">Weiter</button>
                </div>
            </div>
        </div>
        <div class="form-step-container" data-testimonial-step="2" hidden>
            <div class="form-wrapper">
                <h3 class="mt-7">Lade bitte hier ein Foto von dir hoch</h3>
                <div class="input-wrapper file" id="upload-button-wrapper">
                    <a href="3" onclick="return false;"; class="sra-button sra-button-arrow">Bild hochladen</a>
                    <input type="file" name="testimonial-picture" id="testimonial-picture" accept=".jpeg,.jpg,.png,.webP,.tiff"/>
                </div>
                <img src="" alt="" id="cropper-testimonial-img">
                <a href="#" id="cropper-testimonial-button" class="sra-button sra-button-arrow mt-4" style="display: none">Testimonial erstellen</a>
            </div>
        </div>
    </form>
    <div id="testimonial-presentation-container" hidden>
        <h3 class="mt-7">Hier ist dein Testimonial:</h3>
        <div id="testimonial-container">
            <div id="testimonial-bg-container">
                <?php
                echo file_get_contents(__DIR__ . "/../../public/testimonial-elements/bg.svg");
                ?>
            </div>
            <div id="testimonial-wrapper" class="flex justify-between">
                <div id="testimonial-img-container">
                    <div id="testimonial-img-inner">
                        <img src="" alt="" id="testimonial-img">
                        <div id="testimonial-img-blind"></div>
                        <div id="testimonial-img-bg"></div>
                    </div>
                </div>
                <div id="testimonial-content-container" class="flex">
                    <div id="testimonial-content-inner" class="my-auto">
                        <p class="font-bold" id="testimonial-quote"><i></i></p>
                        <p class="testimonial-subtitle" id="testimonial-name"><b></b></p>
                        <p class="testimonial-subtitle" id="testimonial-position"></p>
                    </p>
                    </div>
                </div>
            </div>
            <div id="testimonial-logo-container">
                <?php
                get_template_part( "templates/partials/logo" );
                ?>
            </div>
            <div id="testimonial-slogan-container">
                <p class="testimonial-slogan" id="testimonial-slogan-1"></p>
                <p class="testimonial-slogan" id="testimonial-slogan-2"></p>
            </div>
        </div>
        <a href="#" id="testimonial-change-ds" class="sra-button mt-3">Farbschema wechseln</a>
        <a href="#" id="testimonial-download" class="sra-button sra-button-arrowdown mt-3">Testimonial herunterladen</a>
    </div>
</div>

<div id="testimonial-loader-blind">
    <div id="testimonial-loader-inner">
        <p class="text-2xl text-white">Dein Testimonial wird geladen...</p>
    </div>
</div>