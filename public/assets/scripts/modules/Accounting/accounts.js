$(document).ready(function() {
    $('#monetary').on('click', function() {
        $('.monetary-content').slideDown();
        $('.checks-content').slideUp();
        $(this).siblings('label').addClass('active-proccess');
        $('#checks').siblings('label').removeClass('active-proccess');
    });
    $('#checks').on('click', function() {
        $('.monetary-content').slideUp();
        $('.checks-content').slideDown();
        $(this).siblings().addClass('active-proccess');
        $('#monetary').siblings('label').removeClass('active-proccess');
    });

    $('.show-data-table').on('click', function() {
        setTimeout(function(){ 
            $('.show-data-table .fa-angle-down').toggleClass('rotate');
         }, 100);
    });

    var incomeBtn = $('#income-file-btn');

    incomeBtn.on('click', function() {
        $('#income-file').click();
    });

    $('#income-file').on('change', function() {
        $('#income-file-text').val(this.files[0].name);
    });


    var checksBtn = $('#checks-file-btn');

    checksBtn.on('click', function() {
        $('#checks-file').click();
    });

    $('#checks-file').on('change', function() {
        $('#checks-file-text').val(this.files[0].name);
    });    



    // validation
    var createUserForm = $('form.general-form');
    createUserForm.validate({
        rules: {
            amount__numbers: {
                required: true,
                number: true,
            },
            process: {
                required:true,
            },
            operation__number: {
                required:true,
                number: true
            },
            amount__char: {
                required:true,
            },
            currency__type: {
                required:true,
            },
            compane__name: {
                required:true,
            },
            charage__bank: {
                required:true,
            },
            checks__number: {
                required: true,
            }
        },
    });
 });   

 
 