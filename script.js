document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll(".slide");
    const arrows = document.querySelectorAll(".arrow");
    const paginationItems = document.querySelectorAll(".pagination .item");

    let currentSlide = 0;

    // Function to show a specific slide
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove("is-active");
            paginationItems[i].classList.remove("is-active");
        });

        slides[index].classList.add("is-active");
        paginationItems[index].classList.add("is-active");
        currentSlide = index;

        // Ensure the corresponding image is also shown
        const images = document.querySelectorAll(".image");
        images.forEach((image, i) => {
            if (i === index) {
                image.style.display = "block";
            } else {
                image.style.display = "none";
            }
        });
    }

    // Function to show next slide
    function nextSlide() {
        const nextIndex = (currentSlide + 1) % slides.length;
        showSlide(nextIndex);
    }

    // Function to show previous slide
    function prevSlide() {
        const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    // Auto play slideshow
    let slideshowInterval = setInterval(nextSlide, 5500); // Change slide every 5 seconds

    // Pause slideshow on hover
    document.querySelector(".slideshow").addEventListener("mouseenter", function() {
        clearInterval(slideshowInterval);
    });

    // Resume slideshow on mouse leave
    document.querySelector(".slideshow").addEventListener("mouseleave", function() {
        slideshowInterval = setInterval(nextSlide, 5000);
    });

    // Click event for next arrow
    arrows.forEach(arrow => {
        arrow.addEventListener("click", function() {
            if (this.classList.contains("next")) {
                nextSlide();
            } else if (this.classList.contains("prev")) {
                prevSlide();
            }
        });
    });


    paginationItems.forEach((item, index) => {
        item.addEventListener("click", function() {
            showSlide(index);
        });
    });
});
