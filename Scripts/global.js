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