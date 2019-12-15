const body = document.body;
const button_hide = document.querySelector('.button_hide_out');
const sidebar = document.querySelector('.sidebar');
// const button_new_order = document.querySelector('.new_item');
const close = document.querySelector('.close');


button_hide.addEventListener('click', function() {
    sidebar.classList.toggle('slide_left');
})

close.addEventListener('click', () => {
    if(close.closest('.wrapper_form_create')) {
        close.closest('.wrapper_form_create').classList.toggle('deactivate');
    }
})

// if(button_new_order) {
//     button_new_order.addEventListener('click', (e) => {
//         e.preventDefault();
//         form_new_order.classList.toggle('deactivate');
//     })
// }


body.addEventListener('click', (e)=> {
    let target = e.target;
    if(target.classList.contains('close') && target.closest('.wrapper_form_edit')) {
        target.closest('.wrapper_form_edit').remove();
    }
})

