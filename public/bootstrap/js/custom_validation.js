$.validator.addMethod("pass", function (value, element) {
    return this.optional(element) || !(/[\!@#$%&*()]/.test(value));
},
        'Invalid Password: Password cannot contain special characters');


$.validator.addMethod("email_val", function (value) {
    var exp = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return exp.test(value);
},
        'Invalid Email ID');

$.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
}, "This field may only contain alphabetical characters.");

$.validator.addMethod("specialChar", function (value, element) {
    return this.optional(element) || /([0-9a-zA-Z\s])$/.test(value);
}, "Please Fill Correct Value in Field.");

$.validator.addMethod("money", function (value, element) {
    return(/^\d{0,9}(\.\d{0,2})?$/.test(value));
},
        "Invald Price:Insert valid Price");

$.validator.addMethod("checkdate", function (value, element) {
    if ($('#special_price').val() != "") {
        var start_date = new Date($('#special_price_from').val());
        var start_time = start_date.getTime();
        var end_date = new Date(value);
        var end_time = end_date.getTime();
        if ((end_time - start_time) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
},
        "Please Choose Proper date");
        
$.validator.addMethod("sentence", function (value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "This field may only contain alphabetical characters.");
        