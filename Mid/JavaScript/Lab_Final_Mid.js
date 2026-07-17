
const form = document.getElementById('clubForm');
const firstNameInput = document.getElementById('firstName');
const lastNameInput = document.getElementById('lastName');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const genderRadios = document.querySelectorAll('input[name="gender"]');
const clubCheckboxes = document.querySelectorAll('input[name="clubs"]');
const categorySelect = document.getElementById('category');
const reasonText = document.getElementById('reason');
const messageBox = document.getElementById('message');

let loginAttempts = 0;
let isLocked = false;


form.addEventListener('submit', function (e) {
  e.preventDefault();

  clearErrors();
  let isValid = true;

  if (!validateName(firstNameInput)) isValid = false;
  if (!validateName(lastNameInput)) isValid = false;
  if (!validateEmail(emailInput)) isValid = false;
  if (!validatePassword(passwordInput)) isValid = false;
  if (!validateGender()) isValid = false;
  if (!validateClubs()) isValid = false;
  if (!validateCategory()) isValid = false;
  if (!validateReason()) isValid = false;

  if (isValid) {
    messageBox.textContent = 'Registration successful!';
    messageBox.className = 'success';
    form.reset();
    loginAttempts = 0;
    isLocked = false;
    passwordInput.disabled = false;
  } else {
    if (isLocked) {
      messageBox.textContent = 'Form locked due to invalid password attempts.';
      messageBox.className = 'fail';
    } else {
      messageBox.textContent = 'Please fix the highlighted errors.';
      messageBox.className = 'fail';
    }
  }
});


function validateName(inputEl) {
  const value = inputEl.value.trim();
  const regex = /^[A-Za-z]+$/;
  if (value === '' || !regex.test(value)) {
    setError(inputEl, 'Alphabets only, cannot be empty');
    return false;
  }
  return true;
}

function validateEmail(inputEl) {
  const value = inputEl.value.trim();
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (value === '' || !regex.test(value)) {
    setError(inputEl, 'Enter a valid email address');
    return false;
  }
  return true;
}

function validatePassword(inputEl) {
  if (isLocked) {
    setError(inputEl, 'Password input locked');
    return false;
  }

  const value = inputEl.value.trim();
  const regex = /^(?=.*[A-Za-z])(?=.*\d).{6,}$/; // at least 6, one letter, one digit

  if (value === '' || !regex.test(value)) {
    loginAttempts++;
    setError(inputEl, 'Min 6 chars, include letters and numbers');
    if (loginAttempts >= 3) {
      isLocked = true;
      inputEl.disabled = true;
    }
    return false;
  }

  return true;
}

function validateGender() {
  for (let radio of genderRadios) {
    if (radio.checked) {
      document.getElementById('genderError').textContent = '';
      return true;
    }
  }
  document.getElementById('genderError').textContent = 'Select a gender';
  return false;
}

function validateClubs() {
  for (let cb of clubCheckboxes) {
    if (cb.checked) {
      document.getElementById('clubsError').textContent = '';
      return true;
    }
  }
  document.getElementById('clubsError').textContent = 'Select at least one club';
  return false;
}

function validateCategory() {
  if (categorySelect.value === '') {
    setError(categorySelect, 'Choose a club category');
    return false;
  }
  return true;
}

function validateReason() {
  const text = reasonText.value.trim();
  if (text.length < 20) {
    setError(reasonText, 'Minimum 20 characters required');
    return false;
  }
  return true;
}


function setError(inputEl, message) {
  inputEl.classList.add('invalid');
  const errorSpan = inputEl.parentElement.querySelector('.error');
  if (errorSpan) {
    errorSpan.textContent = message;
  }
}

function clearErrors() {
  const invalidInputs = document.querySelectorAll('.invalid');
  invalidInputs.forEach(el => el.classList.remove('invalid'));

  const errorSpans = document.querySelectorAll('.error');
  errorSpans.forEach(span => span.textContent = '');

  messageBox.textContent = '';
  messageBox.className = '';
}