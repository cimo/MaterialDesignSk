"use strict";

/* global */

let ajax = null;
let flashBag = null;
let helper = null;
let loader = null;
let materialDesign = null;
let popupEasy = null;
let widgetDatePicker = null;
let widgetSearch = null;

$(document).ready(() => {
    ajax = new Ajax();
    flashBag = new FlashBag();
    helper = new Helper();
    loader = new Loader();
    materialDesign = new MaterialDesign();
    popupEasy = new PopupEasy();
    widgetDatePicker = new WidgetDatePicker();
    widgetSearch = new WidgetSearch();
    
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
    
    flashBag.setElement = materialDesign.getSnackbarMdc;
    flashBag.sessionActivity();
    
    widgetDatePicker.setLanguage = "en";
    //widgetDatePicker.setCurrentYear = 1984;
    //widgetDatePicker.setCurrentMonth = 4;
    //widgetDatePicker.setCurrentDay = 11;
    widgetDatePicker.setInputFill = ".widget_datePicker_input";
    widgetDatePicker.create();
    
    widgetSearch.create();
    widgetSearch.changeView();
    
    $(window).on("resize", "", (event) => {
        materialDesign.refresh();
        materialDesign.fix();
        
        widgetSearch.changeView();
    });
    
    $(window).on("orientationchange", "", (event) => {
    });
});