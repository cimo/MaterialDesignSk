<?php
$html = <<<XYZ
<script nonce="{$_SESSION['xssProtectionValue']}">
    url['testCustom'] = "";
</script>
XYZ;
echo $html;