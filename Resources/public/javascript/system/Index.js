/* global utility, materialDesign, widgetSearch, widgetDatePicker, search, flashBag */

$(document).ready(function() {
    utility.init();
    
    utility.checkMobile(true);
    
    utility.linkPreventDefault();
    
    //utility.watch("#flashBag", flashBag.sessionActivity);
    
    // Material design
    materialDesign.init();
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
    
    // Widget
    widgetSearch.init();
    widgetSearch.create();
    widgetSearch.changeView();
    
    widgetDatePicker.init();
    widgetDatePicker.setLanguage("en");
    //widgetDatePicker.setCurrentYear(1984);
    //widgetDatePicker.setCurrentMonth(4);
    //widgetDatePicker.setCurrentDay(11);
    widgetDatePicker.setInputFill(".widget_datePicker_input");
    widgetDatePicker.create();
    
    search.init();
    
    flashBag.init();
    flashBag.setElement(materialDesign.getSnackbarMsc());
    flashBag.sessionActivity();
    
    $(window).resize(function() {
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
        materialDesign.list();
        materialDesign.menu();
        materialDesign.snackbar();
        materialDesign.tabBar();
        materialDesign.fix();
        
        widgetSearch.changeView();
    });
});

$(window).on("load", "", function() {
});