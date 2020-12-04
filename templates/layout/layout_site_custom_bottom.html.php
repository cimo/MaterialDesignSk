<?php
$html = <<<XYZ
<script nonce="{$_SESSION['xssProtectionValue']}">
    "use strict";
    
    window.url['testCustom'] = "";
</script>
XYZ;
echo $html;