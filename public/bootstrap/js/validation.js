$(document).ready(function () {
    $("#login").validate({
        rules: {
            email: {
                required: true,
                email: true,
                email_val:true
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "This field is Required",
                email: "Enter a Valid Email ID"
            },
            password: {
                required: "This field is Required",
            },
        },
        submitHandler: function (form) {
                form.submit();
            }
    });
    
    $("#add_user").validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            email: {
                required: true,
                email: true,
                email_val:true
            },
            password: {
                required: true,
                pass: true,
                minlength: 8,
                maxlength: 12
            },
            confirm_password: {
                required: true,
                equalTo: "#pass"
            },
            select_role: {
                required: true
            },
        },
        messages: {
            firstname: " This field is Required",
            lastname: "This field is Required",
            email: {
                required: "This field is Required",
                email: "Enter a Valid Email ID"
            },
            password: {
                minlength: "Invalid Password : Less than 8 characters",
                maxlength: "Invalid Password : More Than 12 characters"
            },
            confirm_password: {
                required: "This field is Required",
                equalTo: "Password don't match"
            },
            select_role:{
              required:"Please Select Your role"  
            }
        },
        submitHandler: function (form) {
                form.submit();
            }
    });
    
    $("#add_banner").validate({
        rules: {
            banner_img: {
                required: true,
                accept: "image/jpeg, image/png"
            },
        },
        messages: {
            banner_img: {
                required: "This field is Required",
            },
        },
        submitHandler: function (form) {
                form.submit();
            }
    });
    
    $("#add_coupon").validate({
        rules: {
            coupon_code: {
                required: true,
            },
            percent: {
                required: true,
                number: true
            },
            uses: {
                required: true,
                number: true
            },
            
        },
        messages: {
            coupon_code: {
                required: "This field is Required",
            },
            percent: {
                required: "This field is Required",
                number: "This field must contain only numbers."
            },
            uses: {
                required: "This field is Required",
                number: "This field must contain only numbers."
            }
            
        },
        submitHandler: function (form) {
                form.submit();
            }
    });
    
    $("#add_category").validate({
        rules: {
            category_name: {
                required: true,
                lettersonly: true
            },
        },
        messages: {
            category_name: {
                required: "This field is Required",
            },
        },
        submitHandler: function (form) {
                form.submit();
            }
    });
    
    $("#add_attribute").validate({
        rules: {
            product_attribute: {
                required: true,
                specialChar:true
            },
        },
        messages: {
            product_attribute: {
                required: "This field is Required",
            },
        },
        submitHandler: function (form) {
                form.submit();
            }
    });
    
    $("#add_product").validate({
        rules: {
            product_name: {
                required: true
            },
            product_img: {
                required: true,
                accept: "image/jpeg, image/png"
            },
            category: {
                required: true
            },
            price: {
                required: true,
                money:true
            },
            special_price: {
                required: true,
                money:true
            },
            special_price_from: {
                required: true
            },
            special_price_to: {
                required: true,
                checkdate: true
            },
            quantity: {
                required: true,
                digits:true
            },
            sku: {
                required: true,
                specialChar:true
            },
            short_description: {
                required: true
            },
            meta_title: {
                required: true
            }
        },
        messages: {
            product_name: {
                required: "This field is Required"
            },
            product_img: {
                required: "This field is Required"
            },
            category: {
                required: "This field is Required"
            },
            price: {
                required: "This field is Required"
            },
            special_price: {
                required: "This field is Required"
            },
            special_price_from: {
                required: "This field is Required"
            },
            special_price_to: {
                required: "This field is Required"
            },
            quantity: {
                required: "This field is Required",
                number: "Please enter a number"
            },
            sku: {
                required: "This field is Required"
            },
            short_description: {
                required: "This field is Required"
            },
            meta_title: {
                required: "This field is Required"
            }
        },
        submitHandler: function (form) {
                form.submit();
            }
    });
});


