<?php
$html = <<<XYZ
<aside class="mdc-dialog" role="alertdialog" aria-labelledby="my-mdc-dialog-label" aria-describedby="my-mdc-dialog-description">
    <div class="mdc-dialog__surface">
        <header class="mdc-dialog__header">
            <h2 class="mdc-dialog__header__title">Title</h2>
        </header>
        <section class="mdc-dialog__body">
            Content
        </section>
        <footer class="mdc-dialog__footer">
            <button class="mdc-button mdc-button--dense mdc-dialog__footer__button mdc-dialog__footer__button--cancel" type="button">Decline</button>
            <button class="mdc-button mdc-button--dense mdc-dialog__footer__button mdc-dialog__footer__button--accept" type="button">Accept</button>
        </footer>
    </div>
    <div class="mdc-dialog__backdrop"></div>
</aside>
XYZ;
echo $html;