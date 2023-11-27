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
    <button id="VolverAtras">Volver</button>
</body>
</html>
<?php
$NombreCanal = $_GET["datos"];
echo "<h1>Canal ".$NombreCanal."</h1>";
require('../Funciones/funciones.php');
    $xml = DevolverXML();
    $programas = $xml->xpath("//programme[@channel=\"".$NombreCanal."\"]"); 
    echo "<div><table border=\"1\">";
    foreach($programas as $datos){
        if(verDia($datos["start"])){
            echo "<tr class=\"Cabeceras_tablas\"><td>Titulo</td><td>Imagen</td><td>Hora Inicio</td><td>Hora Fin</td><td>Descripcion</td></tr>
            <tr><td>".$datos->title."</td>";
            if(isset($datos->icon["src"]))echo "<td><img src=\"".$datos->icon["src"]."\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
            else echo "<td><img src=\"Imagenes/Sin_Foto.png\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
            echo "<td>".DevolverHoraBuena($datos["start"])."</td>
            <td>".DevolverHoraBuena($datos["stop"])."</td>
            <td>".DevolverDescripcion($datos->desc)."</td>";
            echo "</tr>";
        }
    }
    echo "</table></div>";

?>
<script>
    document.getElementById("VolverAtras").onclick = function (){
    window.open("../index.php","_self")
}
</script>