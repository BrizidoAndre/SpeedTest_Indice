/**
 * YOUR CODE GOES HERE
 */

const titles = document.querySelectorAll('h1');
titles.forEach(t => {
    let letters = t.innerText.split('');
    t.innerHTML = '';
    letters.forEach((letter, index) => {
        let transition = index * .1;
        let opacityTransition = index * .12;
        t.innerHTML += `<div style="transition-delay: ${transition}s" class="container-letter"><span class='animation top' style="transition-delay: ${opacityTransition}s">${letter}</span><span class='animation bottom' style="transition-delay: ${opacityTransition}s">${letter}</span><span class='reference'>${letter}</span></div>`
    })
    t.addEventListener('mouseenter', () => {
        let containerLetters = t.querySelectorAll('.container-letter');
        containerLetters.forEach((cont, index) => {
            let transition = index * .1;
            cont.style.transitionDelay = `${transition}s`
        })
    })
    t.addEventListener('mouseout', () => {
        let containerLetters = t.querySelectorAll('.container-letter');
        containerLetters.forEach((cont, index) => {
            let max = containerLetters.length;
            let transition = (max - index) * .1;
            cont.style.transitionDelay = `${transition}s`
        })
    })
})

