/* YOUR CODE HERE */

const turbulence = document.getElementById('turbulency');
let turX = 0.01;
let turAdd = .0000003;

function waterEffect() {
    turX += turAdd;
    if (turX > 0.05 || turX < 0.01) {
        turAdd *= -1;
    }
    turbulence.setAttribute('baseFrequency', `${turX} 0.02`)
    requestAnimationFrame(waterEffect)
}

waterEffect()
