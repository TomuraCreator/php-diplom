const button_hide = document.querySelector('.button_hide_out');
const sidebar = document.querySelector('.sidebar');
const button_new_order = document.querySelector('.new_item');
const form_new_order = document.querySelector('.wrapper_form_create');
const close = document.querySelector('.close');

button_hide.addEventListener('click', function() {
    sidebar.classList.toggle('slide_left');
})
button_new_order.addEventListener('click', (e) => {
    e.preventDefault();
    form_new_order.classList.toggle('deactivate');
    
})

close.addEventListener('click', () => {
    if(close.closest('.wrapper_form_create')) {
        close.closest('.wrapper_form_create').classList.toggle('deactivate');
    }
})
