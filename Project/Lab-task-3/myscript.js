// Calculator state variables
let currentInput = '0';
let previousInput = '';
let operation = null;
let resetScreen = false;

// DOM elements
const display = document.getElementById('display');

// Initialize display
updateDisplay();

// Function to update the calculator display
function updateDisplay() {
    display.innerText = currentInput;
}

// Function to append a number to the current input
function appendNumber(number) {
    if (currentInput === '0' || resetScreen) {
        currentInput = number;
        resetScreen = false;
    } else {
        currentInput += number;
    }
    updateDisplay();
}

// Function to set the operation
function setOperator(op) {
    if (operation !== null) calculate();
    previousInput = currentInput;
    operation = op;
    resetScreen = true;
}

// Function to perform the calculation
function calculate() {
    let result;
    const prev = parseFloat(previousInput);
    const current = parseFloat(currentInput);
    
    if (isNaN(prev)) return;
    
    switch (operation) {
        case '+':
            result = prev + current;
            break;
        case '-':
            result = prev - current;
            break;
        case '*':
            result = prev * current;
            break;
        case '/':
            result = prev / current;
            break;
        default:
            return;
    }
    
    currentInput = result.toString();
    operation = null;
    updateDisplay();
}

// Function to clear the calculator
function clearAll() {
    currentInput = '0';
    previousInput = '';
    operation = null;
    updateDisplay();
}