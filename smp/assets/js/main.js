//input only letters
function restrictToLetters(event) {
  var input = event.target;
  var sanitizedValue = input.value.replace(/[^a-zA-Z\s]+/g, ''); //  Menghapus karakter selain huruf
  input.value = sanitizedValue;
}

//input only numbers
function restrictToNumber(event) {
  var input = event.target;
  var sanitizedValue = input.value.replace(/[^0-9]+/g, ''); // Delete character beside number
  input.value = sanitizedValue;
}

function Combine(event){
    var input = event.targer;
    var sanitizedValue = input.value.replace(/[^a-zA-Z0-9]+/g, '');
    input.value = sanitizedValue;
}
