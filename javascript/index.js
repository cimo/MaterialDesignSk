/* global widgetSearch, widgetDatePicker */

$(document).ready(function() {
    widgetSearch.init();
    
    widgetDatePicker.setLanguage("en");
    //widgetDatePicker.setCurrentYear(1984);
    //widgetDatePicker.setCurrentMonth(4);
    //widgetDatePicker.setCurrentDay(11);
    widgetDatePicker.setInputFill("#widget_datePicker_input");
    widgetDatePicker.init();
});