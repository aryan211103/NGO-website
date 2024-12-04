const wrapper = document.querySelector('.wrapper');
const loginlink = document.querySelector('.login-link');
const btnLoginpopup = document.querySelector('.btnLogin-pop');

const registrationLink = document.querySelector('.register-link');
const registerLink= document.querySelector('.register-link');
registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginlink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

btnLoginopup.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
});

