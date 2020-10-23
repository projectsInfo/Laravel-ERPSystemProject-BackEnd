$(document).ready(function() {
    var array_ids_deleted_when_update = [];
    const createUserForm = $('form.general-form');
    const SelectDelivaryCity = $('.create-delivary-city-info').attr('data-select-delivary-city');

    const createDelivaryCityInfo = $('.create-delivary-city-info');
    $('.create-delivary-city').on('click', function() {
        createDelivaryCityInfo.append(SelectDelivaryCity);
        $('.city').select2();
    });
    createUserForm.on('click','.delete-delivary-city', function() {
        $(this).parent().parent().parent().parent().parent().remove();
        var id_delete = $(this).attr('id_delete');
        console.log(id_delete);
        if (id_delete != 0) {
            array_ids_deleted_when_update.push(id_delete);
            console.log(array_ids_deleted_when_update);
        }
    }) 

    function parseArabic() {
        var yas ="٠١٢٣٤٥٦٧٨٩";
        yas = (yas.replace(/[٠١٢٣٤٥٦٧٨٩]/g, function (d) {
            return d.charCodeAt(0) - 1632;                
            }).replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function (d) { return d.charCodeAt(0) - 1776; })
        );
    }


    $('#name').on('keypress keyup', function() {
        parseArabic();
    });
    $('.city').select2();

/*------------
    valiation
-------------- */
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
    }, "Don't leave space");
    jQuery.validator.addMethod("startZero", function(value) {
        return value.match(/^0+/); 
    }, "phone should start with zero");

    createUserForm.validate({
        rules: {
            name: {
                required: true,
                noSpace: true,
            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 15,
                startZero:true,
            },
            address: {
                required: true,
            },
            email: {
                required :true
            },
            "price[]" : {
                required: true,
            }
        },
        messages: {
            phone: {
                minlength: "enter at least 10 numbers",
                maxlength: "phone should less than 15 numbers",
            },
        },
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
                    console.log(createUserForm);
                    createUserForm.resetForm();
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
                    console.log(data);
                    // createStockmanInfo.empty();

                    $('.widget-content:last').slideUp(600 , function () {
                        $('.widget-content:first').slideDown(1000);
                    });
                    $('.form-create').hide(100 ,function () {
                        $('.form-edit').removeClass('d-none');
                        
                    });
                    var status = data.status;
                    if (status === true) {
                        console.log(data.data);
                        
                        var url = window.location.origin;
                        var urlaction = url+'/delivarycompany/'+data.data.Name;
                        $('.form-edit').attr('action',urlaction);
                        $('#name-edit').val(data.data.Name );
                        $('#phone-edit').val(data.data.Phone );
                        $('#email-edit').val(data.data.Email );
                        $('#address-edit').val(data.data.Address);
                        $("#price-edit").val(data.data.Derails[0].price);
                        $("#DelivaryCompanieDetailsId-edit").val(data.data.Derails[0].id);
                        
                        $('#city-edit').val(data.data.Derails[0].city_id); // Select the option with a value of '1'
                        $('#city-edit').trigger('change'); // Notify any JS components that the value changed
                        if(data.data.Derails.length > 1){
                            for (let i = 1; i < data.data.Derails.length; i++) {
                                var row = createDelivaryCityInfo.append(SelectDelivaryCity);
                                row.find('input[type="number"]').val(data.data.Derails[i].price);
                                row.find('.city').val(data.data.Derails[i].city_id).trigger('change');
                                // console.log();
                                row.find('input[name="DelivaryCompanieDetailsId[]"]').val(data.data.Derails[i].id);

                                row.find('[id_delete]').eq(1).attr('id_delete' , data.data.Derails[i].id);
                                // .val(data.data.Derails[i].city_id).trigger('change');
                                $('.city').select2();
                                // myObject["data-change-me"] = "someOtherValue";

                            }
                        }
                        $('.all-warehouse-places').children().children('.widget-title').html('edit' +' '+data.data.name);
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
    formEdit.on('submit', function (e) {        
    if( createUserForm.valid() ) {
        e.preventDefault();
        var dataForm = formEdit.serialize(),
            url = formEdit.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                data: dataForm + '&delete_ids=' + array_ids_deleted_when_update  ,
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
 });   
 
 