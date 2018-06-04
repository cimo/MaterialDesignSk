// Version 1.0.0

/* global utility */

var widgetSearch = new WidgetSearch();

function WidgetSearch() {
    // Vars
    var self = this;
    
    var widgetSearchButtonOpen;
    var widgetSearchButtonClose;
    var widgetSearchInput;
    var topAppBarSectionStart;
    
    // Properties
    
    // Functions public
    self.init = function() {
        widgetSearchButtonOpen = null;
        widgetSearchButtonClose = null;
        widgetSearchInput = null;
        topAppBarSectionStart = null;
    };
    
    self.create = function() {
        widgetSearchButtonOpen = $(".widget_search").find(".button_open");
        widgetSearchButtonClose = $(".widget_search").find(".button_close");
        widgetSearchButtonInput = $(".widget_search").find("input");
        topAppBarSectionStart = $(".mdc-top-app-bar__section--align-start");

        $(widgetSearchButtonOpen).on("click", "", function(event) {
            var target = event.target;

            if ($(target).hasClass("animate") === false) {
                $(target).addClass("animate");
                $(widgetSearchButtonClose).show();
                $(widgetSearchButtonInput).show();
                
                if (utility.checkWidthType() === "mobile")
                    $(topAppBarSectionStart[0]).hide();
            }
        });

        $(widgetSearchButtonClose).on("click", "", function(event) {
            var target = event.target;

            if ($(widgetSearchButtonOpen).hasClass("animate") === true) {
                $(target).hide();
                $(widgetSearchButtonOpen).removeClass("animate");
                widgetSearchButtonInput.val("");
                $(widgetSearchButtonInput).hide();
                
                if (utility.checkWidthType() === "mobile")
                    $(topAppBarSectionStart[0]).css("display", "inline-flex");
            }
        });
    };
    
    self.changeView = function() {
        if (utility.checkWidthType() === "desktop")
            $(topAppBarSectionStart[0]).css("display", "inline-flex");
        else {
            if ($(widgetSearchButtonOpen).hasClass("animate") === true)
                $(topAppBarSectionStart[0]).hide();
        }
    };

    // Functions private
}