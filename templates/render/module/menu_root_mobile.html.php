<?php
$html = <<<XYZ
<nav class="menu_root_container">
    <a class="mdc-list-item current" href="{$utility->getUrlRoot()}/../templates/render/index.html.php?pageAction=material_design">
        <span>Home</span>
        <i class="mdc-list-item__graphic material-icons parent_icon" style="visibility: hidden; width: 0;">toc</i>
    </a>
    <!--<div class="children_container">
        <a class="mdc-list-item target_clean" href="#">
            -&nbsp;<span>Children</span>
            <i class="mdc-list-item__graphic material-icons parent_icon" style="visibility: hidden; width: 0;">toc</i>
        </a>
    </div>-->
</nav>
XYZ;
echo $html;