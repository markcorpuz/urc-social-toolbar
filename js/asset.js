/* --------------------------------------------------------------------------------------------
 * | SOCIAL TOOLBAR
 * ----------------------------------------------------------------------------------------- */
// ShowHideBottomLess is a variable in preparation of a button that'll have the top of the current toolbar
var winHeight, winWidth, ShowHideSpeed = 500, BreakPoint = 1159,
    DivHeight, ShowHidePointer = 2, ShowHideBottomLess = 0, FadeSpeed = "moderate",
    PrevGetToolBarHeight, ThisDiv, ParentSub, SubComp;


/* ###################################################
 * # Wait till document has loaded
 * ################################################ */
jQuery(document).ready(function() {
    
    /* ---------------------------------------------------
     * | Show social toolbar after document loads
     * ------------------------------------------------ */
    ShowHideSocialToolbar();
    
    /* ---------------------------------------------------
     * | Get the Social Toolbar's height and
     * | use that height as the Show/Hide button's bottom
     * ------------------------------------------------ */
    jQuery(".showhide")
        .delay(2000)
        .css( "bottom", ( GetToolBarHeight() - ShowHideBottomLess ) )
        .fadeIn(FadeSpeed); // show

});

/* ###################################################
 * # Handle window resize event
 * ################################################ */
jQuery( window ).resize( function() {

    ShowHideSocialToolbar();
    RecalibrateShowMeBtn();
    
});

/* ###################################################
 * # SOCIAL TOOLBAR - FULL | DONATE / SUPPORT
 * ################################################ */
jQuery(".st_desktop_donate").on("click", function() {
    
    // hide show/hide button
    FadeShowHideIcon();
    
    // hide other divs
    HideOthers("st_desktop_donate_pop");
    
    // show / hide the div
    jQuery(".st_desktop_donate_pop").toggle( "slide", { direction: "down" }, ShowHideSpeed, function() {
        // recalibrate show/hide button
        FadedRecalibrateShowMeBtn();
    });
    
});

/* ###################################################
 * # SOCIAL TOOLBAR - FULL | BOOK
 * ################################################ */
jQuery(".st_desktop_book").on("click", function() {
    
    // hide show/hide button
    FadeShowHideIcon();
    
    // hide other divs
    HideOthers("st_desktop_book_pop");
    
    // show / hide the div
    jQuery(".st_desktop_book_pop").toggle( "slide", { direction: "down" }, ShowHideSpeed, function() {
        // recalibrate show/hide button
        FadedRecalibrateShowMeBtn();
    });
    
});

/* ###################################################
 * # SOCIAL TOOLBAR - FULL | PRODUCTS
 * ################################################ */
jQuery(".st_desktop_products").on("click", function() {
    
    // hide show/hide button
    FadeShowHideIcon();
    
    // hide other divs
    HideOthers("st_desktop_products_pop");
    
    // show / hide the div
    jQuery(".st_desktop_products_pop").toggle( "slide", { direction: "down" }, ShowHideSpeed, function() {
        // recalibrate show/hide button
        FadedRecalibrateShowMeBtn();
    });
    
});

/* ###################################################
 * # SOCIAL TOOLBAR - COMPACT | FOLLOW
 * ################################################ */
jQuery(".st_mobile_follow").on("click", function() {
    
    // hide show/hide button
    FadeShowHideIcon();
    
    // hide other divs
    HideOthers("st_mobile_follow_2");
    
    // show / hide the div
    jQuery(".st_mobile_follow_2").toggle( "slide", { direction: "down" }, ShowHideSpeed, function() {
        // recalibrate show/hide button
        FadedRecalibrateShowMeBtn();
    });
    
});

/* ###################################################
 * # SOCIAL TOOLBAR - COMPACT | DONATE
 * ################################################ */
jQuery(".st_mobile_donate").on("click", function() {
    
    // hide show/hide button
    FadeShowHideIcon();
    
    // hide other divs
    HideOthers("st_mobile_donate_2");
    
    // show / hide the div
    jQuery(".st_mobile_donate_2").toggle( "slide", { direction: "down" }, ShowHideSpeed, function() {
        // recalibrate show/hide button
        FadedRecalibrateShowMeBtn();
    });
    
});

/* ###################################################
 * # SOCIAL TOOLBAR - COMPACT | SHARE
 * ################################################ */
