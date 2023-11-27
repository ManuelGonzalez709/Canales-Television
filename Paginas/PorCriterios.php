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
if(isset($_POST["enviarCriterios"])){
    
    $contador = 0;
    require('../Funciones/funciones.php');
    $xml = DevolverXML();
    $Hora = $_POST["SelectorHora"];$CategoriaPadre = $_POST["CategoriaPadre"];

    $programasCanalCriterios = $xml->xpath("//programme[category[1] = \"".$CategoriaPadre."\"]");

    if($Hora != null){
        $Hora = devolverHora($Hora);
        echo "<div><br><table border= \"1\">";
        foreach($programasCanalCriterios as $datos){
             if(ComprobarHoraCriterios($datos["start"],$datos["stop"],$Hora)){
                echo "<tr><td>Titulo</td><td>Imagen</td><td>Hora Inicio</td><td>Hora Fin</td><td>Descripcion</td><td>Categoria</td><td>Canal Retrasmitido</td></tr>
                <tr><td>".$datos->title."</td>";
                if(isset($datos->icon["src"]))echo "<td><img src=\"".$datos->icon["src"]."\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
                else echo "<td><img src=\"../Imagenes/Sin_Foto.png\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
                echo "<td>".DevolverHoraBuena($datos["start"])."</td>
                <td>".DevolverHoraBuena($datos["stop"])."</td>
                <td>".DevolverDescripcion($datos->desc)."</td>
                <td>".$datos->category[0].">".$datos->category[1]."</td>
                <td>\"".$datos["channel"]."\"</td>
                </tr>";
                $contador++;
             }
        }echo "</table></div>";
    }else if($Hora == NULL)echo "<h1>No has seleccionado la hora correctamente</h1>";
    if($contador == 0) echo "<h1>No hay nada de la categoria '".$Categoria."' a las ".$_POST["SelectorHora"]."</h1>";
    
}
?>
<script>
    document.getElementById("VolverAtras").onclick = function (){
    window.open("../index.php","_self")
}
</script>
