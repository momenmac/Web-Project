document.addEventListener('DOMContentLoaded', () => {
    const quantityControl = document.querySelector('.quantity-control');
    const input = quantityControl.querySelector('.quantity-input');
    const minusBtn = quantityControl.querySelector('[data-quantity-minus]');
    const plusBtn = quantityControl.querySelector('[data-quantity-plus]');

    minusBtn.addEventListener('click', function() {
        const currentValue = parseInt(input.value, 10);
        const minValue = parseInt(input.min, 10);
        if (currentValue > minValue) {
            input.value = currentValue - 1;
        }
    });

    plusBtn.addEventListener('click', function() {
        const currentValue = parseInt(input.value, 10);
        const maxValue = parseInt(input.max, 10);
        if (currentValue < maxValue) {
            input.value = currentValue + 1;
        }
    });

    input.addEventListener('change', function() {
        const currentValue = parseInt(input.value, 10);
        const minValue = parseInt(input.min, 10);
        const maxValue = parseInt(input.max, 10);

        if (currentValue < minValue) {
            input.value = minValue;
        } else if (currentValue > maxValue) {
            input.value = maxValue;
        }
    });

    const navIcons = document.querySelectorAll('.navPages-list-icons');
    const overlay = document.querySelector('.overlay-dark');
    const cartPanel = document.querySelectorAll('.cart-right-panel').item(0);
    const loginPanel = document.querySelectorAll('.login-panel').item(0);
    overlay.addEventListener('click', function(){
        overlay.style.display = 'none';
        cartPanel.classList.remove('display-cart');
        loginPanel.classList.remove('display-login');
        document.body.classList.remove('no-scroll');




    })


    navIcons.forEach((icon, index) => {
        if (index === 0 ||index === 5) return; // Skip the first element

        icon.addEventListener('mouseenter', function () {
            overlay.style.display = 'block';
            document.body.classList.add('no-scroll');
        });

        icon.addEventListener('mouseleave', function () {
            overlay.style.display = 'none';
            document.body.classList.remove('no-scroll');
        });
    });
});


