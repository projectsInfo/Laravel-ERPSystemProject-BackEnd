function showRow(span) {
   const tableBodyRows = $("#showProductModal tbody tr");
   let inputVal = $("#showProductModal .input-search").val();
   
   tableBodyRows.each(function(i,elem) {
       const reqSpan = $(elem).find(span);
       const spanVal = reqSpan.text().toLowerCase();
       
       if (spanVal.includes(inputVal.toLowerCase())) {
           console.log(spanVal);
           console.log(inputVal);
           $(this).show();
       }
   }); 
}

let filterModalBy = $("#showProductModal .filter").val();

$("#showProductModal .filter").on("change", function() {
    filterModalBy = $(this).val();
    let inputVal = $("#showProductModal .input-search").val();
    if (inputVal !== "") {
        $("#showProductModal tbody tr").hide();
        searchInRows(inputVal, filterModalBy);
    }
});


$("#showProductModal .input-search").on("keyup paste", function() {
    let inputVal = $(this).val();
    if (inputVal !== "") {
        $("#showProductModal tbody tr").hide();
        searchInRows(inputVal, filterModalBy);
    }
});

function searchInRows(inputVal, filterBy) {
    
    if (inputVal !== "") {
        if (filterBy === "Barcode") {
            showRow(`td[data-label="Barcode"] span`);
            
        } else if (filterBy === "Color") {
            showRow(`td[data-label="Color"] span.color-name`);
            
        } else if (filterBy === "Size") {
            showRow(`td[data-label="Size"] span`);
        }
    }
}
