$(document).ready(function() {
    mdc.autoInit();

    // Drawer
    var drawerMdc = new mdc.drawer.MDCTemporaryDrawer.attachTo($(".mdc-drawer--temporary")[0]);

    $("#menu_root_button").on("click", "", function() {
        drawerMdc.open = true;
    });

    // Toolbar
    var toolbarMdc = mdc.toolbar.MDCToolbar.attachTo($(".mdc-toolbar")[0]);
    toolbarMdc.fixedAdjustElement = $(".mdc-toolbar-fixed-adjust")[0];
    
    // Switch
    var switchNative = $(".mdc-switch__native-control");
    
    $("#switch_disable").on("change", "", function(event) {
        var target = event.target;
        
        $.each(switchNative, function(key, value) {
            $(value).attr("disabled", target.checked);
        });
    });
    
    // Tabs
    $.each($(".mdc-tab-bar"), function(key, value) {
        mdc.tabs.MDCTabBar.attachTo(value);
    });
    $.each($(".mdc-tab-bar-scroller"), function(key, value) {
        mdc.tabs.MDCTabBarScroller.attachTo(value);
    });

    // Slider
    var continuousSliderMdc = new Array();
    
    $.each($(".mdc-slider--continuous"), function(key, value) {
        continuousSliderMdc[key] = new mdc.slider.MDCSlider.attachTo(value);
        
        $(value).on("MDCSlider:input", "", function() {
            console.log("continuousSliderMdc - input: " + continuousSliderMdc[key].value);
        });

        $(value).on("MDCSlider:change", "", function() {
            console.log("continuousSliderMdc - change: " + continuousSliderMdc[key].value);
        });
    });
    
    var discreteSliderMdc = new Array();
    
    $.each($(".mdc-slider--discrete"), function(key, value) {
        discreteSliderMdc[key] = new mdc.slider.MDCSlider.attachTo(value);
        
        $(value).on("MDCSlider:input", "", function() {
            console.log("discreteSliderMdc - input: " + discreteSliderMdc[key].value);
        });

        $(value).on("MDCSlider:change", "", function() {
            console.log("discreteSliderMdc - change: " + discreteSliderMdc[key].value);
        });
    });

    $("#slider_disable").on("click", "", function(event) {
        var target = event.target;
        
        $.each(continuousSliderMdc, function(key, value) {
            value.disabled = target.checked;
        });
        
        $.each(discreteSliderMdc, function(key, value) {
            value.disabled = target.checked;
        });
    });

    // Checkbox
    var checkboxMdc = new Array();
    
    $.each($(".mdc-checkbox"), function(key, value) {
        checkboxMdc[key] = new mdc.checkbox.MDCCheckbox.attachTo(value);
    });
    
    $("#checkbox_disable").on("click", "", function(event) {
        var target = event.target;
        
        $.each(checkboxMdc, function(key, value) {
            value.disabled = target.checked;
        });
    });

    // Radion button
    var radioButtonMdc = new Array();
    
    $.each($(".mdc-radio"), function(key, value) {
        radioButtonMdc[key] = new mdc.radio.MDCRadio.attachTo(value);
    });
    
    $("#radioButton_disable").on("click", "", function(event) {
        var target = event.target;
        
        $.each(radioButtonMdc, function(key, value) {
            value.disabled = target.checked;
        });
    });

    // Text field
    var textFieldMdc = new Array();
    
    $.each($(".mdc-text-field").not(".mdc-text-field--textarea"), function(key, value) {
        textFieldMdc[key] = new mdc.textField.MDCTextField.attachTo(value);
    });
    
    var textFieldContainer = $(".textField_container");
    
    var textFieldRoot = new Array();
    var textFieldInput = new Array();
    var textFieldHelperText = new Array();
    
    $.each(textFieldContainer, function(key, value) {
        textFieldRoot[key] = $(value).find(".mdc-text-field");
        textFieldInput[key] = $(value).find(".mdc-text-field__input");
        textFieldHelperText[key] = $(value).find(".mdc-text-field-helper-text");
    });
    
    var textFieldHelperTextPersistent = $("#textField_helperTextPersistent");
    var textFieldHelperTextValidation = $("#textField_helperTextValidation");
    
    $("#textField_disable").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textFieldMdc, function(key, value) {
            value.disabled = target.checked;
        });
    });
    
    $("#textField_rtl").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textFieldContainer, function(key, value) {
            if (target.checked === true)
                $(value).attr("dir", "rtl");
            else
                $(value).removeAttr("dir");
        });
    });

    $("#textField_dense").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textFieldRoot, function(key, value) {
            if (target.checked === true)
                $(value).addClass("mdc-text-field--dense");
            else
                $(value).removeClass("mdc-text-field--dense");
        });
    });

    $("#textField_require").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textFieldInput, function(key, value) {
            $(value).attr("required", target.checked);
        });
    });

    $("#textField_helperText").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textFieldHelperText, function(key, value) {
            $(value).css("display", target.checked ? "block" : "none");
            textFieldHelperTextPersistent.attr("disabled", !target.checked);
            textFieldHelperTextValidation.attr("disabled", !target.checked);
        });
    });

    textFieldHelperTextPersistent.on("click", "", function(event) {
        var target = event.target;
        
        $.each(textFieldHelperText, function(key, value) {
            if (target.checked === true)
                $(value).addClass("mdc-text-field-helper-text--persistent");
            else
                $(value).removeClass("mdc-text-field-helper-text--persistent");
        });
    });

    textFieldHelperTextValidation.on("click", "", function(event) {
        var target = event.target;
        
        var requiredHelperText = "Must be at least 8 characters";
        var plainHelperText = "Helper Text";
        
        $.each(textFieldInput, function(key, value) {
            $(value).attr("pattern", event.target.checked ? ".{8,}" : ".*");
            textFieldHelperText[key].html(target.checked ? requiredHelperText : plainHelperText);
        });
    });

    // Text area
    var textAreaMdc = new Array();
    
    $.each($(".mdc-text-field--textarea"), function(key, value) {
        textAreaMdc[key] = new mdc.textField.MDCTextField.attachTo(value);
    });
    
    var textAreaContainer = $(".textArea_container");
    
    var textAreaRoot = new Array();
    var textAreaInput = new Array();
    var textAreaHelperText = new Array();
    
    $.each(textAreaContainer, function(key, value) {
        textAreaRoot[key] = $(value).find(".mdc-text-field--textarea");
        textAreaInput[key] = $(value).find(".mdc-text-field__input");
        textAreaHelperText[key] = $(value).find(".mdc-text-field-helper-text");
    });
    
    var textAreaHelperTextPersistent = $("#textArea_helperTextPersistent");
    var textAreaHelperTextValidation = $("#textArea_helperTextValidation");
    
    $("#textArea_disable").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textAreaMdc, function(key, value) {
            value.disabled = target.checked;
        });
    });
    
    $("#textArea_rtl").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textAreaContainer, function(key, value) {
            if (target.checked === true)
                $(value).attr("dir", "rtl");
            else
                $(value).removeAttr("dir");
        });
    });

    $("#textArea_dense").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textAreaRoot, function(key, value) {
            if (target.checked === true)
                $(value).addClass("mdc-text-field--dense");
            else
                $(value).removeClass("mdc-text-field--dense");
        });
    });

    $("#textArea_require").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textAreaInput, function(key, value) {
            $(value).attr("required", target.checked);
        });
    });

    $("#textArea_helperText").on("click", "", function(event) {
        var target = event.target;
        
        $.each(textAreaHelperText, function(key, value) {
            $(value).css("display", target.checked ? "block" : "none");
            textAreaHelperTextPersistent.attr("disabled", !target.checked);
            textAreaHelperTextValidation.attr("disabled", !target.checked);
        });
    });

    textAreaHelperTextPersistent.on("click", "", function(event) {
        var target = event.target;
        
        $.each(textAreaHelperText, function(key, value) {
            if (target.checked === true)
                $(value).addClass("mdc-text-field-helper-text--persistent");
            else
                $(value).removeClass("mdc-text-field-helper-text--persistent");
        });
    });

    textAreaHelperTextValidation.on("click", "", function(event) {
        var target = event.target;
        
        var requiredHelperText = "Must be at least 8 characters";
        var plainHelperText = "Helper Text";
        
        $.each(textAreaInput, function(key, value) {
            $(value).attr("pattern", event.target.checked ? ".{8,}" : ".*");
            textAreaHelperText[key].html(target.checked ? requiredHelperText : plainHelperText);
        });
    });

    // Select
    var selectMdc = new Array();
    
    $.each($(".mdc-select"), function(key, value) {
        selectMdc[key] = new mdc.select.MDCSelect.attachTo(value);

        $(value).on("MDCSelect:change", "", function() {
            console.log(selectMdc[key].selectedOptions[0].textContent + " at index " + selectMdc[key].selectedIndex + " with value " + selectMdc[key].value);
        });
    });

    $("#select_disable").on("click", "", function(event) {
        var target = event.target;
        
        $.each(selectMdc, function(key, value) {
            value.disabled = target.checked;
        });
    });

    // Button
    var button = $(".mdc-button");
    
    $.each(button, function(key, value) {
        mdc.ripple.MDCRipple.attachTo(value);
    });
    
    $("#button_disable").on("click", "", function(event) {
        var target = event.target;
        
        $.each(button, function(key, value) {
            $(value).attr("disabled", target.checked);
        });
    });

    // Fab button
    var fabButton = $(".mdc-fab");
    
    $.each(fabButton, function(key, value) {
        mdc.ripple.MDCRipple.attachTo(value);
    });
    
    $("#fabButton_animate").on("click", "", function(event) {
        var target = event.target;
        
        $.each(fabButton, function(key, value) {
            if (target.checked === true)
                $(value).addClass("mdc-fab--exited");
            else
                $(value).removeClass("mdc-fab--exited");
        });
    });
    
    // Icons
    $.each($(".mdc-card__action--icon"), function(key, value) {
        mdc.iconToggle.MDCIconToggle.attachTo(value);
    });
    $.each($(".mdc-icon-toggle"), function(key, value) {
        mdc.iconToggle.MDCIconToggle.attachTo(value);
    });

    // List
    $.each($(".mdc-list-item"), function(key, value) {
        mdc.ripple.MDCRipple.attachTo(value);
    });
    
    $(".mdc-list-item").on("click", "", function() {
        $(this).parent().find(".mdc-list-item").removeClass("mdc-list-item--activated");
        $(this).addClass("mdc-list-item--activated");
    });
    
    // Linear progress
    var linearProgressMdc = new Array();
    
    $.each($(".mdc-linear-progress"), function(key, value) {
        linearProgressMdc[key] = new mdc.linearProgress.MDCLinearProgress.attachTo(value);
        
        linearProgressMdc[key].progress = 0.5;
        
        if (value.dataset.buffer !== undefined)
            linearProgressMdc[key].buffer = 0.75;
    });
    
    // Chips
    $.each($(".mdc-chip"), function(key, value) {
        mdc.ripple.MDCRipple.attachTo(value);
    });
    
    // Dialog
    var dialog = $(".mdc-dialog")[0];
    
    $(dialog).on("MDCDialog:accept", "", function() {
        console.log("Accepted");
    });

    $(dialog).on("MDCDialog:cancel", "", function() {
        console.log("Canceled");
    });
    
    var dialogMdc = new mdc.dialog.MDCDialog.attachTo(dialog);

    $("#dialog_show").on("click", "", function(event) {
        dialogMdc.lastFocusedTarget = event.target;
        dialogMdc.show();
    });

    // Snackbar
    var snackbarMdc = new mdc.snackbar.MDCSnackbar.attachTo($(".mdc-snackbar")[0]);
    
    var snackbarDataObj = {
        message: "Text",
        actionText: "Undo",
        actionHandler: function() {
            console.log("Snackbar undo");
        }
    };

    $("#snackbar_show").on("click", "", function() {
        snackbarMdc.show(snackbarDataObj);
    });
    
    // Fix
    $.each($(".mdc-tab"), function(key, value) {
        $(value).addClass("unselect");
    });
    
    $.each($(".mdc-form-field").find("label"), function(key, value) {
        $(value).addClass("unselect");
    });
    
    $.each($(".mdc-list-item"), function(key, value) {
        $(value).addClass("unselect");
    });
    
    $.each($(".mdc-chip"), function(key, value) {
        $(value).children("div").addClass("unselect");
    });
    
    $.each($(".material-icons"), function(key, value) {
        $(value).addClass("unselect");
    });
});