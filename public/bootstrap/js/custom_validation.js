$.validator.addMethod("pass", function (value,element) {
   return this.optional(element) ||!(/[\!@#$%&*()]/.test(value));
}, 
'Invalid Password: Password cannot contain special characters');


$.validator.addMethod("email_val", function (value){
   var exp= /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
   return exp.test(value);
},
  'Invalid Email ID');

$.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "This field may only contain alphabetical characters."); 

$.validator.addMethod("specialChar", function(value, element) {
     return this.optional(element) || /([0-9a-zA-Z\s])$/.test(value);
  }, "Please Fill Correct Value in Field.");
  
$.validator.addMethod("money",function(value, element) {
        return(/^\d{0,9}(\.\d{0,2})?$/.test(value));
    },
    "Invald Price:Insert valid Price");
    
$.validator.addMethod("checkdate",function(value, element) {
    var start_date=new Date($('#special_price_from').val());
    console.log(start_date);
    var start_time = start_date.getTime();
    console.log(start_time);
    var end_date = new Date(value);
    var end_time = end_date.getTime();
    console.log(end_time);
    if((end_time - start_time)>0){
        console.log("true");
        return true; 
    }else {
        console.log("false");
        return false;
    }
    },
    "Please Choose Proper date");