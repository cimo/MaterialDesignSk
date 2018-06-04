<?php
$html = <<<XYZ
<form id="form_search_module" class="widget_search" action="#" method="post" novalidate="novalidate">
    <i class="material-icons mdc-top-app-bar__action-item button_open">search</i>
    <div>
        <input id="form_search_words" type="text" name="form_search[words]" value="" placeholder="Search in the site" required="required" autocomplete="off" autocorrect="off" spellcheck="false">
    </div>
    <i class="material-icons mdc-top-app-bar__action-item button_close">close</i>

    <input id="form_search__token" type="hidden" name="form_search[_token]" value="">
</form>
XYZ;
echo $html;