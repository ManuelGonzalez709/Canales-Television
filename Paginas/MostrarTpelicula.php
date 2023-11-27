<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/style.css">
    <title>Document</title>
</head>
<body>
    <button id="VolverAtras">Volver Atras</button>
</body>
</html>
<?php
   require('../Funciones/funciones.php');
   $xml = DevolverXML(); 
   $programas = $xml->xpath("//programme[category[text() ='Cine' or text() = 'Telefilm']]"); 
   echo "<div><table border=\"1\"><br>";
   foreach($programas as $datos){
    if(ComprobarHoraBuena($datos["start"],$datos["stop"]) && verDia($datos["start"])){
        echo "<tr><td>Titulo</td><td>Imagen</td><td>Hora Inicio</td><td>Hora Fin</td><td>Descripcion</td><td>Canal Retrasmitido</td><td>Estrellas</td></tr>
        <tr><td>".$datos->title."</td>";
        if(isset($datos->icon["src"]))echo "<td><img src=\"".$datos->icon["src"]."\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
        else echo "<td><img src=\"../Imagenes/Sin_Foto.png\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
        echo "<td>".DevolverHoraBuena($datos["start"])."</td>
        <td>".DevolverHoraBuena($datos["stop"])."</td>
        <td>".DevolverDescripcion($datos->desc)."</td>
        <td>\"".$datos["channel"]."\"</td>";    
        $estrellas = $datos -> {'star-rating'};    
        if(isset($estrellas))echo "<td class=\"Estrellas\">".$estrellas->value."</td>";
        else echo "<td>Sin estrellas definidas</td>";
        echo"</tr>";
        }
   }

   echo "</div></table>";
?>



<script>
document.getElementById("VolverAtras").onclick = function (){
    window.open("../index.php","_self")
}
window.onload = function(){
    totalEstrellas = document.getElementsByClassName("Estrellas")
    for(i = 0; i < totalEstrellas.length;i++){
        estrellas = document.getElementsByClassName("Estrellas")[i].innerText
        document.getElementsByClassName("Estrellas")[i].innerHTML = "<canvas></canvas>";
        DibujarCanvas(estrellas,i)
    }
}
function DibujarCanvas(estrellas , NumeroCanvas){
    canvas = document.getElementsByTagName("canvas")[NumeroCanvas];
    ultimaPosicion = 1;
    for(a = 0; a<estrellas.length;a++){
        codigoEstrella = estrellas.charCodeAt(a)
        if(codigoEstrella == 9733){
            ultimaPosicion = DibujarEstrella(canvas,ultimaPosicion,1)
        }else ultimaPosicion = DibujarEstrella(canvas,ultimaPosicion,2)
    }
}
function DibujarEstrella(canvas,ultimaPosicion,numeroEstrella){
    ctx = canvas.getContext("2d");
    // Dibujar una estrella en el canvas
    ctx.beginPath();
    ctx.lineWidth = 2;
    ctx.font = '40px Arial';
    if(numeroEstrella == 1){
        ctx.fillStyle = 'Yellow'
        ctx.fillText('★', ultimaPosicion, 80);
        ctx.fill();
    }else{
        ctx.strokeStyle = 'pink'
        ctx.strokeText('★', ultimaPosicion, 80);
    }
    ctx.closePath()
    return ultimaPosicion+60;
    
}
</script>