document.addEventListener("DOMContentLoaded", () => {

    // Вставка заголовка
    const pageValue = document.querySelector("#hidden_input_value");
    if (pageValue) {
        const h1 = document.querySelector("h1");
        if (h1) {
            pageValue.value = h1.innerText.trim();
        }
    }

    // Ремонт хедера на страницах component
    const path = window.location.pathname;

    // Проверяем, что мы на /index.php/component или дочерних страницах
    if (path === '/index.php/component' || path.startsWith('/index.php/component/')) {
        const navbar = document.querySelector('body.cc-home .tm-header .uk-navbar');
        if (navbar) {
            navbar.style.setProperty('background-color', '#1e1e1e', 'important');
        }
    }


});