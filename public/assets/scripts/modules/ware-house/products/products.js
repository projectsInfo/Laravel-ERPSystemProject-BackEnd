$(document).ready(function() {
    $("#demo").spartanMultiImagePicker({
        fieldName:  'fileUpload[]',
        maxCount : 10,
        rowHeight :'164.4px',
        allowedExt:'png|jpg|jpeg|gif',
        groupClassName : 'col-6 w-50 d-inline-block',
    });

    $('.upload-file').on('click', function() {
        $('.file_upload:last').click();
    });
    /*--------
    validation
    ---------- */
    jQuery.validator.addMethod('le', function (value, element, param) {
        return this.optional(element) || parseInt(value) > parseInt($(param).val());
    }, 'Enter a number greater than this');

    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
    }, "Don't leave space");

    const createUserForm = $('form.create-procuts-form');
    createUserForm.validate({
        rules: {
            name: {
                required: true,
                noSpace: true
            },
            style: {
                required: true
            },
            material: {
                required: true
            },
            tradesalePrice: {
                required: true,
                number: true
            },
            sellingPrice: {
                required: true,
                number: true
            },
            sizeFrom: {
                required: true,
                number: true
            },
            sizeTo: {
                required: true,
                number: true,
                le: '#sizeFrom',
            },
            messages: {
                sizeTo: {
                    le: 'Must be less than bid price.'
                }
            }
        }
    });
    $('[name="sizeFrom"]').on('change blur keyup', function() {
        $('[name="sizeTo"]').valid();
    });


        /*-----------------
    *   Add Btn
    ------------------*/


    var form = $('.form-create');
    var loader = $('.spinner');
    var backLoader = $('.back-loader');


    form.on('submit', function (e) {
    if( form.valid() ) {
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
                    // console.log(createUserForm);
                    // createUserForm.resetForm();
                    $('.exit-btn').click();
                    // $('.remove-img').click();
                    $('.tags.color-tags').empty();
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
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









