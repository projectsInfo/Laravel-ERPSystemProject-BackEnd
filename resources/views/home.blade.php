@extends('layouts.app')

@section('content')
@endsection



@section('scripts')

<script>
// Swal.fire({
//   title: 'Submit your Github username',
//   input: 'text',
//   inputAttributes: {
//     autocapitalize: 'off'
//   },
//   showCancelButton: true,
//   confirmButtonText: 'Look up',
//   showLoaderOnConfirm: true,
//   preConfirm: (login) => {
//     return fetch(`//api.github.com/users/${login}`)
//       .then(response => {
//         if (!response.ok) {
//           throw new Error(response.statusText)
//         }
//         return response.json()
//       })
//       .catch(error => {
//         Swal.showValidationMessage(
//           `Request failed: ${error}`
//         )
//       })
//   },
//   allowOutsideClick: () => !Swal.isLoading()
// }).then((result) => {
//   if (result.value) {
//     Swal.fire({
//       title: `${result.value.login}'s avatar`,
//       imageUrl: result.value.avatar_url
//     })
//   }
// })


$(document).ready(function () {

    $('.widget-content:last').css('display', 'block');
    $('.widget-title').on('click', function () {
        $(this).next().slideDown();
        $('.widget-content').not($(this).next()).slideUp();
    });

     var createUserForm = $('form.form-create').validate({
        rules: {

            name: {
                required: true,
                minlength: "4"
            },

            address: {
                minlength: "4"
            },

            mobile: {
                number: true
            },

            gender: {
                required: true
            },

            departments: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,
            },
            confirmPassword: {
                required: true,
                equalTo: "#password"
            },
            profileImgIn: {
                accept: "image/jpeg, image/png"
            },
            fileUpload: {
                // extension: 'docx'

                // accept: "application/pdf, application/docx , image/jpeg, image/png"
            }

        },

        messages: {

            confirmPassword: {
                equalTo: "Confirm the entered password"
            },
            fileUpload: {
                accept: "Invalid file type"
            },
            profileImgIn: {
                accept: "Invalid file type"
            }
        }
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
                data: dataForm ,
                // data:new FormData(this),
                // processData: false,
                // contentType: false,

                cache: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    console.log(response);
                    
                    // backLoader.fadeOut(100,function() {
                    //     loader.fadeOut(1000);
                    // });
                    // var hasError = $('.has-error');
                    // hasError.removeClass('has-error');
                    // console.log(createUserForm);
                    // createUserForm.resetForm();
                    // $('.form-reset').click();
                    // $('.remove-img').click();
                    
                    // Swal.fire({
                    //     type: 'success',
                    //     title: 'Your work has been saved',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // })
                    
                },
                beforeSend: function () {
                    backLoader.fadeIn(100,function() {
                        loader.fadeIn(1000);
                    });
                },
                error: function (errors, exp) {
                    // backLoader.fadeOut(100,function() {
                    //     loader.fadeOut(1000);
                    // });
                    // Swal.fire({
                    // type: 'error',
                    // title: 'Oops...',
                    // text: 'Something went wrong!',
                    // })
                    // var error_array = errors.responseJSON.errors,
                    //     errors_print = '';
                    
                    // console.log(error_array);
                    // $.each(error_array, function (key, val) {
                    //     console.log(key);
                        
                    //     errors_print += val[0] + '<br>';
                
                    //     $('#'+key).val('');

                    //     var geterror = $('.'+key+'-error');
                        
                    //         geterror.html(val);
                    //         geterror.addClass('error');
                    //         geterror.slideDown(400);
                    //         geterror.parent().addClass('has-error');

                    // });
                }
            };
            $.ajax(dataAjax);
        }
    });

    
})

</script>
@endsection