jQuery(".st_mobile_share").on("click", function() {
    
    // hide show/hide button
    FadeShowHideIcon();
    
    // hide other divs
    HideOthers("st_mobile_share_2");
    
    // show/hide the div
    jQuery(".st_mobile_share_2").toggle( "slide", { direction: "down" }, ShowHideSpeed, function() {
        // recalibrate show/hide button
        FadedRecalibrateShowMeBtn();
    });
    
});

/* ###################################################
 * # SOCIAL TOOLBAR - COMPACT | BUY BOOK
 * ################################################ */
jQuery(".st_mobile_buybook").on("click", function() {
    
    // hide show/hide button
    FadeShowHideIcon();
    
    // hide other divs
    HideOthers("st_mobile_buybook_2");
    
    // show / hide the div
    jQuery(".st_mobile_buybook_2").toggle( "slide", { direction: "down" }, ShowHideSpeed, function() {
        // recalibrate show/hide button
        FadedRecalibrateShowMeBtn();
    });
    
});

/* ###################################################
 * # FUNCTION TO HIDE OTHER COMPACT, PARENT DIVs
 * ################################################ */
function HideOthers(NotThis) {
    
    jQuery.each(["st_mobile_follow_2",
                 "st_mobile_donate_2",
                 "st_mobile_share_2",
                 "st_mobile_buybook_2",
                 "st_desktop_donate_pop",
                 "st_desktop_book_pop",
                 "st_desktop_products_pop"], function( index, value ) {
        
        if( NotThis != value ) {
            
            //alert( index + ": " + value );
            if( jQuery("." + value).is(":visible") ) {
                jQuery("." + value).hide( "slide", { direction: "down" }, ShowHideSpeed );
            }
            
        }
        
    });
    
}

/* ###################################################
 * # LISTEN FOR CLICKS ON THE SHOW/HIDE ICON
 * ################################################ */
jQuery("#showhide_icon").on("click", function () {
    
    /* ---------------------------------------------------
     * | ShowHidePointer
     * ------------------------------------------------ */
    if( ShowHidePointer == 1 ) {
        
         // hide down arrow
        jQuery(this).fadeOut(FadeSpeed, function() {
            
            // move the entire div down | set bottom position
            RecalibrateShowMeBtn();
            
            // rotate then show
            jQuery(this)
                .removeClass('rotate0') // remove class pointing up
                .addClass('rotate180') // set class pointing down
                .fadeIn(FadeSpeed); // show
            
        });
        
        // set direction
        ShowHidePointer = 2;
        
    } else {
        
        // hide compact if visible
        if( jQuery("#st_mobile").is(":visible") ) {
            
            // check if either one of the sub compact is showing
            jQuery.each(["st_mobile_follow_2",
                         "st_mobile_donate_2",
                         "st_mobile_share_2",
                         "st_mobile_buybook_2"], function( index, value ) {
                
                if( jQuery("." + value).is(":visible") ) {
                    
                    // hide sub compact first
                    jQuery("." + value).hide( "slide", { direction: "down" }, ShowHideSpeed, function() {
                        // hide compact
                        jQuery("#st_mobile").hide( "slide", { direction: "down" }, ShowHideSpeed );
                    });
                    
                    // indicate that all toolbars are hidden
                    SubComp = 1;
                    return false; // exit each loop
                    
                } else {
                    
                    SubComp = '';
                    
                }
                
            });
            
            // if no sub compact, hide compact
            if( !SubComp ) {
                jQuery("#st_mobile").hide( "slide", { direction: "down" }, ShowHideSpeed );
            }
            
        }
        
        // hide full width toolbar if visible
        if( jQuery("#st_desktop").is(":visible") ) {
            
            // check if either one of the sub full toolbar is showing
            jQuery.each(["st_desktop_donate_pop",
                         "st_desktop_book_pop",
                         "st_desktop_products_pop"], function( index, value ) {
                
                if( jQuery("." + value).is(":visible") ) {
                    
                    // hide sub full first
                    jQuery("." + value).hide( "slide", { direction: "down" }, ShowHideSpeed, function() {
                        // hide full
                        jQuery("#st_desktop").hide( "slide", { direction: "down" }, ShowHideSpeed );
                    });
                    
                    // indicate that all toolbars are hidden
                    ParentSub = 1;
                    return false; // exit each loop
                    
                } else {
                    
                    ParentSub = '';
                    
                }
                
            });
            
            // if no sub compact, hide compact
            if( !ParentSub ) {
                jQuery("#st_desktop").hide( "slide", { direction: "down" }, ShowHideSpeed );
            }
            
        }
        
        // hide down arrow
        jQuery(this).fadeOut(FadeSpeed, function() {
            
            // move the entire div down | set bottom position
            jQuery(".showhide").css( "bottom", "0" );
            
            // rotate then show
            jQuery(this)
                .removeClass('rotate180') // remove class pointing down
                .addClass('rotate0') // set class pointing up
                .fadeIn(FadeSpeed); // show
            
        });
        
        // set direction
        ShowHidePointer = 1;
        
    }
    
    // show toolbar | function decides what toolbar to show
    ShowHideSocialToolbar();
    
});

