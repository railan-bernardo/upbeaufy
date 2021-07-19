//prevenir
const debounce = function (func, wait, immediate) {
    let timeout;
    return function (...args) {
        const context = this;
        const later = function (params) {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);

        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

const target = document.querySelectorAll('[data-anime]');
const animateClass = 'anime';

function animateScroll() {

    const windowTop = window.pageYOffset + ((window.innerHeight * 3) / 4);
    target.forEach(function (element) {
        if ((windowTop) > element.offsetTop) {
            element.classList.add(animateClass);
        } else {
            element.classList.remove(animateClass);
        }
    });
}

animateScroll();

if (target.length) {
    window.addEventListener('scroll', debounce(function () {
        animateScroll();
    }, 200));
}