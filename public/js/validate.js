const emailInput = document.querySelector('#email');
const passwordInput = document.querySelector('#password');
const confirmInput = $('#confPassword');
var password = $('#password').val();
emailInput.addEventListener('input', validateEmail);
passwordInput.addEventListener('input', validatePassword);


confirmInput.on('input', function(){
  const confirm = $('#confPassword').val();
  if ($('#confPassword').val() == $('#password').val()) {
    document.querySelector('.confirm-error').style.visibility = 'hidden';
  } else  {
    document.querySelector('.confirm-error').style.visibility = 'visible';
    document.querySelector('.register').addEventListener('submit', function(event) {
      event.preventDefault();
    });
  }
});


function validateEmail() {
  const email = emailInput.value;
  
  // Basic email validation regex
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  if (regex.test(email)) {
    // Valid email, add valid class and hide error message
    emailInput.classList.add('valid');
    emailInput.classList.remove('invalid');
    document.querySelector('.email-error').style.visibility = 'hidden';
  } else {
    // Invalid email, add invalid class and show error message
    emailInput.classList.add('invalid');
    emailInput.classList.remove('valid');
    document.querySelector('.email-error').style.visibility = 'visible';
    document.querySelector('.register').addEventListener('submit', function(event) {
      event.preventDefault();
    });
  }
  
}

function validatePassword() {
  let passWord = $('#password').val();
  // Password must be at least 8 characters, have a letter, a number, and a special symbol
  const regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
  
  if (regex.test(passWord)) {
    // Valid password, add valid class and hide error message
    passwordInput.classList.add('valid');
    passwordInput.classList.remove('invalid');
    document.querySelector('.password-error').style.visibility = 'hidden';
  } else {
    // Invalid password, add invalid class and show error message
    passwordInput.classList.add('invalid');
    passwordInput.classList.remove('valid');
    document.querySelector('.password-error').style.visibility = 'visible';
    document.querySelector('.register').addEventListener('submit', function(event) {
      event.preventDefault();
    });
  }
}

const togglePassword = $('#togglePassword');
password = $('#password');

togglePassword.on('click', function(e) {

  const type = password.attr('type') === 'password' ? 'text' : 'password';
  password.attr('type', type);
  $(this).toggleClass('fa-eye-slash fa-eye');
});

const toggleConfPassword = $('#toggleConfPassword');
const confPassword = $('#confPassword');

toggleConfPassword.on('click', function(e) {
  const type = confPassword.attr('type') === 'password' ? 'text' : 'password';
  confPassword.attr('type', type);
  $(this).toggleClass('fa-eye-slash fa-eye');
});

$('.submit').on('click', function(){
  if (!emailInput.value || !$('#password').val() || !$('#confPassword').val()) {
    event.preventDefault();
  } else {
    $('.register').submit();
  }
});

