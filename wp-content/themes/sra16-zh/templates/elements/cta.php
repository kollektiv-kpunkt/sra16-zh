<div id="mitmachen">
    <div class="ctaWrapper fullwidthContainer">
        <div class="my-28">
            <div class="cta-columns flex gap-12 mediumContainer">
                <div class="cta-img-container my-auto">
                    <div class="cta-img-wrapper">
                        <img src="<?= get_template_directory_uri()?>/public/cta.jpg" alt="" class="cta-img">
                        <div class="cta-img-gradient"></div>
                        <div class="cta-img-content scrollAnimation" data-delay="500"">
                            <h2 class="text-5xl">Wir sind bereit.</h2>
                            <h2 class="text-5xl">Du auch?</h2>
                        </div>
                    </div>
                </div>
                <div class="cta-action-container py-12 my-auto scrollAnimation" data-delay="500"">
                    <div class="cta-action-inner text-white">
                        <h1 class="text-5xl mb-4 text-white">Hilf mit!</h1>
                        <p class="text-2xl">Damit wir den Kanton Zürich von unserem Anliegen überzeugen können, sind wir auf den Einsatz von Menschen wie dir angewiesen. <b style="color: var(--color10)">Danke, dass du uns unterstützt!</b></p>
                    </div>
                    <div class="cta-buttons-container mt-8 flex flex-col gap-2">
                        <a href="/komitee#beitreten" class="sra-button">Komitee beitreten</a>
                        <a href="#" data-action="newsletter" class="sra-button sra-button-ter">Newsletter abonnieren</a>
                        <a href="/spenden" class="sra-button">Spenden</a>
                    </div>
                    <div class="cta-newsletter-container" hidden>
                        <form id="newsletter-form" class="mt-4">
                            <div class="alertBar p-3 leading-none my-4" hidden>
                            </div>
                            <div class="form-wrapper flex flex-wrap gap-6 justify-end">
                                <div class="input-wrapper flex flex-col gap-2">
                                    <label for="fname" class="text-white">Vorname</label>
                                    <input type="text" name="fname" id="fname" required>
                                </div>
                                <div class="input-wrapper flex flex-col gap-2">
                                    <label for="email" class="text-white">E-Mail Adresse</label>
                                    <input type="email" name="email" id="email" required>
                                </div>
                                <div class="input-wrapper checkbox fullwidth">
                                    <input type="checkbox" name="optin" id="optin" checked required>
                                    <label for="optin" class="text-xs text-white">Ich bin einverstanden, dass das Komitee mich auf dem Laufenden hält.</label>
                                </div>
                                <div class="input-wrapper">
                                    <button type="submit" class="sra-button">Jetzt beitreten</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>