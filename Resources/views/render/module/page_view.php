<?php
$html = <<<XYZ
<div id="panel_id_2" class="module_clean">
    <div class="settings">
        <i class="material-icons drag">drag_handle</i>
    </div>
    <div class="mdc-typography--body2">
        <div class="page_container">
            <div class="header">
                <h1 class="mdc-typography--headline6">Material design elements</h1>
            </div>
            <div class="argument"><p>Starter kit for material design. You can try all material design elements and with copy and paast you can integrate in your projects.</p></div>
            <div class="controllerAction">
                <h2 class="demo-title mdc-typography--headline6">Button</h2>
                <div>
                    <div style="display: inline-block;">
                        <button class="mdc-button mdc-button--dense mdc-button--raised" type="button">
                            <i class="material-icons mdc-button__icon" aria-hidden="true">favorite</i>
                            Button
                        </button>
                    </div>
                    <div style="display: inline-block;">
                        <button class="mdc-button" type="button">
                            <i class="material-icons mdc-button__icon" aria-hidden="true">favorite</i>
                            Button
                        </button>
                    </div>
                    <div style="display: inline-block;">
                        <button class="mdc-fab mdc-fab--mini" aria-label="Favorite" type="button">
                            <span class="mdc-fab__icon material-icons">favorite</span>
                        </button>
                    </div>
                    <div style="display: inline-block;">
                        <i class="material-icons mdc-icon-toggle"
                            role="button"
                            tabindex="0"
                            data-toggle-on='{"label": "Remove from favorites", "content": "favorite"}'
                            data-toggle-off='{"label": "Add to favorites", "content": "favorite_border"}']
                            aria-label="Add to favorites"
                            aria-pressed="false">favorite_border</i>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Card</h2>
                <div>
                    <div style="display: inline-block;">
                        <div class="mdc-card" style="width: 250px; margin: 10px;">
                            <div class="mdc-card__media mdc-card__media--16-9" style="background-image: url('../Resources/public/images/templates/basic/16-9.jpg');"></div>
                            <div style="padding: 10px;">
                                <h1 class="mdc-typography--headline6"><span>Title</span></h1>
                                <p>Content</p>
                            </div>
                            <div class="mdc-card__actions">
                                <div class="mdc-card__action-buttons">
                                    <button class="mdc-button mdc-button--dense mdc-card__action mdc-card__action--button" type="button">Action</button>
                                </div>
                                <div class="mdc-card__action-icons">
                                    <i class="material-icons mdc-card__action mdc-card__action--icon mdc-ripple-surface"
                                        role="button"
                                        data-mdc-ripple-is-unbounded=""
                                        title="Share">share</i>
                                    <i class="material-icons mdc-card__action mdc-card__action--icon mdc-ripple-surface"
                                        role="button"
                                        data-mdc-ripple-is-unbounded=""
                                        title="More options">more_vert</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: inline-block;">
                        <div class="mdc-card" style="border-radius: 24px 4px; width: 250px; margin: 10px;">
                            <div style="display: flex; border-top-left-radius: inherit;">
                                <div class="mdc-card__media mdc-card__media--square" style="background-image: url('../Resources/public/images/templates/basic/1-1.jpg'); width: 110px; border-top-left-radius: inherit;"></div>
                                <div style="padding: 10px;">
                                    <h1 class="mdc-typography--headline6"><span>Title</span></h1>
                                    <p>Content</p>
                                </div>
                            </div>
                            <hr class="mdc-list-divider">
                            <div class="mdc-card__actions">
                                <div class="mdc-card__action-buttons">
                                    <button class="mdc-button mdc-button--dense mdc-card__action mdc-card__action--button" type="button">Action</button>
                                </div>
                                <div class="mdc-card__action-icons">
                                    <i class="material-icons mdc-card__action mdc-card__action--icon mdc-ripple-surface"
                                        role="button"
                                        data-mdc-ripple-is-unbounded=""
                                        title="Share">share</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Chip</h2>
                <div>
                    <div class="mdc-chip">
                        <i class="material-icons mdc-chip__icon mdc-chip__icon--leading">event</i>
                        <div class="mdc-chip__text">Label</div>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Dialog</h2>
                <div>
                    <button class="mdc-button mdc-button--dense mdc-button--raised show_dialog" type="button">Show</button>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Checkbox</h2>
                <div>
                    <div class="mdc-form-field">
                        <div class="mdc-checkbox">
                            <input class="mdc-checkbox__native-control" type="checkbox"/>
                            <div class="mdc-checkbox__background">
                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                    <path class="mdc-checkbox__checkmark-path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                                </svg>
                                <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                        </div>
                        <label>Label</label>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Radio button</h2>
                <div>
                    <div class="mdc-form-field">
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" name="radio">
                            <div class="mdc-radio__background">
                                <div class="mdc-radio__outer-circle"></div>
                                <div class="mdc-radio__inner-circle"></div>
                            </div>
                        </div>
                        <label>Label</label>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Select</h2>
                <div>
                    <div class="mdc-select">
                        <select class="mdc-select__native-control">
                            <option value="" selected></option>
                            <option value="a">Option a</option>
                            <option value="b" disabled>Option b</option>
                            <option value="c">Option c</option>
                        </select>
                        <label class="mdc-floating-label mdc-floating-label--float-above">Label</label>
                        <div class="mdc-line-ripple"></div>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Slider</h2>
                <div>
                    <div class="mdc-slider" tabindex="0" role="slider" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-label="Drag">
                        <div class="mdc-slider__track-container">
                            <div class="mdc-slider__track"></div>
                        </div>
                        <div class="mdc-slider__thumb-container">
                            <svg class="mdc-slider__thumb" width="21" height="21">
                                <circle cx="10.5" cy="10.5" r="7.875"></circle>
                            </svg>
                            <div class="mdc-slider__focus-ring"></div>
                        </div>
                    </div>
                    <div class="mdc-slider mdc-slider--discrete" tabindex="0" role="slider" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-label="Drag">
                        <div class="mdc-slider__track-container">
                            <div class="mdc-slider__track"></div>
                        </div>
                        <div class="mdc-slider__thumb-container">
                            <div class="mdc-slider__pin">
                                <span class="mdc-slider__pin-value-marker"></span>
                            </div>
                            <svg class="mdc-slider__thumb" width="21" height="21">
                                <circle cx="10.5" cy="10.5" r="7.875"></circle>
                            </svg>
                            <div class="mdc-slider__focus-ring"></div>
                        </div>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Switch</h2>
                <div>
                    <div class="mdc-switch">
                        <input class="mdc-switch__native-control" type="checkbox" role="switch">
                        <div class="mdc-switch__background">
                            <div class="mdc-switch__knob"></div>
                        </div>
                    </div>
                    <label for="basic-switch">Off/On</label>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Text field</h2>
                <div>
                    <div class="form_row">
                        <div class="mdc-text-field mdc-text-field--box mdc-text-field--with-leading-icon mdc-text-field--dense">
                            <i class="material-icons mdc-text-field__icon" tabindex="0" role="button">face</i>
                            <input class="mdc-text-field__input" type="text" value="" autocomplete="off"/>
                            <label class="mdc-floating-label">Label</label>
                            <div class="mdc-line-ripple"></div>
                        </div>
                        <p class="mdc-text-field-helper-text" aria-hidden="true"></p>
                    </div>
                    <div class="form_row">
                        <div class="mdc-text-field mdc-text-field--box mdc-text-field--with-trailing-icon mdc-text-field--dense">
                            <input class="mdc-text-field__input" type="text" value="" autocomplete="off"/>
                            <label class="mdc-floating-label">Label</label>
                            <i class="material-icons mdc-text-field__icon" tabindex="0" role="button">face</i>
                            <div class="mdc-line-ripple"></div>
                        </div>
                        <p class="mdc-text-field-helper-text" aria-hidden="true"></p>
                    </div>
                    <div class="form_row">
                        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon mdc-text-field--dense">
                            <i class="material-icons mdc-text-field__icon" tabindex="0" role="button">face</i>
                            <input class="mdc-text-field__input" type="text" value="" autocomplete="off"/>
                            <label class="mdc-floating-label">Label</label>
                            <div class="mdc-notched-outline">
                                <svg>
                                    <path class="mdc-notched-outline__path"/>
                                </svg>
                            </div>
                            <div class="mdc-notched-outline__idle"></div>
                        </div>
                        <p class="mdc-text-field-helper-text" aria-hidden="true"></p>
                    </div>
                    <div class="form_row">
                        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mdc-text-field--dense">
                            <input class="mdc-text-field__input" type="text" value="" autocomplete="off"/>
                            <i class="material-icons mdc-text-field__icon" tabindex="0" role="button">face</i>
                            <label class="mdc-floating-label">Label</label>
                            <div class="mdc-notched-outline">
                                <svg>
                                    <path class="mdc-notched-outline__path"/>
                                </svg>
                            </div>
                            <div class="mdc-notched-outline__idle"></div>
                        </div>
                        <p class="mdc-text-field-helper-text" aria-hidden="true"></p>
                    </div>
                    <div class="form_row">
                        <div class="mdc-text-field mdc-text-field__basicTrailing mdc-text-field--dense">
                            <input class="mdc-text-field__input" type="text" value="" autocomplete="off"/>
                            <label class="mdc-floating-label">Label</label>
                            <i class="material-icons mdc-text-field__icon" tabindex="0" role="button">face</i>
                            <div class="mdc-line-ripple"></div>
                        </div>
                        <p class="mdc-text-field-helper-text" aria-hidden="true"></p>
                    </div>
                    <div class="form_row">
                        <div class="mdc-text-field mdc-text-field__basic mdc-text-field--dense">
                            <input class="mdc-text-field__input" type="text" value="" autocomplete="off"/>
                            <label class="mdc-floating-label">Label</label>
                            <div class="mdc-line-ripple"></div>
                        </div>
                        <p class="mdc-text-field-helper-text" aria-hidden="true"></p>
                    </div>
                    <div class="form_row">
                        <div class="mdc-text-field text-field mdc-text-field--textarea">
                            <textarea class="mdc-text-field__input"></textarea>
                            <label class="mdc-floating-label">Standard</label>
                            <div class="mdc-line-ripple"></div>
                        </div>
                        <p class="mdc-text-field-helper-text" aria-hidden="true"></p>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Linear progress</h2>
                <div>
                    <div class="mdc-linear-progress mdc-linear-progress--indeterminate linear_progress_a" role="progressbar" style="margin-bottom: 20px;">
                        <div class="mdc-linear-progress__buffering-dots"></div>
                        <div class="mdc-linear-progress__buffer"></div>
                        <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
                            <span class="mdc-linear-progress__bar-inner"></span>
                        </div>
                        <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
                            <span class="mdc-linear-progress__bar-inner"></span>
                        </div>
                    </div>
                    <div class="mdc-linear-progress linear_progress_b" role="progressbar" data-buffer="true" style="margin-bottom: 20px;">
                        <div class="mdc-linear-progress__buffering-dots"></div>
                        <div class="mdc-linear-progress__buffer"></div>
                        <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
                            <span class="mdc-linear-progress__bar-inner"></span>
                        </div>
                        <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
                            <span class="mdc-linear-progress__bar-inner"></span>
                        </div>
                    </div>
                    <div class="mdc-linear-progress mdc-linear-progress--reversed linear_progress_c" role="progressbar" style="margin-bottom: 20px;">
                        <div class="mdc-linear-progress__buffering-dots"></div>
                        <div class="mdc-linear-progress__buffer"></div>
                        <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
                            <span class="mdc-linear-progress__bar-inner"></span>
                        </div>
                        <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
                            <span class="mdc-linear-progress__bar-inner"></span>
                        </div>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">List</h2>
                <div>
                    <ul class="mdc-list mdc-list--two-line mdc-list--avatar-list">
                        <li class="mdc-list-item">
                            <span class="mdc-list-item__graphic material-icons" aria-hidden="true">folder</span>
                            <span class="mdc-list-item__text">
                                Title
                                <span class="mdc-list-item__secondary-text">Test</span>
                            </span>
                            <span class="mdc-list-item__meta material-icons" aria-hidden="true">info</span>
                        </li>
                        <li role="separator" class="mdc-list-divider"></li>
                        <li class="mdc-list-item">
                            <span class="mdc-list-item__graphic material-icons" aria-hidden="true">folder</span>
                            <span class="mdc-list-item__text">
                                Title
                                <span class="mdc-list-item__secondary-text">Test</span>
                            </span>
                            <span class="mdc-list-item__meta material-icons" aria-hidden="true">info</span>
                        </li>
                        <li role="separator" class="mdc-list-divider"></li>
                        <li class="mdc-list-item">
                            <span class="mdc-list-item__graphic material-icons" aria-hidden="true">folder</span>
                            <span class="mdc-list-item__text">
                                Title
                                <span class="mdc-list-item__secondary-text">Test</span>
                            </span>
                            <span class="mdc-list-item__meta material-icons" aria-hidden="true">info</span>
                        </li>
                    </ul>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Menu</h2>
                <div>
                    <button class="mdc-button mdc-button--dense mdc-button--raised" type="button">Open</button>
                    <div class="mdc-menu" tabindex="-1">
                        <ul class="mdc-menu__items mdc-list" role="menu" aria-hidden="true">
                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                Item a
                            </li>
                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                Item b
                            </li>
                        </ul>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Snackbar</h2>
                <div>
                    <button class="mdc-button mdc-button--dense mdc-button--raised show_snackbar" type="button">Show</button>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Tab</h2>
                <div>
                    <nav class="mdc-tab-bar mdc-tab-bar--icons-with-text">
                        <a class="mdc-tab mdc-tab--with-icon-and-text" href="javascript:void(0)">
                            <i class="material-icons mdc-tab__icon" aria-hidden="true">person</i>
                            <span class="mdc-tab__icon-text">Item a</span>
                        </a>
                        <a class="mdc-tab mdc-tab--with-icon-and-text" href="javascript:void(0)">
                            <i class="material-icons mdc-tab__icon" aria-hidden="true">account_balance</i>
                            <span class="mdc-tab__icon-text">Item b</span>
                        </a>
                        <span class="mdc-tab-bar__indicator"></span>
                    </nav>
                    <div class="mdc-tab-bar-scroller" style="margin-top: 20px;">
                        <div class="mdc-tab-bar-scroller__indicator mdc-tab-bar-scroller__indicator--back">
                            <a class="mdc-tab-bar-scroller__indicator__inner material-icons" href="javascript:void(0)" aria-label="scroll back button">navigate_before</a>
                        </div>
                        <div class="mdc-tab-bar-scroller__scroll-frame">
                            <nav class="mdc-tab-bar mdc-tab-bar-scroller__scroll-frame__tabs">
                                <a class="mdc-tab" href="javascript:void(0)">Item a</a>
                                <a class="mdc-tab" href="javascript:void(0)">Item b</a>
                                <a class="mdc-tab" href="javascript:void(0)">Item c</a>
                                <a class="mdc-tab" href="javascript:void(0)">Item d</a>
                                <a class="mdc-tab" href="javascript:void(0)">Item e</a>
                                <a class="mdc-tab" href="javascript:void(0)">Item f</a>
                                <a class="mdc-tab" href="javascript:void(0)">Item g</a>
                                <a class="mdc-tab" href="javascript:void(0)">Item h</a>
                                <a class="mdc-tab" href="javascript:void(0)">Item i</a>
                                <span class="mdc-tab-bar__indicator"></span>
                            </nav>
                        </div>
                        <div class="mdc-tab-bar-scroller__indicator mdc-tab-bar-scroller__indicator--forward">
                            <a class="mdc-tab-bar-scroller__indicator__inner material-icons" href="javascript:void(0)" aria-label="scroll forward button">navigate_next</a>
                        </div>
                    </div>
                </div>
                <h2 class="demo-title mdc-typography--headline6">Datepicker</h2>
                <div>
                    <div class="form_row">
                        <div class="mdc-text-field mdc-text-field__basic mdc-text-field--dense">
                            <input class="mdc-text-field__input widget_datePicker_input" type="text" value="" autocomplete="off"/>
                            <label class="mdc-floating-label">Date</label>
                            <div class="mdc-line-ripple"></div>
                        </div>
                        <p class="mdc-text-field-helper-text" aria-hidden="true"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mdc-card__actions">
        <div class="page_footer"></div>
    </div>
</div>
XYZ;
echo $html;