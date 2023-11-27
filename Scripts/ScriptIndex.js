window.onload = function (){
    setInterval(MostrarHora,1000)
}
function MostrarHora(){
    fecha = new Date()
    document.getElementById("fecha_y_hora").innerHTML = fecha.getDate() +"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear()+"  "+fecha.getHours().toString().padStart(2,"0")+":"+fecha.getMinutes().toString().padStart(2,"0")+":"+fecha.getSeconds().toString().padStart(2,"0")
}
if(document.getElementById("Volver") != undefined){
    if(document.getElementById("Volver").onclick) window.open("../index.php","_self")
}

imagenes = document.getElementsByClassName("ImagenesIconos");
Array.from(imagenes).forEach(function(imagen) {
    imagen.addEventListener('click', function() {
        pagina = this.getAttribute('alt')
        paginabuena = pagina.replace('+','%2B'); //remplazamos el + por el %2B
        fetch('Paginas/IconoCanal.php', {
          method: 'GET',
          body: JSON.stringify(paginabuena)
        })
          window.open('Paginas/IconoCanal.php?datos=' + paginabuena, '_self');
      });
});



