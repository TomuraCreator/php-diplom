const menu = document.querySelector('.list_header_menu');
const forms = document.querySelectorAll('.header_form');
const menu_header = document.querySelector('.list_header_menu');
const body = document.body;
document.querySelector(".button_header_menu")
    .addEventListener('click', () => menu.classList.toggle('active'));

    menu_header.addEventListener('click', (e)=> {
    let target = e.target.classList;
    e.preventDefault();
    if(target.contains('login_button')) {
        window.scrollBy(0, 1700);
        closeForm(forms);
        forms[0].classList.toggle('deactive');
    }
    if(target.contains('register_button')) {
        window.scrollBy(0, 1700);
        closeForm(forms);
        forms[1].classList.toggle('deactive');
    }
})

function closeForm(form) {
    for(value of form) {
        if(!value.classList.contains('deactive')) {
            value.classList.add('deactive');
        }
    }
}