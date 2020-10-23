$(document).ready(function() {

    /**************
    * Main Script *
    ***************/

    $('.show-product').on('click',function (e) {
        var barcode = $('#barcode').val();
        
        e.preventDefault();
        var $this = $(this),
        Url = $this.attr("Url");
        $.ajax({
            url: Url+'/'+barcode,
            dataType: "json",
            cache: false,
            /*contentType: false,
            processData: false,*/
            // data: { _method: "get" },
            // data:orderQuantity,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(data) {

                const isProductFound = data.status;
                const products = data.Product;
                
                if(isProductFound){

                    if(products.length === 1){

                        createSubProdRows(products[0]);
                        // Put rows in below table
                           
                        createSelectedRow(products[0]);

                    } else {
                        $('#moreProducts').modal('show');
                        $('#moreProducts #productsCont').html('');
                        products.forEach(function(product,index){
                            const productButton = ` 
                                <button type="button" class="btn general-btn ml-2">${product.name}</button>
                            `;

                            $(productButton).appendTo('#moreProducts #productsCont').click(function(){
                                $('#moreProducts').modal('hide');
                                createSubProdRows(products[index]);
                                createSelectedRow(products[index]);
                            });
                        })
                    }
                   
                } else {
                    alert("No Product Found");
                }
            },
            beforeSend: function () {
                console.log('test');
            },
        });
    });

    // Delete subproduct in show product modal and update quantity and price 
    $('#showProductModal form.sub-product').on('click','.delet', function (e) {

        $(this).parent().parent('tr').fadeOut(300 ,function(){
            $(this).remove();
            updateQuantity();
            updatePrice();
        });
    });

    // update quantity on key up 
    $('#showProductModal form.sub-product').on('keyup', $('input.qny') , updateQuantity);
    // update price on key up 
    $('#showProductModal form.sub-product').on('keyup', $('input.price') , updatePrice);


    // show current product button

    $('.show-current-product').click(function() {  
        $('#showProductModal').modal('show');
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















    /*----------
        validation
    -------------- */
    const allForms = $('.form-create');
console.log(allForms);
    allForms.validate({
        rules: {

            barcode: {
                required: true
            },

            orderQuantity: {
                required: true,
                number: true
            },
            suppliers: {
                required: true
            },
            warehouses: {
                required: true
            }           
        }
    });
}); 