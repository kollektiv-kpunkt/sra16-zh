<div id="donation-widget" class="mt-8"></div>
<script src="https://tamaro.raisenow.com/berpa-0798/latest/widget.js"></script>
<script>
window.rnw.tamaro.runWidget('#donation-widget', {
    language: 'de',
    testMode: false,
    debug: false,
    purposes: ['p1'],
    translations: {
        de: {
            purposes: {
                p1: 'Kampagne zum Stimmrechtsalter 16',
            },
        },
    },
})
</script>

<style>

html.ds-1 {
    --rnw-color-primary: var(--color30);
    --rnw-color-secondary: var(--color10);
    --rnw-color-ter: var(--color30);
}

html.ds-2 {
    --rnw-color-primary: var(--color60);
    --rnw-color-secondary: var(--color30);
    --rnw-color-ter: var(--color60);
}

html.ds-3 {
    --rnw-color-primary: var(--color60);
    --rnw-color-secondary: var(--color10);
    --rnw-color-ter: var(--color60);
}

html.ds-4 {
    --rnw-color-primary: var(--color60);
    --rnw-color-secondary: var(--color30);
    --rnw-color-ter: var(--color60);
}

html.ds-5 {
    --rnw-color-primary: var(--color10);
    --rnw-color-secondary: var(--color30);
    --rnw-color-ter: var(--color10);
}

:root {
    --tamaro-primary-color: var(--rnw-color-primary);
    --tamaro-primary-bg-color: var(--rnw-color-secondary);
    --tamaro-border-color: var(--rnw-color-ter);
}
</style>