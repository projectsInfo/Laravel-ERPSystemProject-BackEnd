 $(document).ready(function() {
    // input fields
   const username = document.getElementById('email');
   const password = document.getElementById('password');
   const checkbox = document.querySelector('#remMe');
    const form = $('.login-form');
      // Local storage on checkbox(Remember me)
      function check() {
         if (checkbox.checked == true) {
            localStorage.setItem('checkbox', 'true');
            localStorage.setItem('username', $('#email').val());
            localStorage.setItem('password', $('#password').val());

         } else {
            localStorage.setItem('checkbox', 'false');
            localStorage.setItem('username', '');
            localStorage.setItem('password', '');
         }
      }
      if (localStorage.checkbox == 'true') {
         checkbox.checked = true;
      
         $('#email').val(localStorage.getItem('username', $('#email').val()));
         $('#password').val(localStorage.getItem('password', $('#password').val()));
      } else{
      
      
         checkbox.checked = false;
      }
      
      $('#remMe').click(function(){
         check()
      });
      form.validate();


    // show password on loin page
   $('.show-pass').on('click', function() {

      if('password' == $('#password').attr('type')){
         $('#password').prop('type', 'text');
      } else{
         $('#password').prop('type', 'password');
      }
   });

});