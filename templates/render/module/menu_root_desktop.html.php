<?php
$html = <<<XYZ
<nav class="menu_root_container">
    <ul>     
        <li class="parent">
            <a class="target current" href="{$helper->getUrlRoot()}/../templates/render/index.html.php?pageAction=material_design">
                <span>Home</span>
                <i class="material-icons" style="visibility: hidden; width: 0;">keyboard_arrow_down</i>
            </a>
            <!--<div class="mdc-elevation--z8 parent_content">
                <div class="children_container">
                    <a class="mdc-list-item target_clean" href="#">
                        &nbsp;<span>Children</span>
                        <i class="mdc-list-item__graphic material-icons parent_icon" style="visibility: hidden; width: 0;">toc</i>
                    </a>
                </div>
            </div>-->
        </li>
    </ul>
</nav>
XYZ;
echo $html;