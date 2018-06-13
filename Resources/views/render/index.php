<?php
require_once(dirname(dirname(dirname(__DIR__))) . "/Classes/System/Utility.php");
require_once(dirname(dirname(dirname(__DIR__))) . "/Classes/System/Root.php");

$utility = new Utility();
$root = new Root();

//$settingRow = $utility->getQuery()->selectSettingDatabase();
$settingRow['template'] = "basic";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $utility->getWebsiteName(); ?></title>
        <!-- Meta -->
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
        <!-- Favicon -->
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/images/templates/<?php echo $settingRow['template']; ?>/favicon.ico" rel="icon" type="image/x-icon">
        <!-- Css -->
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/library/jquery-ui_1.12.1.min.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/library/jquery-ui_1.12.1_structure.min.css" rel="stylesheet"/>

        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/library/Roboto+Mono.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/library/Roboto_300_400_500.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/library/material-icons.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/library/material-components-web.min.css" rel="stylesheet"/>
        
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/system/<?php echo $settingRow['template']; ?>.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/system/loader.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/Resources/public/css/system/widget.css" rel="stylesheet"/>
    </head>
    <body class="mdc-typography user_select_none">
        <header class="mdc-top-app-bar mdc-top-app-bar--prominent">
            <div class="mdc-top-app-bar__row">
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                    <a class="material-icons mdc-top-app-bar__navigation-icon show_menu_root display_mobile" href="javascript:void(0)">menu</a>
                    <span class="mdc-top-app-bar__title display_desktop"><?php echo $utility->getWebsiteName(); ?></span>
                    <span class="mdc-top-app-bar__title display_mobile">
                        <img class="logo_main" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/images/templates/<?php echo $settingRow['template']; ?>/logo.svg"/>
                    </span>
                </section>
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
                    <?php include_once(__DIR__ . "/module/widget_search.php"); ?>
                    <a href="javascript:void(0)" class="material-icons mdc-top-app-bar__action-item" aria-label="Language" alt="Language">language</a>
                    <a href="javascript:void(0)" class="material-icons mdc-top-app-bar__action-item" aria-label="Account" alt="Account">account_circle</a>
                </section>
            </div>
            <aside class="mdc-drawer mdc-drawer--temporary mdc-typography">
                <nav class="mdc-drawer__drawer">
                    <header class="mdc-drawer__header">
                        <div class="mdc-drawer__header-content">
                            <p>Text<p>
                        </div>
                    </header>
                    <nav id="icon-with-text-demo" class="mdc-drawer__content mdc-list">
                        <a class="mdc-list-item mdc-list-item--activated" href="javascript:void(0)">
                            <i class="material-icons mdc-list-item__graphic" aria-hidden="true">home</i>Home
                        </a>
                    </nav>
                </nav>
            </aside>
        </header>
        <div class="mdc-layout-grid main">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--span-2-tablet display_desktop">
                    <div class="sortable_column"></div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8 mdc-layout-grid__cell--span-8-tablet">
                    <div class="sortable_column">
                        <?php include_once(__DIR__ . "/module/page_view.php"); ?>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--span-2-tablet display_desktop">
                    <div class="sortable_column"></div>
                </div>
            </div>
        </div>
        <footer class="mdc-theme--primary-bg mdc-theme--on-primary footer">
            <div class="icon">
                <div>
                    <i class="material-icons">desktop_windows</i>
                </div>
                <div>
                    <i class="material-icons">laptop_windows</i>
                </div>
                <div>
                    <i class="material-icons">smartphone</i>
                </div>
            </div>
            <div class="text">
                <p>Copyright © 2018 - Reinvent software.</p>
                <p>All rights reserved.</p>
            </div>
        </footer>
        <?php include_once(dirname(__DIR__) . "/include/flash_bag.php"); ?>
        <?php include_once(dirname(__DIR__) . "/include/loader.php"); ?>
        <?php include_once(dirname(__DIR__) . "/include/popup_easy.php"); ?>
        <!-- Javascript -->
        <script type="text/javascript">
            var session = {
                'token': "<?php echo $_SESSION['token']; ?>",
                'userActivity': "<?php echo $_SESSION['userActivity']; ?>"
            };
            
            var path = {
                'documentRoot': "<?php echo $_SERVER['DOCUMENT_ROOT']; ?>",
                'root': "<?php echo $utility->getPathRoot(); ?>"
            };
            
            var url = {
                'root': "<?php echo $utility->getUrlRoot(); ?>"
            };
            
            var text = {
                'warning': "Warning!",
                'ok': "Ok",
                'close': "Close",
                'ajaxConnectionError': "Connection error, please reload the page.",
                'today': "Today",
                'clear': "Clear",
                'confirm': "Confirm"
            };
            
            var setting = {
                'widthMobile': 839,
                'widthDesktop': 840,
                'template': "<?php echo $settingRow['template']; ?>"
            };
        </script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/library/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/library/jquery-ui_1.12.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/library/jquery-mobile_1.5.0.min.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/library/material-components-web.min.js"></script>
        
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/Utility.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/Ajax.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/Search.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/FlashBag.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/Loader.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/MaterialDesign.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/WidgetSearch.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/WidgetDatePicker.js"></script>
        
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/Resources/public/javascript/system/Index.js"></script>
    </body>
</html>