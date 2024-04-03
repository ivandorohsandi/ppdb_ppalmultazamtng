document.addEventListener("DOMContentLoaded", function () {
    // Jalankan animasi otomatis ketika halaman dimuat
    animateCounter("guru");
    animateCounter("santri");
    animateCounter("alumni");
});

let guru = 0;
let santri = 0;
let alumni = 0;
let animationFrame;
let animationFrame2;
let animationFrame3;

function updateCounter(elementId, value) {
    const counterElement = document.getElementById(elementId);
    counterElement.textContent = value;
}

function animateCounter(elementId) {
    if (elementId === "guru" && guru < 60) {
        guru += 1;
        updateCounter(elementId, guru);
        animationFrame = requestAnimationFrame(() => animateCounter(elementId));
    } else if (elementId === "santri" && santri < 1350) {
        santri += 10;
        updateCounter(elementId, santri);
        animationFrame2 = requestAnimationFrame(() => animateCounter(elementId));
    }
    else if(elementId === "alumni" && alumni < 9900){
        alumni +=50;
        updateCounter(elementId, alumni);
        animationFrame3 = requestAnimationFrame(() => animateCounter(elementId));
    }
}

let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides((slideIndex += n));
    }

    function currentSlide(n) {
      showSlides((slideIndex = n));
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("video-yt");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {
        slideIndex = 1;
      }
      if (n < 1) {
        slideIndex = slides.length;
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }