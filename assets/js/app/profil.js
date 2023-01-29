import '../../bootstrap';
import '../../styles/app/profil.css';

const message = document.querySelector('#message');

console.log(message);
setTimeout(() => {
    message.setAttribute('hidden', "");
}, 3000);

const password = document.querySelector('#password');
const actuelPassword = document.querySelector('#actuelPassword');
const error = document.querySelector('#error');
const erreur = document.querySelector('#erreur');
const erreurs = document.querySelector('#erreurs');
const confirmPassword = document.querySelector('#confirmPassword');
const nouveauPassword = document.querySelector('#nouveauPassword');
const MyformPassword = document.querySelector('#MyformPassword');

// const bcrypt = require("bcrypt");
// console.log(bcrypt);
password.addEventListener('blur', () => {

    const url = 'motpasse/' + password.value;
    fetch(url, {
        method: 'GET'
    }).then(res => {
        return res.json()
    }).then(datas => {
        passwordCheck(datas);
    })

});

actuelPassword.addEventListener('blur', () => {

    const url = 'motpasse/' + actuelPassword.value;
    fetch(url, {
        method: 'GET'
    }).then(res => {
        return res.json()
    }).then(datas => {
        passwordsCheck(datas);
    })

});

const passwordCheck = (bool) => {
    if (bool) {

        password.style.border = ' 2px green solid';
        error.innerHTML = "Mot de passe correct "
        error.style.color = 'green'
    } else {

        password.style.border = ' 2px red solid';
        error.innerHTML = "Mot de passe incorrect "
        error.style.color = 'red'
    }
};
const passwordsCheck = (bool) => {
    if (bool) {

        actuelPassword.style.border = ' 2px green solid';
        erreur.innerHTML = "Mot de passe correct "
        erreur.style.color = 'green'
    } else {

        actuelPassword.style.border = ' 2px red solid';
        erreur.innerHTML = "Mot de passe incorrect "
        erreur.style.color = 'red'
    }
};
confirmPassword.myFunction = function() {
    if (confirmPassword.value == nouveauPassword.value) {
        confirmPassword.style.border = ' 2px green solid';
        erreurs.innerHTML = "Mot de passe correspond "
        erreurs.style.color = 'green'

    } else {
        confirmPassword.style.border = ' 2px red solid';
        erreurs.innerHTML = "Mot de passe ne correspond "
        erreurs.style.color = 'red'
    }
}