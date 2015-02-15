// Global Variables
var errorColor = "#777777";
var u_minL = 2;
var u_maxL = 32;
var e_minL = 6;
var e_maxL = 64;
var p_minL = 8;
var p_maxL = 64;
var fn_minL = 0;
var fn_maxL = 64;


/* ==============================
    General Field Validations
   ============================== */

// Check if field is empty
function isEmpty(field) {
    "use strict";
    if (field.value === "") {
        return true;
    }
    return false;
}

// Check if length of field is within a given range
function insideRange(field, min, max) {
    "use strict";
    if (field.value.length <= max && field.value.length >= min) {
        return true;
    }
    return false;
}


// Check if field contains only alphabetic characters
function isAlphabetic(field) {
    "use strict";
    if ((/^[0-9a-zA-Z\-'_]+$/.test(field.value))) {
        return true;
    }
    return false;
}


/* ==============================
    Specific Field Validations
   ============================== */

// Validate a username field
function validateUsername(usernameField) {
    "use strict";
    if (isEmpty(usernameField) || !insideRange(usernameField, u_minL, u_maxL) || !isAlphabetic(usernameField)) {
        usernameField.style.borderColor = errorColor;
        return false;
    }
    usernameField.removeAttribute("style");
    return true;
}
