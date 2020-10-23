$(document).ready(function () {

    const body = $('body');
    const sidebarLinks = $('a.sidebar-link');
    const clsSidebarBtn = $('.close-sidebar');

    $('.sidebar-collapse').on('click', function (e) {
        if (window.matchMedia('(min-width: 992px)').matches) {
            e.preventDefault();
            body.toggleClass('sidebar-folded');
        } else {
            e.preventDefault();
            body.addClass('sidebar-opened');
        }
    });
    
    clsSidebarBtn.click(function(){
        body.removeClass('sidebar-opened');
    });

    sidebarLinks.click(function () {
        const thisLinkMenu = $(this).siblings();
        const linkSubmenus = $('.link-submenu');
        linkSubmenus.not(thisLinkMenu).collapse('hide');
    });


    $(".sidebar").hover(
        function () {
            if (body.hasClass('sidebar-folded')) {
                body.addClass("open-sidebar-folded");
            }
        },
        function () {
            if (body.hasClass('sidebar-folded')) {
                body.removeClass("open-sidebar-folded");
            }
        }
    );

    $('.sidebar-overlay').on('click', function() {
        $(clsSidebarBtn).click();
    })

    /*------------------------------
    *   Topbar Functionalities
    *-------------------------------*/



    // function toggle username
    $('.dropdown-toggle , .user-img').on('click', function(e) {
        e.stopPropagation();
        $('.dropdown-menu').toggle();
    })


   /*-------------------------------*
    *       Custem Validator        *
    *-------------------------------*/
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.charAt(0) != " ";
    }, "No space please and don't leave it empty")
    
    /*-------------------------------*
    *       Validatation
    *-------------------------------*/

    var validator = $('#form').validate({
    rules: {
        name: {
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
    },
    messages: {},
        errorPlacement: function(error, element) {
            var placement = element.data('error');
            console.log(element.next(placement));
            
            $(placement).append(error)
    

        
        }
    });

    // Convert Arabic Number To English 
    function parseArabic(arNum) {
        arNum = (arNum.replace(/[٠١٢٣٤٥٦٧٨٩]/g, function (d) {
            return d.charCodeAt(0) - 1632;                
            }).replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function (d) { return d.charCodeAt(0) - 1776; })
        );
        return arNum;
    };

    // Convert any inputed arabic number to english
    $('input[type="text"], input[type="number"]').on("input", function() {
        const inputVal = $(this).val();
        const enValue = parseArabic(inputVal);
        $(this).val(enValue);
    });

    // start accordion of page

    const allWidgetContents =  $('.widget-content');
    const tableWidgetContent = $('.widget-content.table');
    const allWidgets = $('.widget').not('.modal .widget');

    // show widget content that has table
    tableWidgetContent.show();

    if(allWidgetContents.length == 1){
        allWidgetContents.show();
    }

    allWidgets.on('click', function() {
        const widgetContent = $(this).find(".widget-content");
        widgetContent.slideDown();
        allWidgetContents.not(widgetContent).slideUp();
        
    });

    // Date Picker 

    //date pick
    const datepicker = $('.datepicker');
    if(datepicker.length != 0){
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            showAnim: 'drop',
            minDate: new Date(),
            showButtonPanel: true
        });

        $('.datepicker').datepicker('setDate', new Date());

    }

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

    
    // general change placeholder text

    $('.general-search-select').on('change', function() {
        const selectDropdownVal = $(this).children('option:selected').text();
        const inputSearch = $(this).parent().parent().siblings().find('.input-search');
        
        if (selectDropdownVal === "status") {
            inputSearch.addClass("d-none");
            $(".status-select").removeClass("d-none");
        } else {
            inputSearch.attr("placeholder", selectDropdownVal);
            inputSearch.removeClass("d-none");
            $(".status-select").addClass("d-none");
        }
    });

    // general refrush page by reset button
    $('button[type="reset"]').on('click', function() {
        document.location.reload(true);
    });

});










