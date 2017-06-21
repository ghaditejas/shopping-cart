$(document).ready(function () {
    $("#login").validate({
        rules: {
            email: {
                required: true,
                email: true,
                email_val: true
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
                email_val: true
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
            select_role: {
                required: "Please Select Your role"
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
                digits: true
            },
            uses: {
                required: true,
                digits: true
            },
        },
        messages: {
            coupon_code: {
                required: "This field is Required",
            },
            percent: {
                required: "This field is Required",
                digits: "This field must contain only digits."
            },
            uses: {
                required: "This field is Required",
                digits: "This field must contain only digits."
            },

        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("#add_category").validate({
        rules: {
            category_name: {
                required: true,
                specialChar: true
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
                specialChar: true
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
                money: true
            },
            special_price: {
                money: true
            },
            special_price_to: {
                checkdate: true
            },
            quantity: {
                required: true,
                digits: true
            },
            sku: {
                required: true,
                specialChar: true
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
        submitHandler: function (form, event) {
            var valid = true;
            var err = '<label class="error">This field is Required</label>';
            $('.select_attrbute').each(function (i, t) {
                if ($(this).val() != "") {
                    if ($('.attribute_val').eq(i).val() == "") {
                        valid = false;
                        $('.attribute_val').eq(i).closest('div').append(err);
                    } else {
                        $('.attribute_val').eq(i).closest('div').find('.error').remove();
                    }
                }
            });
            console.log(valid);
            if (!valid) {
                event.preventDefault();
            } else {
                form.submit();
            }

        }

    });
    
    $("#edit_config").validate({
        rules: {
            conf_val: {
                required: true
            },
        },
        messages: {
            conf_val: {
                required: "This field is Required",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    
    $("#add_note").validate({
        rules: {
            note: {
                required: true
            },
        },
        messages: {
            note: {
                required: "This field is Required",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    
    $("#add_cms").validate({
        rules: {
            title: {
                required: true,
                sentence: true
            },
            content: {
                required: true,
            },
            meta_title: {
                required: true,
                sentence: true
            },
            meta_description: {
                required: true,
                sentence: true
            },
            meta_keywords: {
                required: true,
                sentence: true
            },
        },
        messages: {
            title: {
                required: "This field is Required"
            },
            content: {
                required: "This field is Required"
            },
            meta_title: {
                required: "This field is Required"
            },
            meta_description: {
                required: "This field is Required"
            },
            meta_keywords: {
                required: "This field is Required"
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    
});


