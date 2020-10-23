$(document).ready(function() {

    // // Checkbox toggle when clicked
    $(".checkbox-label").click(function() {
        $(this).toggleClass('activeInput');
    });

    $(".check-all button").on("click", function() {
        if ($(".checkbox-label").hasClass('activeInput')) {
            $(".checkbox-label").removeClass('activeInput');
            $(".checkhour").prop("checked", false);
        } else {
            $(".checkbox-label").addClass('activeInput');
            $(".checkhour").prop("checked", true);
        }
    });

    /*-----------------
    *   Validaiton
    ------------------*/
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
    }, "Don't leave space");

    // const createUserForm = $('.general-form');
    var createUserForm = $('.general-form').validate({
        onkeyup: function(element) {$(element).valid()},
        rules : {
            name: {
                required: true,
                noSpace:true,
            },
            "permissions[]": {
                required:true
            }
        },
        messages: {
            "permissions[]": {
                required:"select at least one",
            },
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text(trans.success)
        }
    });

    
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })



    /*-----------------
    *   delite Btn
    ------------------*/
    $(document).on('click','.delBtns', function (e) {
    // $( ".delBtns" ).click(function() {
        console.log('etdst');
        
        var $this = $(this),
        DelUrl = $this.attr("del-url"),
        DelName = $this.attr("del-name"),
        title = "تـم الحذف",
        message = "تم الحذف بنجاح";
        

        

        swalWithBootstrapButtons.fire({ 
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                
                $.ajax({
                    url: DelUrl,
                    dataType: "json",
                    cache: false,
                    /*contentType: false,
                    processData: false,*/
                    data: { _method: "Delete" },
                    type: "post",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(data) {
                        var status = data.status;
                        if (status === true) {
                            $this.parents("tr").fadeOut(500, function() {
                                $(this).remove();
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                oTable.ajax.reload();
                                $('.form-create').show(100 ,function () {
                                    $('.form-edit').addClass('d-none');
                                });
                            });
                        }else if (status === false) {
                            swal("لم يتم الحذف");
                        }
                        
                    },
                    error : function() {
                        swal("خطاء ف الادخال");
                    }
                });
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
            }
        })

    });




    /*-----------------
    *   Add Btn
    ------------------*/


    var form = $('.form-create');
    var loader = $('.spinner');
    var backLoader = $('.back-loader');


    form.on('submit', function (e) {
        e.preventDefault();
        $('input[type="checkbox"]').removeClass('active');
    if( form.valid() ) {
        var dataForm = form.serialize(),
            url = form.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                data: dataForm ,
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
                    $('.btn-reset').click();
                    $(".checkbox-label").removeClass("active");
                    Swal.fire({
                        type: 'success',
                        title: response.Message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    oTable.ajax.reload();
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
                    $.each(error_array, function (key, val) {
                        errors_print += val[0] + '<br>';
                        $('#'+key).val('');
                        var geterror = $('#'+key+'-error');
                            geterror.html(val);
                            geterror.removeClass('validation-valid-label');
                    });
                }
            };
            $.ajax(dataAjax);
        }
    });




    $(document).on('click','.edit-Btn', function (e) {
        console.log("adite");
        
        e.preventDefault();
        var $this = $(this),
        CatId = $this.attr("edit-url"),
        message = $this.attr("data-message");

                console.log('yes');
                $.ajax({
                url: CatId,
                dataType: "json",
                cache: false,
                /*contentType: false,
                processData: false,*/
                data: { _method: "get" },
                type: "get",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(data) {
                    $('.widget-content:last').slideUp(600 , function () {
                        $('.widget-content:first').slideDown(1000);
                    });
                    $('.form-create').hide(100 ,function () {
                        $('.form-edit').removeClass('d-none');
                        
                    });
                    var status = data.status;
                    if (status === true) {
                    var url = window.location.origin;
                    var urlaction = url+'/department/'+data.data.id;
                    console.log(data);
                    
                    $('.form-edit').attr('action',urlaction);
                    $('#name_edit').val(data.data.name);
                    $.each(data.permissions, function (key, val) {
                        console.log(val);
                        $('#'+val+'_edit').click();
                        $("#" + val + "_edit").addClass("active");
                        
                    });
                    // if(data.departments === 0){
                    //     $('#departments-edit').val('');
                    // }else{
                    //     $('#departments-edit').val(data.departments);
                    // }
                    $('.add-department').children().children('.widget-title').html('Edit '+data.data.name);
                        
                    }else if(status === false) {
                        Swal.fire({
                            title: data.message,
                            text: message,
                            type: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                }
            });
        });






    /*---------------------
    *   edit submit form Btn
    ------------------*/


    var formEdit = $('.form-edit');
    var loader = $('.spinner');
    var backLoader = $('.back-loader');


    formEdit.on('submit', function (e) {
    if( formEdit.valid() ) {
        e.preventDefault();
        // var dataForm = formEdit.serialize(),
            url = formEdit.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                data: { _method: "PUT" },

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
                    createUserForm.resetForm();
                    $('.form-reset-edit').click();
                    $('.remove-img').click();
                    
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log("done");
                    
                    $('.widget-content:first').slideUp(600 , function () {
                        $('.widget-content:last').slideDown(1000);
                    });
                    $('.add-department').children().children('.widget-title').html('ADD DEPARTMENT');
                    oTable.ajax.reload();
                    console.log('finsh');
                    $('.form-create').show(100 ,function () {
                        $('.form-edit').addClass('d-none');
                    });

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

