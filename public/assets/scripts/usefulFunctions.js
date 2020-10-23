
const prevIds = [];

/***********************
* Function Definitions *
************************/

function createSubProdRows(products){

    const subProducts = products.sub_products;
    if (!($("#moreProducts").css("display") === "none")) {
        $("#moreProducts").on("hidden.bs.modal", function(e) {
            $("#showProductModal").modal("show");
        });
    } else {
        $("#showProductModal").modal("show");
    }
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

    // let totalQuantity = 0;

    // $('input.qny').each(function(){

    //     if($(this).val() !== ''){
    //         totalQuantity += parseInt($(this).val());
    //     }
    // });

    // $('span#totalQuan').text(totalQuantity);
}

function updatePrice(){
    
    let totalPrice = 0;
    $('#showProductModal input.price').each(function(){
        if($(this).val() !== ''){
            totalPrice += parseInt($(this).val() * $(this).parent().siblings().children('input.qny').val());
        }
    });

    $('span.totalPrice').text(totalPrice);

    totalPrice = 0;
    $('.form-create input.price').each(function(){
        if($(this).val() !== ''){
            // console.log($(this).val() , $(this).siblings('input.qny').val());
            
            totalPrice += parseInt($(this).val() * $(this).siblings('input.qny').val());
        }
    });

    $('span#totalPrice').text(totalPrice);

    // let totalPrice = 0;

    // $('input.price').each(function(){

    //     if($(this).val() !== ''){
    //         totalPrice += parseInt($(this).val());
    //     }
    // });

    // $('span#totalPrice').text(totalPrice);
}

function updateProdTitle(productName, productStyle, productMaterial){
    $('#showProductModal h1.widget-title').text(productName);
    $('#showProductModal #productStyle').text(productStyle);
    $('#showProductModal #productMaterial').text(productMaterial);
}

function createSelectedRow(product) {
  $("#confirmProduct").click(function() {
    $("#showProductModal").modal("hide");
    const subProducts = product.sub_products;
    const modalQuanIn = $("#showProductModal .general-table tbody tr input.qny");
    const modalPriceIn = $("#showProductModal .general-table tbody tr input.price");

    subProducts.forEach(function(subProduct, i) {
      if (
        modalQuanIn[i].value !== "" &&
        modalPriceIn[i].value !== "" &&
        !prevIds.includes(subProduct.id)
      ) {
            console.log(modalPriceIn[i].value);
            const modalQuanInVal = modalQuanIn[i].value;
            const modalPriceInVal = modalPriceIn[i].value;

            const subprodRow = `
                <tr class="row-edit">
                    <td data-label="ID"><span>${subProduct.id}</span></td>
                    <td data-label="Barcode"><span>${subProduct.parcode_pre_all}</span></td>
                    <td data-label="Name"><span>${product.name}</span></td>
                    <td data-label="Material"><span>${product.material}</span></td>
                    <td data-label="Style"><span>${product.style.name}</span></td>
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
                </tr>
            `;

            prevIds.push(subProduct.id);
            // Delete row from model after adding it to products table
            //modalQuanIn[i].parentElement.parentElement.remove();
            
            $("#productTable tbody").append(subprodRow);
        }
        updateQuantity();
        updatePrice();
    });
  });
}


// Use Enter Key Event
    
$("#showProductModal").siblings().on('keyup keypress',function(event){
    
    const keyCode = event.keyCode || event.which;
    if(keyCode == 13){
        event.preventDefault();
        $('.show-product').click();
        return false;
    }
});

$('#showProductModal form').on('keyup keypress',function(event){
    
    const keyCode = event.keyCode || event.which;
    if(keyCode == 13){
        event.preventDefault();
        $('#confirmProduct').click();
        return false;
    }
});