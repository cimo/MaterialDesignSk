<?php
$html = <<<XYZ
<div class="error_page">
    <p class="mdc-typography--headline1">1</p>
    <p class="mdc-typography--headline3">2</p>
    <a class="mdc-button mdc-button--dense mdc-button--raised" href="{$this->helper->getUrlRoot()}" type="button">Home</a>
</div>
<script nonce="{$_SESSION['xssProtectionValue']}">
    "use strict";

    window.addEventListener("DOMContentLoaded", (event) => {
        document.querySelector("body .column_left_container").remove();
        document.querySelector("body .column_right_container").remove();
        document.querySelector("body .column_center_container").className = "mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--span-12-tablet column_center_container";
    }, false);
</script>
XYZ;
echo $html;