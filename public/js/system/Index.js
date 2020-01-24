/* global ajax, flashBag, helper, loader, materialDesign, popupEasy, widgetDatePicker, widgetSearch */

$(document).ready(function() {
    ajax.init();
    flashBag.init();
    helper.init();
    loader.init();
    materialDesign.init();
    popupEasy.init();
    widgetDatePicker.init();
    widgetSearch.init();
    
    helper.checkMobile(true);
    helper.linkPreventDefault();
    helper.accordion("button");
    helper.menuRoot();
    helper.uploadFakeClick();
    helper.blockMultiTab(true);
    helper.bodyProgress();
    
    materialDesign.button();
    materialDesign.fabButton();
    materialDesign.iconButton();
    materialDesign.chip();
    materialDesign.dialog();
    materialDesign.drawer();
    materialDesign.checkbox();
    materialDesign.radioButton();
    materialDesign.select();
    materialDesign.slider();
    materialDesign.textField();
    materialDesign.linearProgress(".linear_progress_b", 0.5, 1, 0.75);
    materialDesign.linearProgress(".linear_progress_c", 0.5, 1);
    materialDesign.list();
    materialDesign.menu();
    materialDesign.snackbar();
    materialDesign.tabBar();
    materialDesign.fix();
    
    widgetSearch.create();
    widgetSearch.changeView();
    
    widgetDatePicker.setLanguage("en");
    //widgetDatePicker.setCurrentYear(1984);
    //widgetDatePicker.setCurrentMonth(4);
    //widgetDatePicker.setCurrentDay(11);
    widgetDatePicker.setInputFill(".widget_datePicker_input");
    widgetDatePicker.create();
    
    flashBag.setElement(materialDesign.getSnackbarMdc());
    flashBag.sessionActivity();
    
    $(window).resize(function() {
        materialDesign.refresh();
        materialDesign.fix();
        
        widgetSearch.changeView();
    });
});