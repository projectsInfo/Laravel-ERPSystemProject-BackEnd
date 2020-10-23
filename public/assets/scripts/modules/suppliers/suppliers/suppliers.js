$(document).ready(function() {
    let form = $('.general-form');
    var array_ids_deleted_when_update = {
        address: [],
        mobile: [],
        email : []
    };

    // start Add Supplier Phone Function

    var addSupplierPhoneBtn = $('.add-supplier-phone');
    var addSupplierPhoneInfo = $('.add-supplier-phone-info');
    var AddSupplierPhoneCounter = 0;

    addSupplierPhoneBtn.on('click', function() {
        AddSupplierPhoneCounter++;
        if (AddSupplierPhoneCounter >= 5) {
            AddSupplierPhoneCounter--;
        } else if (AddSupplierPhoneCounter < 5) {
                input = "<div class='row'><div class='col-9'><input type='hidden' name='mobileId[]' value='0'><input type='text' name='mobile[]' class='form-control mt-2' placeholder='Supplier Phone'></div><div class='col-3'><span class='general-btn danger text-center mt-2 d-inline-block'><i class='fas fa-times'></i></span></div></div>";
            addSupplierPhoneInfo.append(input);
        }
    });

    form.on('click', '.add-supplier-phone-info span', function () {
        $(this).parent().parent().remove();
        AddSupplierPhoneCounter--;
        var mobile = $(this).attr('id_delete');
            if (mobile != 0) {
                array_ids_deleted_when_update.mobile.push(mobile);
                console.log(array_ids_deleted_when_update.mobile);
            }
    });



    

    // addSupplierPhoneBtn.on('click', function() {
    //     var childDivCount = addSupplierPhoneInfo.find('div').length;
    //     if (childDivCount < 4) {
    //         let input = "<div><input type='text' name='mobile[]' class='form-control mt-2' placeholder='Supplier Phone'><span class='general-btn'><i class='fas fa-times'></i></span></div>";
    //         if(form.hasClass('form-edit')){
    //              input = `<div><input type="hidden" name="mobileId[]" value="0"><input type='text' value="" name='mobile[]' class='form-control mt-2 supplier-phone' placeholder='Supplier Phone'><span id_delete='0' class='general-btn'><i class='fas fa-times'></i></span></div>`;
    //         }
    //         addSupplierPhoneInfo.append(input);
    //     }
    // });
    // form.on('click', '.add-supplier-phone-info span', function () {
    //     $(this).parent().remove();
    //     var mobile = $(this).attr('id_delete');
    //         if (mobile != 0) {
    //             array_ids_deleted_when_update.mobile.push(mobile);
    //             console.log(array_ids_deleted_when_update.mobile);
    //         }
    // });

    // start Add Supplier email Function
    var addSupplierEmailBtn = $('.add-supplier-email');
    var addSupplierEmailInfo = $('.add-supplier-email-info');
    var AddSupplierEmailCounter = 0;
    addSupplierEmailBtn.on('click', function() {
        AddSupplierEmailCounter++;
        if (AddSupplierEmailCounter >= 5) {
            AddSupplierEmailCounter--;
        } else if (AddSupplierEmailCounter < 5) {
            let input = "<div class='row'><div class='col-9'><input type='hidden' name='emailId[]' value='0'><input type='text' name='email[]' class='form-control mt-2' placeholder='Supplier Email'></div><div class='col-3'><span class='danger d-inline-block mt-2 general-btn'><i class='fas fa-times'></i></span></div></div>";
        addSupplierEmailInfo.append(input);
        }
    });

    form.on('click', '.add-supplier-email-info span', function () {
        $(this).parent().remove();
        AddSupplierEmailCounter--;
        var email = $(this).attr('id_delete');
            if (email != 0) {
                array_ids_deleted_when_update.email.push(email);
                console.log(array_ids_deleted_when_update.email);
            }
    });

    // start Add Supplier address Function


   
    



    const addSupplierAddressBtn = $('.add-supplier-address');
    const addSupplierAddressInfo = $('.add-supplier-address-info');
    var AddSupplierAddressCounter = 0;


    addSupplierAddressBtn.on('click', function() {
        AddSupplierAddressCounter++;
        if (AddSupplierAddressCounter >= 5) {
            AddSupplierAddressCounter--;
        } else if (AddSupplierAddressCounter < 5) {
            let input = "<div class='row'><div class='col-9'><input type='hidden' name='addressId[]' value='0'><textarea name='address[]' class='form-control textAreaHeight mt-2' placeholder='Supplier Address'></textarea></div><div class='col-3'><span class='general-btn mt-2 danger d-inline-block'><i class='fas fa-times'></i></span></div></div>";
            addSupplierAddressInfo.append(input);
        }
    });

    form.on('click', '.add-supplier-address-info span', function () {
        $(this).parent().parent().remove();
        AddSupplierAddressCounter--;
        var address = $(this).attr('id_delete');
        if (address != 0) {
            array_ids_deleted_when_update.address.push(address);
            console.log(array_ids_deleted_when_update.address);
        }
    });


    // reset all things

    $('.btn-reset').on('click', function() {
        addSupplierPhoneInfo.empty();
        addSupplierEmailInfo.empty();
        addSupplierAddressInfo.empty();
    });
    /*----------------------
        valdation
    -------------------*/

    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
    }, "Don't leave space");

    jQuery.validator.addMethod("startZero", function(value) {
        return value.match(/^0+/); 
    }, "phone should start with zero");

    var createUserForm = $('form.general-form').validate({
        rules: {
            name: {
                required: true,
                noSpace: true,
            },
            "mobile[]": {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 15,
                startZero:true,
            },
            "email[]": {
                email: true,
                required:true,
            },
        },
        messages: {
            "mobile[]": {
                minlength: "enter at least 10 numbers",
                maxlength: "phone should less than 15 numbers",
            },
        },
    });


