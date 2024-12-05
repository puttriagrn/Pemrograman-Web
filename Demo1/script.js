let currentInput = '';
let equation = '';
let resultDisplayed = false;

function appendNumber(number) {
	if (resultDisplayed) {
		currentInput = number.toString();
		equation = number.toString();
		resultDisplayed = false;
	} else {
		currentInput += number.toString();
		equation += number.toString();
	}
	updateDisplay(currentInput, equation);
}

function appendOperator(operator) {
	if (resultDisplayed) {
		resultDisplayed = false;
	}
	if (currentInput !== '') {
		currentInput += operator;
		equation += operator;
		updateDisplay(currentInput, equation);
	}
	a
}

function clearDisplay() {
	currentInput = '';
	equation = '';
	updateDisplay('0', '0');
}

function updateDisplay(value, fullEquation) {
	document.getElementById('result').textContent = value;
	document.getElementById('equation').textContent = fullEquation;
}

function calculate() {
	try {
		let result = eval(currentInput);
		updateDisplay(result, equation + ' =');
		currentInput = result.toString();
		equation = '';
		resultDisplayed = true;
	} catch (error) {
		updateDisplay('Error', equation);
	}
}