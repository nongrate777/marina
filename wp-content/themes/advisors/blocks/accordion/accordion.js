import {slideHide, slideShow} from "../../sources/js/functions/slideBlock";

const accordion__question = document.querySelectorAll('.accordion__question');

accordion__question.forEach(el => {
    el.addEventListener('click', event => {
        event.preventDefault();

        const active = el.classList.contains('accordion__question_active');

        accordion__question.forEach(second => {
            const next = second.nextElementSibling;

            second.classList.remove('accordion__question_active');
            slideHide(next);
        });

        if(!active) {
            const next = el.nextElementSibling;

            el.classList.add('accordion__question_active');
            slideShow(next);
        }
    })
});
