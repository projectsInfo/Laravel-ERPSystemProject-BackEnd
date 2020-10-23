$(document).ready(function() {
    // const variables of btns
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
    }, "Don't leave space");

    jQuery.validator.addMethod("startZero", function(value) {
        return value.match(/^0+/); 
    }, "phone should start with zero");

   // const variables of btns
    var formClient = $('.form-client');
    var formClientValid = $(".form-client ").validate({
        onkeyup: function(element) {$(element).valid()},
        rules: {
            name: {
                required: true,
                minlength: 4,
                noSpace: true
            },
            "address[]": {
                required: true
            },
            "mobile[]": {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 15,
                startZero:true,
            },
            facebook_account: {
                required: true,
                facebook: true
            },
            Whats: {
                required: true,
                number: true
            }
        },
        messages: {
            "mobile[]": {
                minlength: "enter at least 10 numbers",
                maxlength: "phone should less than 15 numbers",
            },
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("صحيح .");
        }
    });


    // var form = $('.form-create');
    var loader = $('.spinner');
    var backLoader = $('.back-loader');


    formClient.on('submit', function (e) {
    if( formClientValid.valid() ) {
        e.preventDefault();
        var dataForm = formClient.serialize(),
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

                    Clients = response.Client;
                    var hasError = $('.has-error');
                    hasError.removeClass('has-error');
                    // $(".general-form")[0].reset();
                    // formCreate.resetForm();
                    addClientAddressInfo.empty();
                    addClientPhoneInfo.empty();
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


    console.log(Clients);
    let enSearch = false;
    const searchInput = $("#pills-tabContent .input-search");
    
    let searchIn;
    let filterBy;
    function createClientRow(client) {
        const clientRow = `
            <tr class="row-edit">
                <td data-label="ID"><span>${client.id}</span></td>
                <td data-label="Client Name"><span>${client.name}</span></td>
                <td data-label="Client Phone(s)"><span>${client.mobiles.map(
                    function(mob) {
                        return mob.mobile + " ";
                    }
                )}</span></td>
                <td data-label="Client Address(s)">
                    ${client.address.map(function(add) {
                        const addressRow = `
                            <div>
                                <label for="address-${add.id}">${add.address}</label>
                                <input id="address-${add.id}" name="address" value="${add.id}" class="d-none" type="radio">
                                <label class="radio-style"></label>
                            </div>
                        `;
                        return addressRow;
                    })}
                </td>
                <td data-label="Contact Way">
                    <div><a class="text-primary" ${client.facebook_account ? "href=" + client.facebook_account: null}">${client.facebook_account ? client.facebook_account: "No Facebook Account Added"}</a></div>
                    <div>${client.whats ? client.whats: "No Whatsapp Account Found"}</div>
                </td>
                <td data-label="Action">
                    <span>
                        <input type="radio" name="client" value="${client.id}">
                    </span>
                </td>
            </tr>
        `;

        $("#prevClients tbody").append(clientRow);
        $(`td[data-label="Client Address(s)"] label`).click(function(){
            $(`td[data-label="Client Address(s)"] label`).removeClass("selected");
            $(this).addClass("selected");
        });

        $(".prev-clients tr").click(function(){
            $(".prev-clients tr").removeClass("selected");
            $(".prev-clients tr").find("td input[type='radio']").prop('checked', false);
            console.log($(".prev-clients tr").find("td[data-label='Action'] input[type='radio']"));
            
            $(this).addClass("selected");
            $(this).find("td[data-label='Action'] input[type='radio']").prop('checked', true);
        });
    }

    $("#pills-tabContent .filter").on("change", function() {
        filterBy = $(this).val();
        let inputVal = searchInput.val();
        $("#prevClients tbody").html("");
        if (inputVal !== "") {
            searchInClients(inputVal, filterBy);
        }
    });

    filterBy = $("#pills-tabContent .filter").val();
    let inputVal = searchInput.val();
    $("#prevClients tbody").html("");
    if (inputVal !== "") {
        searchInClients(inputVal, filterBy);
    }

    searchInput.on("keyup", function() {
        let inputVal = searchInput.val();
        $("#prevClients tbody").html("");
        if (inputVal !== "") {
            searchInClients(inputVal, filterBy);
        }
    });


    function searchInClients(inputVal, filterBy) {
        
        if (inputVal !== "") {
            if (filterBy === "Client Name") {
                Clients.forEach(function(client) {
                    if (client.name.toLowerCase().includes(inputVal)) {
                        createClientRow(client);
                    }
                });
            } else if (filterBy === "Client Phone(s)") {
                Clients.forEach(function(client) {
                    client.mobiles.forEach(function(mobile) {
                        if (mobile.mobile.includes(inputVal)) {
                            createClientRow(client);
                        }
                    });
                });
            }
        }
    }

    // Show Date picker in any status except normal
    
    $(".status-dropdown").on("change", function() {
        const optionCustomSelect = $(this).val();
        const inputDate = $(".input-due-date");
        optionCustomSelect !== "Normal"
            ? inputDate.removeClass("d-none")
            : inputDate.addClass("d-none");
    });

    $(".social #facebook").click(function() {
        if ($(this).is(":checked")) {
            $("#facebook-account").attr("disabled", false);
        } else {
            $("#facebook-account").attr("disabled", true);
        }
    });
    $(".social #whatsapp").click(function() {
        if ($(this).is(":checked")) {
            $("#whatsapp-account").attr("disabled", false);
        } else {
            $("#whatsapp-account").attr("disabled", true);
        }
    });



    
 
    /*----------------
     *   Validation
     *-----------------*/
    // var formCreate = $('.form-create');

    var formvalid = $(".client_order ").validate({
        rules: {
            city: {
                required: true
            },

            address: {
                required: true
            },

            phone: {
                required: true
            },

            tel: {
                required: true
            }
        }
    });

    $("#prevClients form.general-form").validate({
        rules: {
            client: {
                required: true
            }
        }
    });

    $(".show-product").on("click", function(e) {
        var barcode = $("#barcode").val();

        e.preventDefault();
        var $this = $(this),
            Url = $this.attr("Url");
        $.ajax({
            url: Url + "/" + barcode,
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
                console.log(data);
                
                if (isProductFound) {
                    if (products.length === 1) {
                        createSubProdRows(products[0]);
                        // Put rows in below table

                        createSelectedRow(products[0]);
                    } else {
                        $("#moreProducts").modal("show");
                        $("#moreProducts #productsCont").html("");
                        products.forEach(function(product, index) {
                            const productButton = ` 
                            <button type="button" class="btn general-btn ml-2">${product.name}</button>
                        `;

                            $(productButton)
                                .appendTo("#moreProducts #productsCont")
                                .click(function() {
                                    $("#moreProducts").modal("hide");
                                    createSubProdRows(products[index]);
                                    createSelectedRow(products[index]);
                                });
                        });
                    }
                } else {
                    alert("No Product Found");
                }
            },
            beforeSend: function() {
                console.log("test");
            }
        });
    });

    // Delete subproduct in show product modal and update quantity and price
    $("#showProductModal form.sub-product").on("click", ".delet", function(e) {
        $(this).parent().parent("tr").fadeOut(300, function() {
            $(this).remove();
            updateModalQuantity();
            updateModalPrice();
        });
    });

    // update quantity on key up
    $("#showProductModal form.sub-product").on(
        "keyup",
        $("input.qny"),
        updateModalQuantity
    );
    // update price on key up
    $("#showProductModal form.sub-product").on(
        "keyup",
        $("input.price"),
        updateModalPrice
    );

    // show current product button

    $(".show-current-product").click(function() {
        $("#showProductModal").modal("show");
    });



 /*---------------------
    *   edit submit form Btn
    ------------------*/

var loader = $('.spinner');
    var backLoader = $('.back-loader');
    var formCreate = $('.form-create');

    formCreate.on('submit', function (e) {
        e.preventDefault();
        $("#prevClients form.general-form").validate();
        $("#prevClients-tab").click();
        
    if( formvalid.valid() ) {
        var dataForm = formCreate.serialize(),
            url = formCreate.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                // data: { _method: "PUT" },
                data: dataForm + '&client='+ $('input:radio[name=client]:checked').val() ,
                // data:new FormData(this)
                processData: false,
                // contentType: false,
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
                    // console.log(editUserForm);
                    // editUserForm.resetForm();
                    // $('.form-reset').click();
                    // $('.remove-img').click();
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    console.log(response.link);

                    setTimeout(function() { 
                        window.location = response.link;
                    }, 3000);
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



    $("#city").on("change", function(e) {
        var barcode = $("#city").val();
        e.preventDefault();
        var $this = $(this),
            Url = $this.attr("city");
        $.ajax({
            url: Url + "/" + barcode,
            dataType: "json",
            cache: false,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(data) {
                const isProductFound = data.status;
                
                if (isProductFound) {
                    $('#City-Price').val(data.Price);
                } else {
                    alert("No Product Found");
                }
            },
            beforeSend: function() {
                console.log("test");
            }
        });
    });
});
