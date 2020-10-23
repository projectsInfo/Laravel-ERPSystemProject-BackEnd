const inputFile = $(".profile-img-wrapper #input-file");
$(document).ready(function () {


    /* Sidebar */


    const linkText = $('.link-text');
    const links = $('.sidebar a');
    const shortLines = $('.short-line');
    const logoDiv = $('.sidebar-header .logo');
    const logoText = $('.logo-text');
    const sidebar = $('.sidebar');
    // click on button in nav bar to open sidebar
    $('#sidebarCollapse').on('click', function () {

        // add class active to sidebar which changes its 
        sidebar.toggleClass('active');

        // hide links text in sidebar
        linkText.toggle();
        
        // enlarge logo
        logoDiv.toggleClass('col-lg-12');

        // hide logo text
        logoText.toggle();

        // center links icons
        links.toggleClass('justify-content-center');


        // animation for bars icon in side bars
        if (shortLines.css('width') === '15px'){
            shortLines.animate({
                width: '20px'
            }, 400);
        } else {
            shortLines.animate({
                width: '15px'
            }, 400);
        }
    });


    /* Sidebar */


    /* Drag and drop image file */


    // /* get file url and put it in image src */

    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                imgPrev.attr('src', e.target.result);
            } 

            reader.readAsDataURL(input.files[0]);

            imgText.text(input.files[0].name);

            var pla = URL.createObjectURL(event.target.files[0]);
            console.log(pla);
        }
    }

    const profileImgWrapper = $(".profile-img-wrapper");
    const inputFile = $(".profile-img-wrapper #input-file");
    const imgPrev = $(".profile-img-wrapper .img-preview img");
    const rmBtn = $(".profile-img-wrapper .remove-img");
    const imgText = $(".profile-img-wrapper .img-overlay .img-name");
    const imgOverlay = $(".profile-img-wrapper .img-overlay");

    inputFile.change(function () {

        if (this.files[0].type.includes("image")) {
            readURL(this);

            imgPrev.fadeIn(800);

            profileImgWrapper.on('mouseenter', function () {
                rmBtn.addClass("d-block");
                imgOverlay.addClass("d-flex");
            });

            profileImgWrapper.on('mouseleave', function () {
                rmBtn.removeClass("d-block");
                imgOverlay.removeClass("d-flex");
            });
            
        } else {
            alert("Invalid file type");
        }
        

       
        
    });

    rmBtn.click(function(){
        profileImgWrapper.off('mouseenter');
        profileImgWrapper.off('mouseleave');
        rmBtn.removeClass("d-block");
        imgOverlay.removeClass("d-flex");
        imgPrev.fadeOut(1000, function(){
            this.src = "";
        });

    });

    

    
    // function VaildationName from form
    $('#name').on('keypress keyup blur',function () {
        if (this.value.length < 4) {
            document.querySelector('.input-name-message').innerHTML = "charachters should be 4 char or more";
        } else {
            document.querySelector('.input-name-message').innerHTML = "great!";
        }
    });




    // function VaildationPhoneNumber from form
    $('#phone').on('keypress keyup blur',function () {
        if (this.value.length < 10) {
            document.querySelector('.input-phone-message').innerHTML = "number should be 11 or more";
        } else {
            document.querySelector('.input-phone-message').innerHTML = "great!";
        }
    });



    // function VaildationUserName from form
    $('#username').on('keypress keyup blur',function () {

        const usernameError = $(".input-username-message");
        if (this.value.length < 4) {
            document.querySelector('.input-username-message').textContent = "charachters should be 4 char or more";
        } else {
            document.querySelector('.input-username-message').innerHTML = "great!";
        }
    });


    // function generate Pass
    var generate = $('#generatePass');
    var fileUpload = $('#file-upload');
    
    generate.on('click',function() {
        let user = document.getElementById('username').value;
        let date = new Date();
        var password = document.getElementById('password').value =
            password = user + date.getFullYear() + date.getHours() + date.getSeconds();
    });

    fileUpload.on('change',function() {
        let text = document.getElementById('file');
        text.value = this.files[0].name;
    });
});


//function add child div to section department
$('#create-department').on('click',function() {
    let Department = document.querySelector('#department').value;
    if (Department == '') {
        $('.message-error').css('display','block');
    } else {
        let result = document.querySelector('.department-types ul');
        let text = document.createTextNode(Department);
        let li = document.createElement('li');
        li.appendChild(text);
        result.appendChild(li);
    }
});




$('#department').on('keypress keyup' , function() {
    if($(this).val() == '') {
        $('.input-department-error').show();
    } else {
        $('.input-department-error').hide();
    }
    
});


// upliad imgs in section products
const loadImage = function(event) {
    var mainDiv = document.querySelector('#file-upload');
	var test = document.querySelector('#upliad-img-info');
    var img = document.createElement('img');
	img.setAttribute('style','width:100px;height:100px;');
    img.setAttribute('src', URL.createObjectURL(event.target.files[0]));
    test.appendChild(img);
}

// add more img
$('.add-more-img').on('click',function() {
    var mainDiv = document.querySelector('#file-upload');
	var test = document.querySelector('#upliad-img-info');
    var img = document.createElement('img');
	img.setAttribute('style','width:100px;height:100px;');
    test.appendChild(img);
});













// input fields
const username = document.getElementById('username');
const password = document.getElementById('password');
const checkbox = document.querySelector('#remMe');

// validation colors  
// const green = '#4caf50';
const red = '#f44336';

// Validators
function validateUsername() {
    //check if it's empty
    if (checkEmpty(username)) return;
}

function validatePassword() {
    // check if empty
    if (checkEmpty(password)) return;
}


// Utility functions
function checkEmpty(field) {
    if (isEmpty(field.value.trim())) {
        // set the field to invalid
        setInvalid(field, `${field.name} must not be empty`);
        return true;
    } else {
        // set the field to valid
        setValid(field);
        return false;
    }
}

function isEmpty(value) {
    if (value === '') return true;

    return false;
}

function setInvalid(field, message) {
    // field.className = 'is-invalid';
    field.nextElementSibling.innerHTML = message;
    field.nextElementSibling.style.color = red;
    field.style.border = '1px solid red';
}

function setValid(field, message) {
    // field.className = 'is-valid';
    field.nextElementSibling.innerHTML = '';
    field.style.border = '1px solid #F18C2F';
    // field.nextElementSibling.style.color = green;
}

// Local storage on checkbox(Remember me)

if (localStorage.checkbox == 'true') {
    checkbox.checked = true;
    username.value = localStorage.username;
    password.value = localStorage.password;
    // console.log(username);
} else
    checkbox.checked = false;


function check() {
    if (checkbox.checked == true) {
        localStorage.setItem('checkbox', 'true');
        localStorage.setItem('username', username.value);
        localStorage.setItem('password', password.value);
    } else {
        localStorage.setItem('checkbox', 'false');
        localStorage.setItem('username', '');
        localStorage.setItem('password', '');
    }
}























