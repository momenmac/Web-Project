let slideIndex = 1;
let slideInterval;

document.addEventListener("DOMContentLoaded", function () {
    showSlides(slideIndex);
    slideInterval = setInterval(function () {
        plusSlides(1);
    }, 4000);
});

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dotsContainers = document.getElementsByClassName("dots-container");

    // Loop through each slide
    for (i = 0; i < slides.length; i++) {
        // Hide all slides
        slides[i].style.display = "none";

        // Remove "active" class from all dots in this slide's dot container
        let dots = dotsContainers[i].getElementsByClassName("dot");
        for (let j = 0; j < dots.length; j++) {
            dots[j].classList.remove("active");
        }
    }

    // Show the current slide
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    slides[slideIndex - 1].style.display = "block";

    // Add "active" class to the corresponding dot in this slide's dot container
    let dots = dotsContainers[slideIndex - 1].getElementsByClassName("dot");
    dots[slideIndex - 1].classList.add("active");
}


const slideshowContainer = document.querySelector('.slideshow-container');

// slideshowContainer.addEventListener('mouseenter', function() {
//     clearInterval(slideInterval);
// });
//
// slideshowContainer.addEventListener('mouseleave', function() {
//     slideInterval = setInterval(function() {
//         plusSlides(1);
//     }, 4000);
// });
// animation for the gallery
// document.addEventListener("DOMContentLoaded", function () {
//     window.onscroll = function () {
//         checkSticky();
//     };
//     var downHeader = document.getElementById("down-header");
//     var cart = document.getElementsByClassName("cart-right-panel").item(0);
//     var loginPanel = document.querySelectorAll(".login-panel").item(0);
//     var sticky = downHeader.offsetTop;
//
//     function checkSticky() {
//         if (window.pageYOffset >= sticky) {
//             downHeader.classList.add("sticky");
//             cart.classList.add("sticky")
//             loginPanel.classList.add("sticky");
//         } else {
//             downHeader.classList.remove("sticky");
//             cart.classList.remove("sticky");
//             loginPanel.classList.remove("sticky");
//         }
//     }
// });
function showSingUp(){

}




//animation gallery
document.addEventListener('DOMContentLoaded', () => {
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


    const smallGalleryItems = document.querySelectorAll('.gallery-home-small');
    const bigGalleryItems = document.querySelectorAll('#gallery-home-big');

    // const handleScroll = () => {
    //     const windowHeight = window.innerHeight;
    //     const revealPoint = 150;
    //
    //     smallGalleryItems.forEach(item => {
    //         const itemTop = item.getBoundingClientRect().top;
    //         if (itemTop < windowHeight - revealPoint) {
    //             item.classList.add('in-view');
    //         } else {
    //             item.classList.remove('in-view');
    //         }
    //     });
    //
    //     bigGalleryItems.forEach(item => {
    //         const itemTop = item.getBoundingClientRect().top;
    //         if (itemTop < windowHeight - revealPoint) {
    //             item.classList.add('in-view');
    //         } else {
    //             item.classList.remove('in-view');
    //         }
    //     });
    // };
    //
    // window.addEventListener('scroll', handleScroll);
    // handleScroll(); // Trigger the function initially in case elements are already in view
});
//animation gall
