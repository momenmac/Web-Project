let slideIndex = 1;
let slideInterval;

document.addEventListener("DOMContentLoaded", function() {
    showSlides(slideIndex);
    slideInterval = setInterval(function() {
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
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    slides[slideIndex - 1].style.display = "block";

    // Add "active" class to the corresponding dot in this slide's dot container
    let dots = dotsContainers[slideIndex - 1].getElementsByClassName("dot");
    dots[slideIndex - 1].classList.add("active");
}



const slideshowContainer = document.querySelector('.slideshow-container');

slideshowContainer.addEventListener('mouseenter', function() {
    clearInterval(slideInterval);
});

slideshowContainer.addEventListener('mouseleave', function() {
    slideInterval = setInterval(function() {
        plusSlides(1);
    }, 4000);
});
