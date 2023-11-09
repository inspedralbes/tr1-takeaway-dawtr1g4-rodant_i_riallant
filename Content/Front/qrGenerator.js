<<<<<<< HEAD
const wrapper = document.querySelector(".wrapper"),
generateBtn = wrapper.querySelector(".form button"),
qrImg = wrapper.querySelector(".qr-code img");
let preValue;
document.getElementById("botonQr").addEventListener("click", () => {
    let qrValue = "http://rirtr1g4.daw.inspedralbes.cat/Front/"
    if(!qrValue || preValue === qrValue) return;
    preValue = qrValue;
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=${qrValue}`;
});
=======
// const wrapper = document.querySelector(".wrapper"),
// generateBtn = wrapper.querySelector(".form button"),
// qrImg = wrapper.querySelector(".qr-code img");
// let preValue;
// document.getElementById("botonQr").addEventListener("click", () => {
//     let qrValue = "http://rirtr1g4.daw.inspedralbes.cat/Front/"
//     if(!qrValue || preValue === qrValue) return;
//     preValue = qrValue;
//     qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
// });
>>>>>>> 1b6354b77991b998b748e7b248e36444b9b08fd6
