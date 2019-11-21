const button_hide = document.querySelector('.button_hide_out');
const sidebar = document.querySelector('.sidebar');

button_hide.addEventListener('click', function() {
    sidebar.classList.toggle('slide_left');
})