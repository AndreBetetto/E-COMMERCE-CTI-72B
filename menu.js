function abrirMenu(){
    document.getElementById('menu').style.width = "250px";
}

function fecharMenu(){
    document.getElementById('menu').style.width = "0px";
}

document.querySelector('.menu-trigger').onclick = () => {
    document.querySelector('.menu-menu').style.display == 'none' ? 'block' : 'none';
}

function abreMenuzinho(){
    document.getElementById('menu-menu').style.display = "block";
}