/* ###################################################
 * # THIS WILL GET THE CURRENT TOLLBAR'S HEIGHT
 * ################################################ */
function GetToolBarHeight() {
    
    //if( jQuery("#st_desktop").is(":visible") ) {
    if( jQuery(window).width() >= BreakPoint ) {
        
        // check if either one of the sub full is showing
        jQuery.each(["st_desktop_donate_pop",
                     "st_desktop_book_pop",
                     "st_desktop_products_pop"], function( index, value ) {
            
            if( jQuery("." + value).is(":visible") ) {
                
                ThisDiv = jQuery("." + value).outerHeight();
                return false; // exit each loop
                
            } else {
                
                ThisDiv = '';
                
            }
            
        });
        
        return jQuery("#st_desktop").outerHeight() + ThisDiv;
       
    } else {
        
        // check if either one of the sub compact is showing
        jQuery.each(["st_mobile_follow_2",
                     "st_mobile_donate_2",
                     "st_mobile_share_2",
                     "st_mobile_buybook_2"], function( index, value ) {
            
            if( jQuery("." + value).is(":visible") ) {
                
                ThisDiv = jQuery("." + value).outerHeight();
                return false; // exit each loop
                
            } else {
                
                ThisDiv = '';
                
            }
            
        });

        return jQuery("#st_mobile").outerHeight() + ThisDiv;
    }

}

/* ###################################################
 * # Function to hide or show the div
 * ################################################ */
function ShowHideSocialToolbar() {
    
    // hide sub compacts
    if( jQuery(window).width() == BreakPoint || jQuery(window).width() == (BreakPoint - 1) ) {
        HideOthers();
    }
    
    // hide either full or compact version
    if( ShowHidePointer == 2 ) {
        
        if( jQuery(window).width() >= BreakPoint ) {
            
            // hide sub compacts
            jQuery.each(["st_mobile_follow_2",
                         "st_mobile_donate_2",
                         "st_mobile_share_2",
                         "st_mobile_buybook_2"], function( index, value ) {
                
                if( jQuery("." + value).is(":visible") ) {
                    jQuery("." + value).hide( "slide", { direction: "down" }, ShowHideSpeed );
                }

            });
            
            jQuery("#st_mobile").hide( "slide", { direction: "down" }, ShowHideSpeed );
            jQuery("#st_desktop").show( "slide", { direction: "down" }, ShowHideSpeed );
            
        } else {
            
            // hide sub desktops
            jQuery.each(["st_desktop_donate_pop",
                         "st_desktop_book_pop",
                         "st_desktop_products_pop"], function( index, value ) {
                
                if( jQuery("." + value).is(":visible") ) {
                    jQuery("." + value).hide( "slide", { direction: "down" }, ShowHideSpeed );
                }
                
            });
            
            jQuery("#st_desktop").hide( "slide", { direction: "down" }, ShowHideSpeed );
            jQuery("#st_mobile").show( "slide", { direction: "down" }, ShowHideSpeed );
            
        }
        
    }
    
}

/* ###################################################
 * # Function to reposition the Show/Hide button
 * ################################################ */
function RecalibrateShowMeBtn() {
    
    if( ShowHidePointer == 2 ) {    
        /* ---------------------------------------------------
         * | Get the Social Toolbar's height and
         * | use that height as the Show/Hide button's bottom
         * ------------------------------------------------ */
        jQuery(".showhide")
            .css({
                bottom: ( GetToolBarHeight() - ShowHideBottomLess )
            });
        
    }
    
}

/* ###################################################
 * # Hide Show/Hide button as preparation
 * # for FadedRecalibrateShowMeBtn function
 * ################################################ */
function FadeShowHideIcon() {
    
    jQuery("#showhide_icon").fadeOut(FadeSpeed);
    
}

/* ###################################################
 * # Function to hide, reposition the
 * # Show/Hide button, then show
 * ################################################ */
function FadedRecalibrateShowMeBtn() {
    
    RecalibrateShowMeBtn();
    jQuery("#showhide_icon").fadeIn(FadeSpeed); // show
    
}