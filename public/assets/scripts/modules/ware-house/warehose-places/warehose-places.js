$(document).ready(function() {
  // create stock man
  
  const SelectStockman = $('.create-stockman-info').attr('data-select-stockman');

  const createStockmanInfo = $('.create-stockman-info');
    $('.create-stockman').on('click', function() {
    createStockmanInfo.append(SelectStockman);
    // $('select').addClass('form-control');
    createStockmanInfo.find('select').focus();
    });

    createStockmanInfo.on('click','.delete-stockman', function() {
        $(this).parent().parent().remove();
    });


    /*------------
    valiation
  -------------- */
    const createUserForm = $('.form-create');
    console.log(createUserForm);

    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
    }, "Don't leave space");

    createUserForm.validate({
        rules: {
            name: {
                required: true,
                noSpace: true,
            },
            address: {
                required: true
            },
            "stockman[]": {
                number: true,
                required:true,
            }
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
                    $('.btn-reset').click();
                    createStockmanInfo.empty();
                    oTable.ajax.reload();
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
                    createStockmanInfo.empty();

                    $('.widget-content:last').slideUp(600 , function () {
                        $('.widget-content:first').slideDown(1000);
                    });
                    $('.form-create').hide(100 ,function () {
                        $('.form-edit').removeClass('d-none');
                        
                    });
                    var status = data.status;
                    if (status === true) {
                        var url = window.location.origin;
                        var urlaction = url+'/warehouse/'+data.data.name;
                        $('.form-edit').attr('action',urlaction);
                        $('#name-edit').val(data.data.name);
                        $('#warehouse_name').val(data.data.name);
                        $('#warehouse_id').val(data.data.id);
                        $('#address-edit').val(data.data.Address);
                        $("#stockman-edit").val(data.data.Users[0].id);
                        console.log(data.data.Users.length);
                        
                        if(data.data.Users.length > 1){
                            for (let i = 1; i < data.data.Users.length; i++) {
                                // createStockmanInfo.append();
                                $(SelectStockman).appendTo(createStockmanInfo).children('select').val(data.data.Users[i].id);
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
                    // editUserForm.resetForm();
                    $('.exit-btn').click();
                    oTable.ajax.reload();

                    // $('.remove-img').click();
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
                        var geterror = $('#'+key+'-edit-error');
                        console.log(geterror);
                        
                            geterror.html(val);
                            geterror.removeClass('validation-valid-label');
                    });
                }
            };
            $.ajax(dataAjax);
        }
    });

      /*-----------------
  *   delite Btn
  ------------------*/
  $(document).on('click','.delBtns', function (e) {
      
      var $this = $(this),
      DelUrl = $this.attr("del-url"),
      
      DelName = $this.attr("del-name"),
      title = "تـم الحذف",
      message = "تم الحذف بنجاح";
      console.log(DelUrl);

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