document.addEventListener("DOMContentLoaded", function(event) {
    mdc.autoInit();

    // Drawer
    var drawerMdc = new mdc.drawer.MDCTemporaryDrawer.attachTo(document.querySelector(".mdc-drawer--temporary"));

    document.querySelector("#menu_root_button").addEventListener("click", function() {
        drawerMdc.open = true;
    }, {passive: true});

    // Toolbar
    var toolbarMdc = mdc.toolbar.MDCToolbar.attachTo(document.querySelector(".mdc-toolbar"));
    toolbarMdc.fixedAdjustElement = document.querySelector(".mdc-toolbar-fixed-adjust");
    
    // Switch
    document.querySelector("#switch_disable").addEventListener("click", function(event) {
        var target = event.target;

        [].forEach.call(document.querySelectorAll(".mdc-switch__native-control"), function(element, index) {
            if (target.checked === true)
                element.setAttribute("disabled", "");
            else
                element.removeAttribute("disabled");
        });
    }, {passive: true});

    // Tabs
    [].forEach.call(document.querySelectorAll(".mdc-tab-bar"), function(element, index) {
        mdc.tabs.MDCTabBar.attachTo(element);
    });
    [].forEach.call(document.querySelectorAll(".mdc-tab-bar-scroller"), function(element, index) {
        mdc.tabs.MDCTabBarScroller.attachTo(element);
    });
    
    // Slider
    var continuousSliderMdc = new Array();
    
    [].forEach.call(document.querySelectorAll(".mdc-slider--continuous"), function(element, index) {
        continuousSliderMdc[index] = new mdc.slider.MDCSlider.attachTo(element);
        
        element.addEventListener("MDCSlider:input", function() {
            console.log("continuousSliderMdc - input: " + continuousSliderMdc[index].value);
        });

        element.addEventListener("MDCSlider:change", function() {
            console.log("continuousSliderMdc - change: " + continuousSliderMdc[index].value);
        });
    });
    
    var discreteSliderMdc = new Array();
    
    [].forEach.call(document.querySelectorAll(".mdc-slider--discrete"), function(element, index) {
        discreteSliderMdc[index] = new mdc.slider.MDCSlider.attachTo(element);
        
        element.addEventListener("MDCSlider:input", function() {
            console.log("discreteSliderMdc - input: " + discreteSliderMdc[index].value);
        });

        element.addEventListener("MDCSlider:change", function() {
            console.log("discreteSliderMdc - change: " + discreteSliderMdc[index].value);
        });
    });

    document.querySelector("#slider_disable").addEventListener("click", function(event) {
        var target = event.target;

        [].forEach.call(continuousSliderMdc, function(element, index) {
            element.disabled = target.checked;
        });
        
        [].forEach.call(discreteSliderMdc, function(element, index) {
            element.disabled = target.checked;
        });
    }, {passive: true});

    // Checkbox
    var checkboxMdc = new Array();
    
    [].forEach.call(document.querySelectorAll(".mdc-checkbox"), function(element, index) {
        checkboxMdc[index] = new mdc.checkbox.MDCCheckbox.attachTo(element);
    });
    
    document.querySelector("#checkbox_disable").addEventListener("click", function(event) {
        var target = event.target;
        
        [].forEach.call(checkboxMdc, function(element, index) {
            element.disabled = target.checked;
        });
    }, {passive: true});

    // Radion button
    var radioButtonMdc = new Array();
    
    [].forEach.call(document.querySelectorAll(".mdc-radio"), function(element, index) {
        radioButtonMdc[index] = new mdc.radio.MDCRadio.attachTo(element);
    });
    
    document.querySelector("#radioButton_disable").addEventListener("click", function(event) {
        var target = event.target;

        [].forEach.call(radioButtonMdc, function(element, index) {
            element.disabled = target.checked;
        });
    }, {passive: true});

    // Text field
    var textFieldMdc = new Array();
    
    [].forEach.call(document.querySelectorAll(".mdc-text-field"), function(element, index) {
        textFieldMdc[index] = new mdc.textField.MDCTextField.attachTo(element);
    });
    
    var textFieldContainer = document.querySelectorAll(".textField_container");
    
    var textFieldRoot = null;
    var textFieldInput = null;
    var textFieldHelperText = null;
    
    [].forEach.call(textFieldContainer, function(element, index) {
        textFieldRoot = element.querySelectorAll(".mdc-text-field");
        textFieldInput = element.querySelectorAll(".mdc-text-field__input");
        textFieldHelperText = element.querySelectorAll(".mdc-text-field-helper-text");
    });
    
    var textFieldHelperTextPersistent = document.querySelector("#textField_helperTextPersistent");
    var textFieldHelperTextValidation = document.querySelector("#textField_helperTextValidation");
    
    document.querySelector("#textField_disable").addEventListener("click", function(event) {
        var target = event.target;
        
        [].forEach.call(textFieldMdc, function(element, index) {
            element.disabled = target.checked;
        });
    }, {passive: true});

    document.querySelector("#textField_rtl").addEventListener('click', function(event) {
        var target = event.target;
        
        [].forEach.call(textFieldContainer, function(element, index) {
            if (target.checked === true)
                element.setAttribute("dir", "rtl");
            else
                element.removeAttribute("dir");
        });
    }, {passive: true});

    document.querySelector("#textField_dense").addEventListener("click", function(event) {
        var target = event.target;
        
        [].forEach.call(textFieldRoot, function(element, index) {
            element.classList[target.checked ? "add" : "remove"]("mdc-text-field--dense");
        });
    }, {passive: true});

    document.querySelector("#textField_require").addEventListener("click", function(event) {
        var target = event.target;
        
        [].forEach.call(textFieldInput, function(element, index) {
            element.required = target.checked;
        });
    }, {passive: true});

    document.querySelector("#textField_helperText").addEventListener("click", function(event) {
        var target = event.target;
        
        [].forEach.call(textFieldHelperText, function(element, index) {
            element.style.display = target.checked ? "block" : "none";
            textFieldHelperTextPersistent.disabled = !target.checked;
            textFieldHelperTextValidation.disabled = !target.checked;
        });
    }, {passive: true});

    textFieldHelperTextPersistent.addEventListener("click", function(event) {
        var target = event.target;
        
        [].forEach.call(textFieldHelperText, function(element, index) {
            element.classList[target.checked ? "add" : "remove"]("mdc-text-field-helper-text--persistent");
        });
    }, {passive: true});

    textFieldHelperTextValidation.addEventListener("click", function(event) {
        var target = event.target;
        
        var requiredHelperText = "Must be at least 8 characters";
        var plainHelperText = "Helper Text";
        
        [].forEach.call(textFieldInput, function(element, index) {
            element.pattern = event.target.checked ? ".{8,}" : ".*";
            textFieldHelperText[index].innerHTML = target.checked ? requiredHelperText : plainHelperText;
        });
    }, {passive: true});

    // Text area
    var textAreaMdc = new Array();
    
    [].forEach.call(document.querySelectorAll(".mdc-text-field--textarea"), function(element, index) {
        textAreaMdc[index] = new mdc.textField.MDCTextField.attachTo(element);
    });
    
    document.querySelector("#textArea_disable").addEventListener("click", function(event) {
        var target = event.target;

        [].forEach.call(textAreaMdc, function(element, index) {
            element.disabled = target.checked;
        });
    }, {passive: true});

    // Select
    var selectMdc = new Array();
    
    [].forEach.call(document.querySelectorAll(".mdc-select"), function(element, index) {
        selectMdc[index] = new mdc.select.MDCSelect.attachTo(element);
        
        element.addEventListener("MDCSelect:change", function() {
            console.log(selectMdc[index].selectedOptions[0].textContent + " at index " + selectMdc[index].selectedIndex + " with value " + selectMdc[index].value);
        }, {passive: true});
    });
    
    document.querySelector("#select_disable").addEventListener("click", function(event) {
        var target = event.target;

        [].forEach.call(selectMdc, function(element, index) {
            element.disabled = target.checked;
        });
    }, {passive: true});

    // Button
    var button = document.querySelectorAll(".mdc-button");

    [].forEach.call(button, function(element, index) {
        mdc.ripple.MDCRipple.attachTo(element);
    });

    document.querySelector("#button_disable").addEventListener("click", function(event) {
        var target = event.target;
        
        [].forEach.call(button, function(element, index) {
            if (target.checked === true)
                element.setAttribute("disabled", "");
            else
                element.removeAttribute("disabled");
        });
    }, {passive: true});

    // Fab button
    var fabButton = document.querySelectorAll(".mdc-fab");

    [].forEach.call(fabButton, function(element, index) {
        mdc.ripple.MDCRipple.attachTo(element);
    });

    document.querySelector("#fabButton_animate").addEventListener("click", function(event) {
        var target = event.target;
        
        [].forEach.call(fabButton, function(element, index) {
            if (target.checked === true)
                element.classList.add("mdc-fab--exited");
            else
                element.classList.remove("mdc-fab--exited");
        });
    }, {passive: true});

    // Icons
    [].forEach.call(document.querySelectorAll(".mdc-card__action--icon"), function(element, index) {
        mdc.iconToggle.MDCIconToggle.attachTo(element);
    });
    [].forEach.call(document.querySelectorAll(".mdc-icon-toggle"), function(element, index) {
        mdc.iconToggle.MDCIconToggle.attachTo(element);
    });

    // List
    [].forEach.call(document.querySelectorAll(".mdc-list-item"), function(element, index) {
        mdc.ripple.MDCRipple.attachTo(element);
        
        element.addEventListener("click", function(event) {
            var target = event.target;
            
            [].forEach.call(target.parentNode.querySelectorAll(".mdc-list-item"), function(element, index) {
                element.classList.remove("mdc-list-item--activated");
            });
            
            target.classList.add("mdc-list-item--activated");
        }, {passive: true});
    });

    // Linear progress
    var linearProgressMdc = new Array();
    
    [].forEach.call(document.querySelectorAll(".mdc-linear-progress"), function(element, index) {
        linearProgressMdc[index] = new mdc.linearProgress.MDCLinearProgress.attachTo(element);

        linearProgressMdc[index].progress = 0.5;
        
        if (element.dataset.buffer !== undefined)
            linearProgressMdc[index].buffer = 0.75;
    });

    // Chips
    [].forEach.call(document.querySelectorAll(".mdc-chip"), function(element, index) {
        mdc.ripple.MDCRipple.attachTo(element);
    });
    
    // Dialog
    var dialog = document.querySelector(".mdc-dialog");

    dialog.addEventListener("MDCDialog:accept", function() {
        console.log("Accepted");
    });

    dialog.addEventListener("MDCDialog:cancel", function() {
        console.log("Canceled");
    });
    
    var dialogMdc = new mdc.dialog.MDCDialog.attachTo(dialog);

    document.querySelector("#dialog_show").addEventListener("click", function(event) {
        dialogMdc.lastFocusedTarget = event.target;
        dialogMdc.show();
    }, {passive: true});

    // Snackbar
    var snackbarMdc = new mdc.snackbar.MDCSnackbar.attachTo(document.querySelector(".mdc-snackbar"));
    
    var snackbarDataObj = {
        message: "Text",
        actionText: "Undo",
        actionHandler: function() {
            console.log("Snackbar undo");
        }
    };

    document.querySelector("#snackbar_show").addEventListener("click", function() {
        snackbarMdc.show(snackbarDataObj);
    }, {passive: true});
    
    // Fix
    [].forEach.call(document.querySelectorAll(".mdc-tab"), function(element, index) {
        element.classList.add("unselect");
    });
    
    [].forEach.call(document.querySelectorAll(".mdc-form-field label"), function(element, index) {
        element.classList.add("unselect");
    });
    
    [].forEach.call(document.querySelectorAll(".mdc-list-item"), function(element, index) {
        element.classList.add("unselect");
    });
    
    [].forEach.call(document.querySelectorAll(".mdc-chip"), function(element, index) {
        element.classList.add("unselect");
    });
    
    [].forEach.call(document.querySelectorAll(".material-icons"), function(element, index) {
        element.classList.add("unselect");
    });
});