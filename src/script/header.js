const button_hide = document.querySelector('.button_hide_out');
const sidebar = document.querySelector('.sidebar');
const button_new_order = document.querySelector('.new_item');
const form_new_order = document.querySelector('.wrapper_form_create');
const close = document.querySelector('.close');
const edit = document.querySelectorAll('.button_edit');

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

for(let value of edit) {
    value.addEventListener('click', function(e) {
        console.log(this.dataset.id)
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'getForm.php?name=' + this.dataset.id, true);
        xhr.send(null);
        if(xhr.status != 200) {
            getObject(xhr.response, (data, err) => {
                if(data) {
                    console.log(JSON.parse(xhr.responseText));
                } else {
                    console.log(xhr)
                }

            })
        }
    })
}

function getObject(str, call) {
    call(str, null);
}