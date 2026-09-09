import './bootstrap';
import Alpine from 'alpinejs';
import { initAdminNavigation } from './admin-navigation';

window.Alpine = Alpine;

Alpine.start();

// Initialize Admin Seamless Navigation
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initAdminNavigation());
} else {
    initAdminNavigation();
}

// Intersection Observer for scroll animations
document.addEventListener("DOMContentLoaded", () => {
    const observerOptions = {
        root: null,
        rootMargin: "0px -50px", // triggers slightly before entering viewport fully
        threshold: 0.05
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("reveal-active");
                observer.unobserve(entry.target); // trigger animation only once
            }
        });
    }, observerOptions);

    const revealElements = document.querySelectorAll(".reveal");
    revealElements.forEach(el => observer.observe(el));
});
