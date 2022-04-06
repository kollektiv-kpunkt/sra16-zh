<div class="testimonial-wrapper">
    <form id="testimonial-form" class="mt-4">
        <div class="form-step-container" data-testimonial-step="1">
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
                    <textarea name="testimonial" class="autoresize" id="testimonial" row="3" maxlength="150">Ich sage ja zum Stimmrechtsalter 16, weil...</textarea>
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
                <p class="mb-4">Aktuell ist es noch nicht möglich, ein Testimonial ohne Foto abzugeben (Folgt).</p>
                <div class="input-wrapper file" id="upload-button-wrapper">
                    <a href="3" onclick="return false;"; class="sra-button sra-button-arrow">Bild hochladen</a>
                    <input type="file" name="testimonial-picture" id="testimonial-picture" />
                </div>
                <img src="" alt="" id="cropper-testimonial-img">
                <a href="#" id="cropper-testimonial-button" class="sra-button sra-button-arrow mt-4" style="display: none">Testimonial erstellen</a>
            </div>
        </div>
    </form>
    <div id="testimonial-presentation-container" hidden>
        <p class="mb-7">Hier ist dein Testimonial:</p>
        <img src="#" alt="Your Testimonial">
        <a href="#" onclick="return false" class="sra-button sra-button-arrowdown mt-7">Testimonial herunterladen</a>
    </div>
</div>