function showLoginPanel(){
    const cartPanel = document.querySelectorAll('.cart-right-panel').item(0);
    cartPanel.classList.remove('display-cart');
    const loginPanel = document.querySelectorAll('.login-panel').item(0);
    loginPanel.classList.add('display-login');
    const overlay = document.querySelector('.overlay-dark');
    overlay.style.display = 'block';
    document.body.classList.add('no-scroll');
}
function showCartPanel(){
    const loginPanel = document.querySelectorAll('.login-panel').item(0);
    loginPanel.classList.remove('display-login');
    const cartPanel = document.querySelectorAll('.cart-right-panel').item(0);
    cartPanel.classList.add('display-cart');
    const overlay = document.querySelector('.overlay-dark');
    overlay.style.display = 'block';
    document.body.classList.add('no-scroll');

}
function hideCartPanel(){
    const loginPanel = document.querySelectorAll('.login-panel').item(0);
    loginPanel.classList.remove('display-login');
    const cartPanel = document.querySelectorAll('.cart-right-panel').item(0);
    cartPanel.classList.remove('display-cart');
    const overlay = document.querySelector('.overlay-dark');
    overlay.style.display = 'none';
    document.body.classList.remove('no-scroll');

}

document.addEventListener("DOMContentLoaded", function () {
    window.onscroll = function () {
        checkSticky();
    };
    var downHeader = document.getElementById("down-header");
    var cart = document.getElementsByClassName("cart-right-panel").item(0);
    var loginPanel = document.querySelectorAll(".login-panel").item(0);
    var sticky = downHeader.offsetTop;

    function checkSticky() {
        if (window.pageYOffset >= sticky) {
            downHeader.classList.add("sticky");
            cart.classList.add("sticky")
            loginPanel.classList.add("sticky");
        } else {
            downHeader.classList.remove("sticky");
            cart.classList.remove("sticky");
            loginPanel.classList.remove("sticky");
        }
    }
});
