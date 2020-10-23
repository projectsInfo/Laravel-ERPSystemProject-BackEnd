const prevIds = [];

/***********************
 * Function Definitions *
 ************************/

function createSubProdRows(products) {
    const subProducts = products.sub_products;
    if (!($("#moreProducts").css('display') === 'none')){
        $("#moreProducts").on("hidden.bs.modal", function(e) {
            $("#showProductModal").modal("show");
        });
    } else {
        $("#showProductModal").modal("show");
    }
    updateProdTitle(products.name, products.style.name, products.material);

    $("#showProductModal tbody").html("");
    subProducts.forEach(function(subproduct) {
        var row = `<tr class="row-edit">
        <td data-label="ID" ><span>${subproduct.id}</span></td>
        <td data-label="Barcode"><span>${subproduct.parcode_pre_all}</span></td>
        <td data-label="Color">
            <div class="color-tag tag d-inline-flex">
                <span class="color-circle" style="background:${subproduct.color}" data-color-name="${subproduct.colorName}"></span>
                <span class="color-name ml-2">${subproduct.colorName}</span>
            </div>
        </td>
        <td data-label="Size"><span>${subproduct.size}</span></td>
        <td data-label="Quantity">
            <input type="number" name="quantity[]" placeholder="Enter Product Quantity" class="form-control w-auto d-inline-block qny">
        </td>
        <td data-label="Price"><span>${subproduct.selling_price}</span> EGP</td>
        <td data-label="Action" class="d-flex justify-content-center" >
            <button type="button" class="btn delet">
                <span><i class="fas fa-times fa-fw"></i></span>
            </button>
        </td>
        <input type="hidden" name="subproduct_id[]" value="${subproduct.id}">
        </tr>`;

        $("#showProductModal tbody").append(row);
    });
    updateModalPrice();
    updateModalQuantity();
}

function updateModalQuantity() {
    let totalQuantity = 0;

    $("#showProductModal input.qny").each(function() {
        if ($(this).val() !== "") {
            totalQuantity += parseInt($(this).val());
        }
    });
    $("#showProductModal span.total-quan").text(totalQuantity);
}

function updateOrderQuantity() {
    let totalQuantity = 0;
    $(".form-create td[data-label='Quantity'] span").each(function() {
        
        totalQuantity += parseInt($(this).text().replace(' EGP',''));
        
    });

    $(".form-create span.total-quan").text(totalQuantity);
}

function updateOrderPrice() {
    let totalPrice = 0;
    $(".form-create td[data-label='Price'] span").each(function() {
        let price = $(this).text().replace(' EGP','');
        let quantity = $(this).parent().siblings().children("td[data-label='Quantity'] span").text();
        totalPrice += price * quantity;
    });
    $(".form-create span.total-price").text(totalPrice);
}

function updateModalPrice() {
    let totalPrice = 0;
    $("#showProductModal td[data-label='Price'] span").each(function() {
        let price = $(this).text();
        let quantity = $(this).parent().siblings().children("input.qny").val();
        if(quantity !== ''){
            totalPrice += price * quantity;
        }
    });
    $("#showProductModal span.total-price").text(totalPrice);
}

function updateProdTitle(productName, productStyle, productMaterial) {
    $("#showProductModal h1.widget-title").text(productName);
    $("#showProductModal #productStyle").text(productStyle);
    $("#showProductModal #productMaterial").text(productMaterial);
}

function createSelectedRow(product) {
    $("#confirmProduct").click(function() {
        console.log('confirm clicked');
        $("#showProductModal").modal("hide");
        const subProducts = product.sub_products;
        const modalQuanIn = $(
            "#showProductModal .general-table tbody tr input.qny"
        );
        
        const modalPriceIn = $(
            "#showProductModal td[data-label='Price'] span"
        );
        
        subProducts.forEach(function(subProduct, i) {
            if (
                modalQuanIn[i].value !== "" &&
                !prevIds.includes(subProduct.id)
            ) {
                const modalQuanInVal = modalQuanIn[i].value;
                const modalPriceInVal = modalPriceIn[i].textContent;
                console.log(modalQuanInVal);
                
                const subprodRow = `
                <tr class="row-edit ">
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
                    <td data-label="Price"><span>${modalPriceInVal}</span> EGP</td>
                    <td data-label="Status"><span>Avilable</span></td>
                    <td data-label="Action">
                        <button type="button" class="btn delet">
                            <span><i class="fas fa-times fa-fw"></i></span>
                        </button>
                    </td>
                    <input type="hidden" name="quantity[]" class="qny" value="${modalQuanInVal}">
                    <input type="hidden" name="subproduct_id[]" value="${subProduct.id}">
                </tr>
            `;

                prevIds.push(subProduct.id);
                // Delete row from model after adding it to products table
                //modalQuanIn[i].parentElement.parentElement.remove();

                $("#productTable tbody").append(subprodRow);
            }
            
        });
        console.log('row created');
        updateOrderQuantity();
        updateOrderPrice();

        $('.form-create .delet').click(function(){
            $(this).parents('tr').remove();
            updateOrderPrice();
            updateOrderQuantity();
            // remove id from idArrays
            const deletedRowId = $(this).parent().siblings('td[data-label="ID"]').children().text();
            prevIds.pop(deletedRowId);
            
        });
    });
}

// Use Enter Key Event

$("#showProductModal")
    .siblings()
    .on("keyup keypress", function(event) {
        const keyCode = event.keyCode || event.which;
        if (keyCode == 13) {
            event.preventDefault();
            $(".show-product").click();
            return false;
        }
    });

$("#showProductModal form").on("keyup keypress", function(event) {
    const keyCode = event.keyCode || event.which;
    if (keyCode == 13) {
        event.preventDefault();
        $("#confirmProduct").click();
        return false;
    }
});
