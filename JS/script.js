const logo = document.getElementById("logo");
let currentPosition = window.innerWidth; // Mulai dari posisi luar layar sebelah kanan

function moveLogo() {
    currentPosition--;
    logo.style.left = currentPosition + "px";

    if (currentPosition < -logo.width) {
        currentPosition = window.innerWidth; // Kembali ke posisi luar layar sebelah kanan
    }

    requestAnimationFrame(moveLogo);
}

moveLogo();
