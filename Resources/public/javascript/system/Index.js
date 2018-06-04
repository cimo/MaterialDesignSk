/* global utility, materialDesign, widgetSearch, widgetDatePicker, flashBag */

$(document).ready(function() {
    utility.checkMobile(true);
    
    utility.linkPreventDefault();
    
    //utility.watch("#flashBag", flashBag.sessionActivity);
    
    // Material design
    materialDesign.init();
    materialDesign.tab();
    materialDesign.checkbox();
    materialDesign.textField();
    materialDesign.select();
    materialDesign.button();
    materialDesign.fabButton();
    materialDesign.icon();
    materialDesign.snackbar();
    materialDesign.utility();
    
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
    
    flashBag.init();
    flashBag.setElement(materialDesign.getSnackbarMsc()[0]);
    flashBag.sessionActivity();
    
    search.init();
    
    $(window).resize(function() {
        materialDesign.utility();
        
        widgetSearch.changeView();
    });
});

$(window).on("load", "", function() {
});