/*-----------------
    *   Add Btn
    ------------------*/


    var formCreate = $('.form-create');
    var loader = $('.spinner');
    var backLoader = $('.back-loader');


    formCreate.on('submit', function (e) {
    if( createUserForm.valid() ) {
        e.preventDefault();
        var dataForm = formCreate.serialize(),
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
                    // createUserForm.resetForm();
                    $('.btn-reset').click();
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    oTable.ajax.reload();
                    addSupplierPhoneInfo.empty();
                    addSupplierEmailInfo.empty();
                    addSupplierAddressInfo.empty();
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
    *   edit  Btn
    ------------------*/

    $(document).on('click','.edit-Btn', function (e) {

        console.log("adite");
        
        e.preventDefault();
        var $this = $(this),
        editUrl = $this.attr("edit-url");
                $.ajax({
                url: editUrl,
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
                    addSupplierEmailInfo.empty();
                    addSupplierPhoneInfo.empty();
                    addSupplierAddressInfo.empty();
                    $('.widget-content:last').slideUp(600 , function () {
                        $('.widget-content:first').slideDown(1000);
                    });
                    $('.form-create').hide(100 ,function () {
                        $('.form-edit').removeClass('d-none');
                    });
                    var status = data.status;
                    if (status === true) {
                        var url = window.location.origin;
                        var urlaction = url+'/suppler/'+data.Suppler.name;
                        $('.form-edit').attr('action',urlaction);
                        var supplierName = $('#supplier_name');
                        var supplierId = $('#supplier_id');
                        var nameIn = $('#name_edit');
                        var phoneIns = $('#phone_edit');
                        var emailIns = $('#email_edit');
                        var addressIns = $('#address_edit');
                        

                        var phoneInsId = $('#phone_edit_id');
                        var emailInsId = $('#email_edit_id');
                        var addressInsId = $('#address_edit_id');

                        var nameCell = data.Suppler.name;
                        var idCell = data.Suppler.id;

                        console.log(data.Suppler);
                        
                        var phoneCell = data.Suppler.Mobiles[0].mobile;
                        var emailCell = data.Suppler.Emails[0].email;
                        var addressCell = data.Suppler.Address[0].address;

                        var phoneCellId = data.Suppler.Mobiles[0].id;
                        var emailCellId = data.Suppler.Emails[0].id;
                        var addressCellId = data.Suppler.Address[0].id;
                        
                        nameIn.val(nameCell);
                        
                        phoneInsId.val(phoneCellId)
                        emailInsId.val(emailCellId)
                        addressInsId.val(addressCellId)

                        supplierName.val(nameCell);
                        supplierId.val(idCell);
                        phoneIns.val(phoneCell);
                        emailIns.val(emailCell);
                        addressIns.val(addressCell);
                        for(var i = 1; i < data.Suppler.Mobiles.length; i++){
                            var input = `<div class='row'><div class='col-9'><input type="hidden" name="mobileId[]" value="${data.Suppler.Mobiles[i].id}"><input type='text' value="${data.Suppler.Mobiles[i].mobile}" name='mobile[]' class='form-control mt-2 supplier-phone' placeholder='Supplier Phone'></div><div class='col-3'><span id_delete='${data.Suppler.Mobiles[i].id}'class='d-block mt-2 general-btn'><i class='fas fa-times'></i></span></div></div>`;
                            addSupplierPhoneInfo.append(input);
                        }
                        for(var i = 1; i < data.Suppler.Emails.length; i++){
                            var input = `<div class='row'><div class='col-9'><input type="hidden" name="emailId[]" value="${data.Suppler.Emails[i].id}"><input type='text' value="${data.Suppler.Emails[i].email}"  name='email[]' class='form-control mt-2' placeholder='Supplier Email'></div><div class='col-3'><span id_delete='${data.Suppler.Emails[i].id}' class='d-block mt-2 general-btn'><i class='fas fa-times'></i></span</div></div>`;
                            addSupplierEmailInfo.append(input);
                        }
                        for(var i = 1; i < data.Suppler.Address.length; i++){
                            var input = `<div class='row'><div class='col-9'><input type="hidden" name="addressId[]" value="${data.Suppler.Address[i].id}"><textarea name='address[]'   class='form-control mt-2' placeholder='Supplier Address'>${data.Suppler.Address[i].address}</textarea></div><div class='col-3'><span id_delete='${data.Suppler.Address[i].id}' class='d-block mt-2 general-btn'><i class='fas fa-times'></i></span></div></div>`;
                            addSupplierAddressInfo.append(input);
                        }
                        $('.add-supplier').children().children('.widget-title').html('Edit '+data.Suppler.name);
                    }else if(status === false) {
                        Swal.fire({
                            title: data.message,
                            text: message,
                            type: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                },
                beforeSend: function () {
                    console.log('test');
                },
            });
        });





    var formEdit = $('.form-edit');
    formEdit.on('submit', function (e) {        
    if( createUserForm.valid() ) {
        e.preventDefault();
        var dataForm = formEdit.serialize(),
            url = formEdit.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                data: dataForm + '&delete_ids[address]=' + array_ids_deleted_when_update.address + '&delete_ids[mobile]=' + array_ids_deleted_when_update.mobile  + '&delete_ids[email]=' + array_ids_deleted_when_update.email ,
                processData: false,
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
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    oTable.ajax.reload();
                    addSupplierPhoneInfo.empty();
                    addSupplierEmailInfo.empty();
                    addSupplierAddressInfo.empty();
                    $('.widget-content:first').slideUp(600 , function () {
                        $('.widget-content:last').slideDown(1000);
                    });
                    $('.form-create').show(100 ,function () {
                        $('.form-edit').addClass('d-none');
                    });
                    oTable.ajax.reload();
                    $('.add-supplier').children().children('.widget-title').html('add supplier');
                   


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
                        console.log('test');
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
                        console.log('test');
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
});