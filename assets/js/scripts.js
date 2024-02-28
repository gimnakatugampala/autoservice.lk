// Email Validation
function validateEmail(email) {
    // Regular expression for a simple email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Test the email against the regular expression
    return emailRegex.test(email);
}

function generateRandomString(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}


// Generate Code
// Generate ID
function generateUUID() {
    var d = new Date().getTime(); // Timestamp
    var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now() * 1000)) || 0; // Time in microseconds since page-load or 0 if unsupported
    return 'xx4xsxyy'.replace(/[xy]/g, function (c) {
        var r = Math.random() * 36; // Random number between 0 and 36 (inclusive)
        var randChar;
        if (r < 10) { // 0-9
            randChar = String.fromCharCode(48 + r);
        } else if (r < 26) { // a-z
            randChar = String.fromCharCode(97 + r - 10);
        } else { // A-Z
            randChar = String.fromCharCode(65 + r - 26);
        }
        return randChar;
    }) + generateRandomString(12);
}



//   Remove Phone Number Zero
function removeLeadingZeros(phoneNumber) {
    // Check if the phone number starts with a zero
    if (phoneNumber.startsWith('0')) {
        // Use regular expression to remove leading zeros
        return phoneNumber.replace(/^0+/, '');
    } else {
        return phoneNumber;
    }
}
  
