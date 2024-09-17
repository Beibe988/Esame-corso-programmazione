function validateUserForm() {
    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    if (username === '' || email === '') {
        alert('Nome utente e email sono obbligatori.');
        return false;
    }

    if (password !== '' && password.length < 6) {
        alert('La password deve avere almeno 6 caratteri.');
        return false;
    }
    return true;
}

function validateCategoryForm() {
    let name = document.getElementById('name').value;
    if (name === '') {
        alert('Il nome della categoria è obbligatorio.');
        return false;
    }
    return true;
}

function validateWorkForm() {
    let title = document.getElementById('title').value;
    let category = document.getElementById('category_id').value;

    if (title === '' || category === '') {
        alert('Titolo e categoria sono obbligatori.');
        return false;
    }
    return true;
}
