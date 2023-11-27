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
    <button id = "VolverAtras">Volver</button>
</body>
</html>
<?php
    require('../Funciones/funciones.php');
    if(isset($_GET["Programa"])){
        $xml = DevolverXML();
        // comprobamos el espacio
        $programas = $xml->xpath("//programme[title = \"".$_GET["Programa"]." \"]"); 
        if(sizeof($programas)==0)$programas = $xml->xpath("//programme[title = \"".$_GET["Programa"]."\"]"); 
        if(sizeof($programas)>0){
            echo "<div><br><table border = \"1\">";
            foreach($programas as $datos){
                    if(isset($datos->icon["src"])){
                    echo "<tr><td>Titulo</td><td>Imagen</td><td>Hora Inicio</td><td>Hora Fin</td><td>Fecha</td><td>Cacit</td><td>Categoria</td><td>Descripcion</td><td>Canal Retrasmitido</td><td>Estrellas</td></tr>
                    <tr><td>".$datos->title."</td>";
                    echo "<td><img src=\"".$datos->icon["src"]."\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
                    echo "<td>".DevolverHoraBuena($datos["start"])."</td>
                    <td>".DevolverHoraBuena($datos["stop"])."</td>
                    <td>".DevolverFecha($datos["start"])."</td>
                    <td>".DevolverCACIT($datos->desc)."</td>
                    <td>".$datos->category[0].">".$datos->category[1]."</td>
                    <td>".DevolverDescripcion($datos->desc)."</td>
                    <td>\"".$datos["channel"]."\"</td>";    
                    $estrellas = $datos -> {'star-rating'};    
                    if(isset($estrellas))echo "<td class=\"Estrellas\">".$estrellas->value."</td>";
                    else echo "<td>Sin estrellas definidas</td>";
                    echo"</tr>";
                }
                
            }
            echo "</table></div>";
        }else echo "Sin informacion Disponible";
    }
?>
<script>
    document.getElementById("VolverAtras").onclick =function(){
        window.open("Todo.php","_self")
    }

</script>
<script>
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
  ctx.font = '40px Arial';
  if(numeroEstrella == 1){
      ctx.fillStyle = 'Yellow'
      ctx.fillText('★', ultimaPosicion, 80);
      ctx.fill();
  }else{
      ctx.strokeStyle = 'purple'
      ctx.strokeText('★', ultimaPosicion, 80);
  }
  ctx.closePath()
  return ultimaPosicion+60;
}



</script>