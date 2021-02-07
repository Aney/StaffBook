// Front-end Validation

const form = document.getElementById('staffType')
const fname = document.getElementById('staff_firstname')
const lname = document.getElementById('staff_lastname')
const dob = document.getElementById('staff_dob')
const email = document.getElementById('staff_email')

const jsError = document.getElementById('jsError')

// Prevent Submit unless the front-end validation is correct.
// This could be ruined by disabling JS however
form.addEventListener('submit', (eventy) => {

	let errors = []

	// Check fname is not empty
	// HTML5 does this anyways though
	// TODO: Prevent numerics and symbols (par ' and -)
	if (fname.value === '' || fname.value == null){
		errors.push('firstname missing')
	}

	if (lname.value === '' || lname.value == null){
		errors.push('lastname missing')
	}

	// DOB
	if (!validateDOB(dob.value)){
		errors.push('Invalid DOB, please use dd/mm/yy format')
	}

	// Email Validation
	if (!validateEmail(email.value)){
		errors.push('Email invalid, try string@string.string')	
	}

	if (errors.length > 0){
		jsError.innerText = errors.join('; ')
		jsError.style.display= "block";
		//window.alert(errors.join(', '));
		eventy.preventDefault();
	}
});

// Probably add an on-blur also/override the above with it

function validateEmail(email){

	// TODO:
	// string@string.string. Very basic regex, not perfect.
	var regex = /\S+@\S+\.\S+/;
	return regex.test(email);
}

function validateDOB(DOB){

	// Checks for:
	// If dd starts with 0/1/2 the next digit is 0-9
	// if dd starts with 3 next digit is 0 or 1
	// checks for /
	// if mm starts 0 then next digit is 0-9
	// if mm starts with 1 then next digit is 0-2
	// YY matches any numerical digit
	
	// TODO:
	// need to ensure this is valid 1922 - 2021, etc as only 2 YY digits
	
	var regex = /(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/(\d\d))$/;
        // Check for dd/MM/yy format.
        if (regex.test(DOB)) {
		return true;
	}

	return false;
}
