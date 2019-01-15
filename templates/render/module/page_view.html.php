<?php
ob_start();
include_once(dirname(__DIR__) . "/page_controller_action/material_design.html.php");
$obGetContents = ob_get_contents();
ob_end_clean();

$html = <<<XYZ
<div id="panel_id_2" class="module_clean">
    <div class="mdc-typography--body2">
        <div class="page_container user_select_text">
            <div class="header">
                <h1 class="mdc-typography--headline6">{$_SESSION['page_title']}</h1>
            </div>
            <div class="argument">
                <p>{$_SESSION['page_argument']}</p>
            </div>
            <div class="controllerAction">
                {$obGetContents}
            </div>
        </div>
    </div>
    <div class="mdc-card__actions">
        <div class="page_footer">
            <div class="mdc-typography--caption page_detail">
                <p>
                    <i class="material-icons md-14">pets</i> <span class="mdc-theme--on-surface">Edited from: </span>cimo
                </p>
                <p>
                    <i class="material-icons md-14">calendar_today</i> <span class="mdc-theme--on-surface">Edited on: </span>0000-00-00 [00:00:00]
                </p>
            </div>
        </div>
    </div>
</div>
XYZ;
echo $html;