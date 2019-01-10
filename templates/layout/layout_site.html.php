<?php
require_once(dirname(dirname(__DIR__)) . "/src/Classes/System/Utility.php");
require_once(dirname(dirname(__DIR__)) . "/src/Classes/System/Root.php");

$utility = new Utility();
$root = new Root();
$settingRow = $root->getSettingRow();
$websiteName = $root->getWebsiteName();
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['languageTextCode'] ?>">
    <head>
        <title><?php echo $websiteName; ?></title>
        
        <!-- Meta -->
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta name="robots" content="noindex, nofollow"/>
        
        <!-- Favicon -->
        <link href="<?php echo $utility->getUrlRoot(); ?>/images/templates/<?php echo $settingRow['template']; ?>/favicon.ico" rel="icon" type="image/x-icon">
        
        <!-- Css -->
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/library/jquery-ui_1.12.1.min.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/library/jquery-ui_1.12.1_structure.min.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/library/Roboto+Mono.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/library/Roboto_300_400_500.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/library/material-icons.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/library/material-components-web.min.css" rel="stylesheet"/>
        
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/system/<?php echo $settingRow['template']; ?>.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/system/loader.css" rel="stylesheet"/>
        <link href="<?php echo $utility->getUrlRoot(); ?>/css/system/widget.css" rel="stylesheet"/>
    </head>
    <body class="mdc-typography user_select_none">
        <div id="body_progress">
            <?php include_once(dirname(__DIR__) . "/include/progress_bar.html.php"); ?>
        </div>
        
        <header class="mdc-top-app-bar">
            <div class="mdc-top-app-bar__row">
                <div class="display_desktop">
                    <?php
                    if ($settingRow['website_active'] == true) {
                        // menu root
                    }
                    ?>
                </div>
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                    <a class="material-icons mdc-top-app-bar__navigation-icon menu_root_mobile display_mobile" href="javascript:void(0)">menu</a>
                    <div class="display_desktop">
                        <img class="logo_main_big" src="<?php echo $utility->getUrlRoot(); ?>/images/templates/<?php echo $settingRow['template']; ?>/logo.svg" alt="logo.svg"/>
                        <span class="mdc-top-app-bar__title"><?php echo $websiteName; ?></span>
                    </div>
                    <span class="mdc-top-app-bar__title display_mobile">
                        <img class="logo_main_small" src="<?php echo $utility->getUrlRoot(); ?>/images/templates/<?php echo $settingRow['template']; ?>/logo.svg" alt="logo.svg"/>
                    </span>
                </section>
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
                    <?php include_once(dirname(__DIR__) . "/render/module/widget_search.html.php"); ?>
                    
                    <a href="javascript:void(0)" class="material-icons mdc-top-app-bar__action-item" aria-label="Language" alt="Language">language</a>
                    <a href="javascript:void(0)" class="material-icons mdc-top-app-bar__action-item" aria-label="Account" alt="Account">account_circle</a>
                </section>
            </div>
            <aside class="mdc-drawer mdc-drawer--temporary mdc-typography">
                <nav class="mdc-drawer__drawer">
                    <header class="mdc-drawer__header">
                        <div class="mdc-drawer__header-content">
                            <img class="logo_main_big" src="<?php echo $utility->getUrlRoot(); ?>/images/templates/<?php echo $settingRow['template']; ?>/logo.svg" alt="logo.svg"/>
                            <span><?php echo $websiteName; ?></span>
                        </div>
                    </header>
                    <?php
                    if ($settingRow['website_active'] == true) {
                        // menu root
                    }
                    ?>
                </nav>
            </aside>
        </header>
        <div class="mdc-layout-grid main">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--span-2-tablet column_left_container display_desktop">
                    <div class="sortable_column"></div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8 mdc-layout-grid__cell--span-8-tablet column_center_container">
                    <?php
                    if (isset($_REQUEST['error']) == true && $_REQUEST['error'] != "") {
                    ?>
                        <div class="sortable_column">
                            <?php include_once(dirname(__DIR__) .  "/render/static/error.html.twig"); ?>
                        </div>
                    <?php
                    }
                    else {
                        if ($settingRow['website_active'] == true) {
                        ?>
                            <div class="sortable_column">
                                <?php include_once(dirname(__DIR__) . "/render/module/page_view.html.php"); ?>
                            </div>
                        <?php
                        }
                        else {
                        ?>
                            <div class="sortable_column">
                                <div class="maintenance_container">
                                    <img src="<?php echo $utility->getUrlRoot(); ?>/images/templates/<?php echo $settingRow['template']; ?>/maintenance.svg" alt="maintenance.svg"/>
                                    <p>WEBSITE CURRENTLY</p>
                                    <p>UNDER MAINTENANCE</p>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--span-2-tablet column_right_container display_desktop">
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
        
        <?php include_once(dirname(__DIR__) . "/include/loader.html.php"); ?>
        <?php include_once(dirname(__DIR__) . "/include/flash_bag.html.php"); ?>
        <?php include_once(dirname(__DIR__) . "/include/popup_easy.html.php"); ?>
        
        <script type="text/javascript">
            <?php
            if (isset($_SESSION['userActivity']) == true) {
            ?>
                var session = {
                    'token': "<?php echo $_SESSION['token']; ?>",
                    'userActivity': "<?php echo $_SESSION['userActivity']; ?>",
                    'languageTextCode': "<?php echo $_SESSION['languageTextCode'] ?>",
                    'currentPageId': "0"
                };
            <?php
            }
            ?>
            
            var path = {
                'documentRoot': "{{response.path.documentRoot}}",
                'root': "<?php echo $utility->getPathRoot(); ?>",
                'src': "<?php echo $utility->getPathSrc(); ?>",
                'web': "<?php echo $utility->getPathWeb(); ?>"
            };
            
            var url = {
                'root': "<?php echo $utility->getUrlRoot(); ?>"
            };
            
            var setting = {
                'widthMobile': 839,
                'widthDesktop': 840,
                'template': "<?php echo $settingRow['template']; ?>",
                'language': "<?php echo $settingRow['language']; ?>",
                'websiteActive': "<?php echo $settingRow['website_active']; ?>"
            };
            
            var text = {
                'index_5': "Warning!",
                'index_6': "Ok",
                'index_7': "Close",
                'index_8': "Connection error, please reload the page.",
                'index_9': "Expand",
                'index_10': "Collapse"
            };
            
            var textWidgetDatePicker = {
                'label_1': "Today",
                'label_2': "Clear",
                'label_3': "Confirm"
            };
        </script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/library/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/library/jquery-ui_1.12.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/library/jquery-mobile_1.5.0.min.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/library/material-components-web.min.js"></script>
        
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/Utility.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/MaterialDesign.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/WidgetSearch.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/WidgetDatePicker.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/Ajax.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/Loader.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/FlashBag.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/PopupEasy.js"></script>
        <script type="text/javascript" src="<?php echo $utility->getUrlRoot(); ?>/javascript/system/Index.js"></script>
        
        <?php include_once(__DIR__ . "/layout_site_custom.html.php"); ?>
    </body>
</html>