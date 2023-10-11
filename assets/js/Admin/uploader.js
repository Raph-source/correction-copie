let clocDiv = document.querySelector('.click-div');
let fileIpnput = document.querySelector('.fileInput');
let divListFile = document.querySelector('.file-list');

let spanFile = document.querySelector('.nameFile')
clocDiv.addEventListener('click',function () {
    fileIpnput.click()
})
fileIpnput.onchange = ({target}) =>{
    let file = target.files[0];
    spanFile.textContent = file.name;
    divListFile.classList.toggle('file-list-visible')
    
}