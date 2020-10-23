$(document).ready(function() {

    let productData = {};

    

    /***********************
    * Function Definitions *
    ************************/

    function createSubProdRows(products){

        const subProducts = products.sub_products;
        setTimeout(() => {
            $('#showProductModal').modal('show');
        }, 500);
        updateProdTitle(products.name, products.style.name, products.material);
        
        $('#showProductModal tbody').html('');
        subProducts.forEach(function(subproduct){
            var row =  `<tr class="row-edit">
            <td data-label="ID" ><span>${subproduct.id}</span></td>
            <td data-label="Barcode"><span>${subproduct.parcode_pre_all}</span></td>
            <td data-label="Color"><span>${subproduct.color}</span></td>
            <td data-label="Size"><span>${subproduct.size}</span></td>
            <td data-label="Quantity">
                <input type="number" name="quantity[]" placeholder="Enter Product Quantity" class="form-control w-auto d-inline-block qny">
            </td>
            <td data-label="Price">
                <input type="number" name="price[]" placeholder="Enter Product Price" class="form-control w-auto d-inline-block price">
            </td>
            <td data-label="Action" class="d-flex justify-content-center" >
                <button type="button" class="btn delet">
                    <span><i class="fas fa-times fa-fw"></i></span>
                </button>
            </td>
            <input type="hidden" name="subproduct_id[]" value="${subproduct.id}">
            </tr>`;

            $('#showProductModal tbody').append(row);
        })
    }

    function updateQuantity(){

        let totalQuantity = 0;
        
        $('#showProductModal input.qny').each(function(){
            if($(this).val() !== ''){
                totalQuantity += parseInt($(this).val());
            }
        });
        $('span.totalQuan').text(totalQuantity);

         totalQuantity = 0;
        $('.form-create input.qny').each(function(){
            if($(this).val() !== ''){
                totalQuantity += parseInt($(this).val());
            }
        });
        $('span#totalQuan').text(totalQuantity);

    }

    function updatePrice(){

        let totalPrice = 0;
        $('#showProductModal input.price').each(function(){
            if($(this).val() !== ''){
                totalPrice += parseInt($(this).val());
            }
        });
        $('span.totalPrice').text(totalPrice);

        totalPrice = 0;
        $('.form-create input.price').each(function(){
            if($(this).val() !== ''){
                totalPrice += parseInt($(this).val());
            }
        });

        $('span#totalPrice').text(totalPrice);
    }

    function updateProdTitle(productName, productStyle, productMaterial){
        $('#showProductModal h1.widget-title').text(productName);
        $('#showProductModal #productStyle').text(productStyle);
        $('#showProductModal #productMaterial').text(productMaterial);
    }

    // // Use Enter Key Event
    // $('textarea').bind("enterKey",function(e){
    //     //do stuff here
    // });
    // // Create Enter Key Event
    // $('textarea').keyup(function(e){
    //     if(e.keyCode == 13)
    //     {
    //         $(this).trigger("enterKey");
    //     }
    // });

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

                productData = data;
                const isProductFound = productData.status;
                const products = productData.Product;
                
                if(isProductFound){

                    if(products.length === 1){

                        createSubProdRows(products[0]);

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

    // Delete subproduct in show product modal 
    $('#showProductModal form.sub-product').on('click','.delet', function (e) {

        $(this).parent().parent('tr').fadeOut(300 ,function(){
            $(this).remove();
            updateQuantity();
            updatePrice();
        });


    });


    $('#showProductModal form.sub-product').on('keyup', $('input.qny') , updateQuantity);

    $('#showProductModal form.sub-product').on('keyup', $('input.price') , updatePrice);

    


    // show current product button

    $('.show-current-product').click(function() {  
        $('#showProductModal').modal('show');
    });

    // Put rows in below tabel
    // const prevIds = prevIds;
    $('#confirmProduct').click(function(){
        
        $('#showProductModal').modal('hide');
        const products = productData.Product[0];
        const subProducts = productData.Product[0].sub_products;

        const modalQuanIn = $('#showProductModal .general-table tbody tr input.qny');
        const modalPriceIn = $('#showProductModal .general-table tbody tr input.price');
        
        subProducts.forEach(function(subProduct,i){

            if(modalQuanIn[i].value !== '' && modalPriceIn[i].value !== '' && !prevIds.includes(subProduct.id)){
            
                const modalQuanInVal = modalQuanIn[i].value;
                const modalPriceInVal = modalPriceIn[i].value;
            
                const subprodRow = `
                    <tr class="row-edit ">
                        <td data-label="ID"><span>${subProduct.id}</span></td>
                        <td data-label="Barcode"><span>${subProduct.parcode_pre_all}</span></td>
                        <td data-label="Name"><span>${products.name}</span></td>
                        <td data-label="Material"><span>${products.material}</span></td>
                        <td data-label="Style"><span>${products.style.name}</span></td>
                        <td data-label="Size"><span>${subProduct.size}</span></td>
                        <td data-label="Colors">
                            <span style="background: ${subProduct.color}"></span>
                        </td>
                        <td data-label="Quantity"><span>${modalQuanInVal}</span></td>
                                
                        <td data-label="Price"><span>${modalPriceInVal} EGP</span></td>
                        <td data-label="Status"><span>Avilable</span></td>
                        <td data-label="Action">
                            <button type="button" class="btn delet">
                                <span><i class="fas fa-times fa-fw"></i></span>
                            </button>
                        </td>
                        <input type="hidden" name="price[]" class="price" value="${modalPriceInVal}">
                        <input type="hidden" name="quantity[]" class="qny" value="${modalQuanInVal}">
                        <input type="hidden" name="subproduct_id[]" value="${subProduct.id}">
                        <input type="hidden" name="SupplyOrderData_id[]" value="0">
                    </tr>
                `;

                prevIds.push(subProduct.id);
                // Delete row from model after adding it to products tabele
                //modalQuanIn[i].parentElement.parentElement.remove();
                
                $('.suppliers-order .general-table tbody').append(subprodRow);
            }
            updateQuantity();
            updatePrice();
        });
    })
    





    $('.select-supplier-order').on('change', function() {
        var selectSupplierDropdown = $('.select-supplier-order option:selected').val();
        if (selectSupplierDropdown == 1) {
            $('.input-search').attr('placeholder', 'Search By Order Id');
            $('.supplier-dropdown').addClass('d-none');
            $('.supplier-search').removeClass('d-none');
        } else if (selectSupplierDropdown == 2) {
            $('.input-search').attr('placeholder', 'Search By Supplier Name');
            $('.supplier-dropdown').addClass('d-none');
            $('.supplier-search').removeClass('d-none');
        } else if (selectSupplierDropdown == 3) {
            $('.input-search').attr('placeholder', 'Search By Order Date');
            $('.supplier-dropdown').addClass('d-none');
            $('.supplier-search').removeClass('d-none');
        } else if (selectSupplierDropdown == 4) {
            $('.input-search').attr('placeholder', 'Status');
            $('.supplier-dropdown').removeClass('d-none');
            $('.supplier-search').addClass('d-none');
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















    /*----------
        validation
    -------------- */
    const allForms = $('form');

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
        },
        validClass: 'validation-succeeded',
        success: function(label){
            label.addClass('validation-succeeded').text('Validation succeeded');
        }
    });
}); 