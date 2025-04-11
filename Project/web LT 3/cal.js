let currentOperator = null;

function setOperator(operator) {
  currentOperator = operator;
  document.getElementById('result').innerText = "Operator set to: " + operator;
}

function calculate() {
  const num1 = parseFloat(document.getElementById('num1').value);
  const num2 = parseFloat(document.getElementById('num2').value);
  let result = '';

  if (!currentOperator) {
    result = "Please select an operator first.";
  } else if (isNaN(num1) || isNaN(num2)) {
    result = "Please enter valid numbers.";
  } else {
    switch (currentOperator) {
      case '+':
        result = num1 + num2;
        break;
      case '-':
        result = num1 - num2;
        break;
      case '*':
        result = num1 * num2;
        break;
      case '/':
        result = num2 !== 0 ? num1 / num2 : "Cannot divide by zero";
        break;
    }
  }

  document.getElementById('result').innerText = "Result: " + result;
}
