import "./bootstrap";

import "../css/app.css";

import "bootstrap";

// Scroll to top button appear
document.addEventListener("scroll", function () {
    let scrollDistance = window.scrollY;
    let scrollToTopButton = document.querySelector(".scroll-to-top");
    if (scrollDistance > 100) {
        scrollToTopButton.style.display = "block";
    } else {
        scrollToTopButton.style.display = "none";
    }
});

// Smooth scrolling
document.addEventListener("click", function (e) {
    if (e.target.matches("a.scroll-to-top")) {
        e.preventDefault();
        let targetId = e.target.getAttribute("href");
        let targetElement = document.querySelector(targetId);
        window.scrollTo({
            top: targetElement.offsetTop,
            behavior: "smooth",
        });
    }
});
