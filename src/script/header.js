const body = document.body;
const button_hide = document.querySelector('.button_hide_out');
const sidebar = document.querySelector('.sidebar');
const button_new_order = document.querySelector('.new_item');
const form_new_order = document.querySelector('.wrapper_form_create');
const close = document.querySelector('.close');
const edit = document.querySelectorAll('.button_edit');

button_hide.addEventListener('click', function() {
    sidebar.classList.toggle('slide_left');
})

close.addEventListener('click', () => {
    if(close.closest('.wrapper_form_create')) {
        close.closest('.wrapper_form_create').classList.toggle('deactivate');
    }
})

button_new_order.addEventListener('click', (e) => {
    e.preventDefault();
    form_new_order.classList.toggle('deactivate');
    
})
body.addEventListener('click', (e)=> {
    let target = e.target;
    if(target.classList.contains('close') && target.closest('.wrapper_form_edit')) {
        target.closest('.wrapper_form_edit').remove();
    }
})

for(let value of edit) {
    value.addEventListener('click', function(e) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'getForm.php?name=' + this.dataset.id, true);
        xhr.setRequestHeader("Content-type", 'application/x-www-form-urlencoded');
        xhr.send();
        xhr.addEventListener('readystatechange', () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                getObject(JSON.parse(xhr.responseText), (data, err) => {
                    if(data) {
                        console.log(data)
                        // body.insertAdjacentHTML('beforeend', createForm(data));
                    } else {
                        console.log(xhr)
                    }
                });
            } else if (xhr.readyState !== 4 && xhr.status !== 200) {
                console.log(`Ответ ${xhr.status}: ${xhr.statusText}`);
            }
        });
    })
}

function getObject(str, call) {
    call(str, null);
}

function createForm(obj) {
    const {card, text} = obj;
    return `
    <div class="wrapper_form_edit">
    <form action="translate_form.php" method="POST" class="edit_form">
        <div class="wrapper_personality_or_client">
            <div class="text_window order_person">
                <div class="lang_tab">
                    <p>Язык оригинала: ${card.lang_origin_text}</p>
                    <p>Язык перевода: ${card.lang_for_translate.join(', ')}</p>
                </div>
            </div>
            <div class="text_window translate_person">
                <p>Срок сдачи: ${card.deadline}</p>
            </div>
        </div>
        <div class="original_text_show">
            ${text.text}
        </div>
        ${getHTML(card)}
        <div class="wrapper_submit">
            <div class="wrapper_button_forms">
                <input type="submit" value="Отправить">
                <input type="button" value="Закрыть" class="close">
                <input type="hidden" name="status" value="resolved">
            </div>
        </div>
    </form>
</div>
    `
}
function getHTML(x) {
 let t = '';
 for(let value of x.lang_for_translate) {
     t += `<textarea name="${value}" cols="30" rows="10" class="text_of_translate" required placeholder="${value}" title="${value}">
     </textarea>`;
     }
     return t;
}
