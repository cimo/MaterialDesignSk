<?php
$_SESSION['pageTitle'] = "Page test";
$_SESSION['pageArgument'] = "Content test.";

$html = <<<XYZ
<script src="{$utility->getUrlRoot()}/javascript/page_action/PageActionTest.js")}}"></script>
XYZ;
echo $html;