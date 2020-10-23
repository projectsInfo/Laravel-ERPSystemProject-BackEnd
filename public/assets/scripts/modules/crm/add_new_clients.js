$(document).ready(function() {
    const addClientAddressBtn = $(".add-client-address-btn");
    const addClientPhoneBtn = $(".add-client-phone-btn");
    const addClientPhoneInfo = $(".add-client-phone-info");
    const addClientAddressInfo = $(".add-client-address-info");
    /*----------------
    *   Validation 
    *-----------------*/
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
    }, "Don't leave space");
    jQuery.validator.addMethod("startZero", function(value) {
        return value.match(/^0+/); 
    }, "phone should start with zero");
    // const variables of btns
    var formCreate = $('.create form');
    var formvalid = $(".general-form ").validate({
        onkeyup: function(element) {$(element).valid()},
        rules: {
            name: {
                required: true,
                noSpace: true,
            },
            "city[]": {
                required: true,
            },
            "region[]": {
                required: true,
            },
            "mobile[]": {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 15,
                startZero:true,
            },
            facebook_account: {
                required: true,
                facebook: true
            },
            Whats: {
                required: true,
                number: true
            }
        },
        messages: {
            "mobile[]": {
                minlength: "enter at least 10 numbers",
                maxlength: "phone should less than 15 numbers",
            },
        },
    });


    var form = $('.form-create');
    var loader = $('.spinner');
    var backLoader = $('.back-loader');


    formCreate.on('submit', function (e) {
    if( formvalid.valid() ) {
        e.preventDefault();
        var dataForm = form.serialize(),
            url = form.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                // data: dataForm ,
                data:new FormData(this),
                processData: false,
                contentType: false,

                cache: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    backLoader.fadeOut(100,function() {
                        loader.fadeOut(1000);
                    });
                    var hasError = $('.has-error');
                    hasError.removeClass('has-error');
                    $(".general-form")[0].reset();
                    // formCreate.resetForm();
                    addClientAddressInfo.empty();
                    addClientPhoneInfo.empty();
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    console.log('done');
                    
                    
                },
                beforeSend: function () {
                    backLoader.fadeIn(100,function() {
                        loader.fadeIn(1000);
                    });
                },
                error: function (errors, exp) {
                    backLoader.fadeOut(100,function() {
                        loader.fadeOut(1000);
                    });
                    Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    })
                    var error_array = errors.responseJSON.errors,
                        errors_print = '';
                    
                    console.log(error_array);
                    $.each(error_array, function (key, val) {
                        console.log(key);
                        
                        errors_print += val[0] + '<br>';
                
                        $('#'+key).val('');

                        var geterror = $('.'+key+'-error');
                        
                            geterror.html(val);
                            geterror.addClass('error');
                            geterror.slideDown(400);
                            geterror.parent().addClass('has-error');

                    });
                }
            };
            $.ajax(dataAjax);
        }
    });

    


    /*---------------------
    *   edit submit form Btn
    ------------------*/


    var formEdit = $('.form-edit');

    formEdit.on('submit', function (e) {
        console.log('test');
        
    if( formvalid.valid() ) {
        e.preventDefault();
        var dataForm = formEdit.serialize(),
            url = formEdit.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                // data: { _method: "PUT" },
                data: dataForm + '&delete_ids[address]=' + array_ids_deleted_when_update.address + '&delete_ids[mobile]=' + array_ids_deleted_when_update.mobile ,
                // data:new FormData(this)
                processData: false,
                // contentType: false,

                cache: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    backLoader.fadeOut(100,function() {
                        loader.fadeOut(1000);
                    });
                    var hasError = $('.has-error');
                    hasError.removeClass('has-error');
                    // console.log(editUserForm);
                    // editUserForm.resetForm();
                    // $('.form-reset').click();
                    // $('.remove-img').click();
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    console.log(response.link);

                    setTimeout(function() { 
                        window.location = response.link;
                    }, 3000);
                },
                beforeSend: function () {
                    backLoader.fadeIn(100,function() {
                        loader.fadeIn(1000);
                    });
                },
                error: function (errors, exp) {
                    backLoader.fadeOut(100,function() {
                        loader.fadeOut(1000);
                    });
                    Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    })
                    var error_array = errors.responseJSON.errors,
                        errors_print = '';
                    
                    console.log(error_array);
                    $.each(error_array, function (key, val) {
                        console.log(key);
                        
                        errors_print += val[0] + '<br>';
                
                        $('#'+key).val('');

                        var geterror = $('.'+key+'-error');
                        
                            geterror.html(val);
                            geterror.addClass('error');
                            geterror.slideDown(400);
                            geterror.parent().addClass('has-error');

                    });
                }
            };
            $.ajax(dataAjax);
        }
    });
   
});
