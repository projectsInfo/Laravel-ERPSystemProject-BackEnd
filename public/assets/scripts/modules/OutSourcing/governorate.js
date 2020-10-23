$(document).ready(function () {

    const profileImgWrapper = $(".profile-img-wrapper");
    const profileImgIN = $(".profile-img-wrapper #profileImgIn");
    const imgPrev = $(".profile-img-wrapper .img-preview img");
    const rmImgBtn = $(".profile-img-wrapper .remove-img");
    const imgText = $(".profile-img-wrapper .img-overlay .img-name");
    const imgOverlay = $(".profile-img-wrapper .img-overlay");
    const generateBtn = $('#generatePass');
    const passIN = $('#password');
    const fileUpload = $('#fileUpload');
    const downloadFileBtn = $(".download-file");
    const uploadFileBtn = $(".upload-file");
    const uploadedFileName = $('#file');
    // console.log(trans,manage);
    
    var Edit = trans.Edit;
    /****  Create User Widget ****/

    /* Drag and drop image file */

    // get file url and put it in image src

    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                imgPrev.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);

            imgText.text(input.files[0].name);

            let pla = URL.createObjectURL(event.target.files[0]);
        }
    }



    profileImgIN.change(function () {

        if (this.files[0].type.includes("image")) {
            readURL(this);

            imgPrev.fadeIn(800);

            profileImgWrapper.on('mouseenter', function () {
                rmImgBtn.addClass("d-block");
                imgOverlay.addClass("d-flex");
            });

            profileImgWrapper.on('mouseleave', function () {
                rmImgBtn.removeClass("d-block");
                imgOverlay.removeClass("d-flex");
            });

        } else {
            // In case of image not selected
        }
    });

    // remove profile image when x button is clicked

    rmImgBtn.click(function () {
        // clear events 
        profileImgWrapper.off('mouseenter');
        profileImgWrapper.off('mouseleave');
        // hide the button
        rmImgBtn.removeClass("d-block");
        imgOverlay.removeClass("d-flex");
        imgPrev.fadeOut(500, function () {
            this.src = "";
        });
        profileImgIN.val('');
    });

    // generate random password with length parameter

    function randomPassword() {
        const name = $('#name').val().substr(0,3);
        const randnumber = Math.floor(Math.random() * 654984);
        const pass = name + randnumber;
        return pass;
    }

    generateBtn.on('click',function() {
        passIN.val(randomPassword());
    });
        // function show hidden password


    $("[name='name']").on('keypress keyup', function() {
        if ($(this).val() === '') {
            generateBtn.prop('disabled', true);
        } else {
            generateBtn.removeAttr("disabled");
        }
    });

    // function copy password form input password

    function copyToClipboard() {
        // Highlight its content
        passIN.select();
        // Copy the highlighted text
        document.execCommand("copy");
    
    }
    
    $('.copy-pass').on('click', function () {
        copyToClipboard();
    });


    // File cv 

    fileUpload.on('change', function () {

        uploadedFileName.val(this.files[0].name);
        $('#file-edit').val(this.files[0].name);
    });


    $('#fileUpload-edit').on('change', function () {

        // uploadedFileName.val(this.files[0].name);
        $('#file-edit').val(this.files[0].name);
        downloadFileBtn.removeClass('d-none');
        uploadFileBtn.addClass('d-none');
    });

    // 
    const closePopup = $('.exit-btn');
    const popup = $('.modal');
    const deleteTableRow = $('.delete-row');

    closePopup.click(function () {
        popup.modal('hide');
    });

    deleteTableRow.click(function () {
        popup.addClass('d-flex align-items-center');
    });

    popup.on('hidden.bs.modal', function () {
        popup.removeClass('d-flex');
    });

    /**** All Users Widget ****/

    // Search by filter


    var searchBtn = $(".search_btn");

    searchBtn.click(function () {
        console.log("mmm");
    });



    /*--------------
    *   Validation
    ---------------*/

    
    $('.general-form').validate({
        onkeyup: function(element) {$(element).valid()},
        rules: {
            name: {
                required: true,
            }
        },
        lang: 'ar' , 
        // validClass: "validation-valid-label ",
        // success: function(label) {
        //     label.addClass("validation-valid-label ").text(trans.success)
        // }, // or whatever language option you have.
        messages: {
            gender: {
                required: trans.SelectRiquired
            },
            departments: {
                required: trans.SelectRiquired
            },
        }
    });

    $('.form-edit').validate({
        onkeyup: function(element) {$(element).valid()},
        rules: {
            name: {
                required: true,
            }
         
        },
        lang: 'ar' , 
        // validClass: "validation-valid-label",
        // success: function(label) {
        //     label.addClass("validation-valid-label").text(trans.success)
        // }, // or whatever language option you have.
        messages: {
            gender: {
                required: trans.SelectRiquired
            },
            departments: {
                required: trans.SelectRiquired
            },
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
            
                    $('.form-reset').click();
                    $('.remove-img').click();
                    
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
                    $.each(error_array, function (key, val) {
                        errors_print += val[0] + '<br>';
                        $('#'+key).val('');
                        var geterror = $('#'+key+'-error');
                            geterror.html(val);
                            geterror.show();
                            geterror.removeClass('validation-valid-label');
                        // var errorspan = `<label id="mobile-error" class="error" for="mobile" style="">${val}</label>`
                        //     errorspan.insertAfter('#'+key).show();
                            

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
                $.ajax({
                url: CatId,
                dataType: "json",
                cache: false,
                data: { _method: "get" },
                type: "get",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(data) {
                    var img = window.location.origin+'/uploads/avatars/'+data.data.avatar;
                    $('.widget-content:last').slideUp(600 , function () {
                        $('.widget-content:first').slideDown(1000);
                    });
                    $('.form-create').hide(100 ,function () {
                        $('.form-edit').removeClass('d-none');
                        
                    });
                    var status = data.status;
                    if (status === true) {
                        var url = window.location.origin;
                        var urlaction = url+'/governorate/'+data.data.name;
                        
                        $('.form-edit').attr('action',urlaction);
                        $('#name-edit').val(data.data.name);
                        $('#governorate_id').val(data.data.id);
                        $('.create-users').children().children('.widget-title').html(Edit +' '+data.data.name);
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
                    $('.form-reset-edit').click();
                    $('.remove-img').click();
                    
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('.widget-content:first').slideUp(600 , function () {
                        $('.widget-content:last').slideDown(1000);
                    });
                    $('.create-users').children().children('.widget-title').html(manage.create_user);
                    oTable.ajax.reload();
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
                        errors_print += val[0] + '<br>';
                        $('#'+key+'-edit').val('');
                        // $('#'+key+'-edit').inster
                        $("#"+key+"-edit-error").remove();
                        $( "<label id='"+key+"-edit-error' class='error' for='"+key+"-edit' style=''>"+val+"</label>" ).insertAfter( '#'+key+'-edit' );
                        var geterror = $('#'+key+'-edit-error');
                        console.log(geterror);
                            geterror.html(val);
                            geterror.show();
                    });
                }
            };
            $.ajax(dataAjax);
        }
    });


    // // Click on cancel (reset) in form edit
    // $('.form-edit .reset-btn').click(function(){
    //     $(".widget-content:first").slideUp(600, function() {
    //         $(".widget-content:last").slideDown(1000);
    //     });
    //     $(".create-users")
    //         .children()
    //         .children(".widget-title")
    //         .html(manage.create_user);
    //     $(".form-create").show(100, function() {
    //         $(".form-edit").addClass("d-none");
    //     });
    // })
})

