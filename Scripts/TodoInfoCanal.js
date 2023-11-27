window.onload =function BuscarClick(){
    filasDatos = document.getElementsByClassName("Titulo")
    Array.from(filasDatos).forEach(function(dato) {

    dato.addEventListener('click', function() {
    fetch('InfoPrograma.php', {
      method: 'GET',
      body: JSON.stringify(this.innerText)
    })
      window.open('InfoPrograma.php?Programa=' + this.innerText, '_self');
  });
});
}
