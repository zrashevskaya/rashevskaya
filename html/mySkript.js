function showError(errorMessage) {
    document.getElementById('message').className = 'error';
    document.getElementById('message').innerHTML = errorMessage;
}

function changeColorSignUp() {
    document.getElementById('signUp').className = 'green';
    document.getElementById('logIn').className = 'gray';
}

function changeColorLogIn() {
    document.getElementById('signUp').className = 'gray';
    document.getElementById('logIn').className = 'green';
}

function validateForm(form) {
    document.getElementById('message').className = '';
    document.getElementById('message').innerHTML = '';
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

    if (!document.forms["registry"]["firstName"].value) {
        showError('Please, write your First Name');
        return false;
    }
    else if (document.forms["registry"]["firstName"].value.length < 2) {
        showError('Your First Name is too short!!!');
        return false;
    }

    if (!document.forms["registry"]["lastName"].value) {
        showError('Please, write your Last Name');
        return false;
    }
    else if (document.forms["registry"]["lastName"].value.length < 3) {
        showError('Your Last Name is too short!!!');
        return false;
    }

    if (!document.forms["registry"]["email"].value) {
        showError('Please, write your e-mail');
        return false;
    }
    else if (!pattern.test(document.forms["registry"]["email"].value)) {
        showError('Please, check you e-mail. It seems to be incorrect.');
        return false;
    }

    if (!document.forms["registry"]["password"].value) {
        showError('Please, write your password');
        return false;
    }
    else if (document.forms["registry"]["password"].value.length < 6) {
        showError('Your password is too short!!! It should be not less than 6 simbols.');
        return false;
    }
    // return false;

}
