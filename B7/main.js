/**
 * YOUR CODE GOES HERE
 */

const box = document.getElementById('demo');
const boxWrapper = document.querySelector('.boxWrapper');
let intervalId;
let padding = 1;
let paddingIncrease = 2;
let mouseX;

box.addEventListener('mouseenter', (ev) => {
    mouseX = ev.x;
    intervalId = setInterval(() => {
        changePadding()
    }, 1)
})
box.addEventListener('mousemove', (ev) => {
    mouseX = ev.x;
})
box.addEventListener('mouseout', () => {
    clearInterval(intervalId)
})

function changePadding() {
    if (mouseX > 310) {
        padding -= paddingIncrease;
        if(padding < -2300){
            padding = -2300;
        }
        boxWrapper.style.marginLeft = padding + 'px';
    } else {
        padding += paddingIncrease;
        if(padding > 0){
            padding = 0;
        }
        boxWrapper.style.marginLeft = padding + 'px';
    }
}
