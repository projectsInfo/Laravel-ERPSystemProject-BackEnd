$(document).ready(function(){
    const editBtn = $('#editBtn');
    const saveBtn = $('.save');
    const cancelBtn = $('.cancel');
    const userInfoForm = $('.user-info-form');
    const editForm = $('.edit-form');
    const staticLabels = $('.static-labels')
    const generateBtn = $('#generatePass');
    const passIN = $('#password');
    const fileUpload = $('#file-upload');
    const downloadFileBtn = $(".download-file");
    const uploadFileBtn = $(".upload-file");
    const text = $('#file');
    const departmentFormGroup = $('.department-form-group');
    const profileImgWrapper = $(".profile-img-wrapper");
    const profileImgIN = $(".profile-img-wrapper #profile-img-in");
    const imgPrev = $(".profile-img-wrapper .img-preview img");
    const rmImgBtn = $(".profile-img-wrapper .remove-img");
    const imgText = $(".profile-img-wrapper .img-overlay .img-name");
    const imgOverlay = $(".profile-img-wrapper .img-overlay");
    const defaultImg = $('aside img');

    /* Drag and drop image file */

    // get file url and put it in image src

    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                imgPrev.attr('src', e.target.result);
            } 

            reader.readAsDataURL(input.files[0]);

            imgText.text(input.files[0].name);

            let pla = URL.createObjectURL(event.target.files[0]);
        }
    }

    

    profileImgIN.change(function () {

        if (this.files[0].type.includes("image")) {
            readURL(this);

            imgPrev.fadeIn(800);

            profileImgWrapper.on('mouseenter', function () {
                rmImgBtn.addClass("d-block");
                imgOverlay.addClass("d-flex");
            });

            profileImgWrapper.on('mouseleave', function () {
                rmImgBtn.removeClass("d-block");
                imgOverlay.removeClass("d-flex");
            });
            
        } else {
            alert("Invalid file type");
        }    
    });

    // remove profile image when x button is clicked

    rmImgBtn.click(function(){
        // clear events 
        profileImgWrapper.off('mouseenter');
        profileImgWrapper.off('mouseleave');
        // hide the button
        rmImgBtn.removeClass("d-block");
        imgOverlay.removeClass("d-flex");
        imgPrev.fadeOut(500, function(){
            this.src = "";
        });
        profileImgIN.val('');
    });    


    // generate random password with length parameter
    function randomPassword(length) {
        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";
        let pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        return pass;
    }
    
    generateBtn.on('click',function() {
        passIN.val(randomPassword(16));
    });

    // File cv 

    fileUpload.on('change',function() {
        
        text.val(this.files[0].name);
            downloadFileBtn.removeClass('d-none');
            uploadFileBtn.addClass('d-none');
    });

    // when edit button is clicked display form inputs

    editBtn.click(function(){
        editForm.fadeIn();
        downloadFileBtn.fadeIn();
        staticLabels.hide();
        cancelBtn.fadeIn();
        departmentFormGroup.fadeIn();
        profileImgWrapper.css('display','flex');
        $(this).hide();

        

    });


     cancelBtn.click(function(){
        editForm.hide();
        staticLabels.fadeIn();
        editBtn.fadeIn();
        departmentFormGroup.hide();
        profileImgWrapper.hide();
        $(this).hide();
    });
    
    
    /*--------------
    *   Validation
    ---------------*/
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
    }, "Don't leave space");
    userInfoForm.validate({
        rules: {

            name: {
                required: true,
                noSpace: true,
            },

            address: {
                minlength: "4"
            },

            phone: {
                number: true
            },

            gender: {
                required: true
            },

            departments: {
                required: true
            },
            username: {
                required: true
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
                accept: "application/pdf, image/jpeg, image/png"
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

    
})