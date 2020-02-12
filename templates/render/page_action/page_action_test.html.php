<?php
$_SESSION['pageTitle'] = "Page test";
$_SESSION['pageArgument'] = "Content test.";

$html = <<<XYZ
<script nonce="{$_SESSION['xssProtectionValue']}" src="{$helper->getUrlRoot()}/js/system/PageActionTest.js")}}"></script>
XYZ;
echo $html;