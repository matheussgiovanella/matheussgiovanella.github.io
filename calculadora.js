function numClicked(val) {
    console.log(val)
    document.querySelector('.output').value += val;
}

function backspace() {

    var val = document.querySelector('.output').value;
    
    val = val.slice(0, -1);
    document.querySelector('.output').value = val;
}

function clearDisplay() {

    document.querySelector('.output').value = '';
}

function cal() {

    var val = document.querySelector('.output').value;

    val = eval(val).toFixed(2);
    document.querySelector('.output').value = val;
}