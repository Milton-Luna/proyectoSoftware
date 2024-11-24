function saveUserToDatabase(username, password) {
    const users = JSON.parse(localStorage.getItem('users')) || {};
    users[username] = password; // Considera agregar un hash de la contraseña aquí
    localStorage.setItem('users', JSON.stringify(users));
}

function getUserFromDatabase(username) {
    const users = JSON.parse(localStorage.getItem('users')) || {};
    return users[username];
}

function userExists(username) {
    const users = JSON.parse(localStorage.getItem('users')) || {};
    return users.hasOwnProperty(username);
}

function saveUserCredentials(username, password, rememberMe) {
    if (rememberMe) {
        localStorage.setItem('rememberedUser', username);
        localStorage.setItem('rememberedPassword', password);
    } else {
        localStorage.removeItem('rememberedUser');
        localStorage.removeItem('rememberedPassword');
    }
}

function loadUserCredentials() {
    const rememberedUser = localStorage.getItem('rememberedUser');
    const rememberedPassword = localStorage.getItem('rememberedPassword');

    if (rememberedUser) {
        document.getElementById('username').value = rememberedUser;
        document.getElementById('password').value = rememberedPassword;
        document.getElementById('rememberMe').checked = true;
    }
}

// Ejemplo de función para encriptar contraseñas (simplificado)
function hashPassword(password) {
    // Implementa un hash simple o usa una librería de hashing aquí
    return btoa(password); // Esto solo es un ejemplo y no es seguro para producción
}
