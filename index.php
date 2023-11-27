<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Document</title>
</head>
<body>
    <p id="fecha_y_hora"></p>
    <div class="Menu">
        <button id="Mostrar_todos">Mostrar Todos Los Datos</button>
        <button id="MostrarPeliculasAhora">Peliculas de Ahora</button>
        <form action="./Paginas/PorCriterios.php" method="post">
            <h3>Por criterios</h3>
            <label for="CategoriaPadre">Seleccionar Tipo</label>
            <select name="CategoriaPadre">
            <?php // categoria padre
                require('Funciones/funciones.php');
                $xml = DevolverXML(); 
                $categoriaPadre = array_unique($xml->xpath("//category[1]"));
                foreach ($categoriaPadre as $datos)echo "<option value=".$datos.">".$datos."</option>";
            ?>
            </select>
            <label for="SelectorHora">Seleccionar Hora</label>
            <input type="time" name="SelectorHora" min = 0 max = 24>
            <input type="submit" name="enviarCriterios">
        </form>
    </div>
</body>
</html>
<?php
// muestro todos los canales de television
    $imagen;
    echo "<div class=\"Pagina_Principal\">";
    foreach($xml->channel as $datos){
            echo "<div class=\"Imagen\">";
            if(isset($datos->icon['src'])){
                echo "<img class=\"ImagenesIconos\" src=".$datos->icon['src']." alt=\"".$datos['id']."\">";
                $imagen = $datos->icon['src'];
            }else echo "<img class=\"ImagenesIconos\" src=".$imagen." alt=\"".$datos['id']."\">";
            echo "<form action=\"index.php\" method=\"post\" > 
                <input class=\"Texto_Imagen\" type=\"submit\" value=\"".$datos['id']."\" name=\"nombre_canal\">
            </form>
            </div>";
        }    
    echo "</div><br>";

    $imagen;$NombreCanal;
    if(isset($_POST["nombre_canal"])){ // si hago click en un canal sin javaScript

        $NombreCanal = $_POST["nombre_canal"];
        $programas = $xml->xpath("//programme[@channel=\"".$NombreCanal."\"]"); 
        echo "<br><button id=\"VolverAtras\">Volver atras</button>"; // volver atras
        echo  "<h3>En retrasmision...</h3>";$contador = 0;
        foreach($programas as $datos){
        if(verDia($datos["start"])){
            if(ComprobarHoraBuena($datos["start"],$datos["stop"])){
                echo "<div class = \"ProgramaEnDirecto\"><table border=\"1\"><tr><td>Imagen</td><td>Nombre</td><td>Hora Inicio</td><td>Hora Fin</td><td>Progreso</td></tr>";
                if(isset($datos->icon["src"]))echo "<tr><td><img src=\"".$datos->icon["src"]."\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
                else echo "<tr><td><img src=\"Imagenes/Sin_Foto.png\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
                echo "<td>".$datos->title."</td>
                <td>".DevolverHoraBuena($datos["start"])."</td>   
                <td>".DevolverHoraBuena($datos["stop"])."</td>";

                $horaInicio = explode(" +",$datos["start"]);
                $horaFin = explode(" +",$datos["stop"]);

                echo "<td>
                    <progress  min= '0' max=".$horaFin[0]-$horaInicio[0]." value=".devolverHora(date('H').":".date('i'))-$horaInicio[0]."></progress>
                </td>
                </table></div>";
            }
        }
    }
        
        echo "<div class=\"tabla1\"><table border=\"1\">";
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
        }echo "</table></div>";


    }else { // pagina prinncipal
        $programas = $xml->xpath("//programme"); 
        echo "<div><table border=\"1\">";
        foreach($programas as $datos){
            if(ComprobarHoraBuena($datos["start"],$datos["stop"]) && verDia($datos["start"])){
                echo "<tr><td>Titulo</td><td>Imagen</td><td>Hora Inicio</td><td>Hora Fin</td><td>Descripcion</td><td>Canal Retrasmitido</td></tr>
                <tr><td>".$datos->title."</td>";
                if(isset($datos->icon["src"]))echo "<td><img src=\"".$datos->icon["src"]."\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
                else echo "<td><img src=\"../Imagenes/Sin_Foto.png\" alt=\"".$datos->title ."\" width = \"120px\"></td>";
                echo "<td>".DevolverHoraBuena($datos["start"])."</td>
                <td>".DevolverHoraBuena($datos["stop"])."</td>
                <td>".DevolverDescripcion($datos->desc)."</td>
                <td>\"".$datos["channel"]."\"</td>
                </tr>";
        }
    }
    echo "</div></table>";
}
    
?>
<script src="./Scripts/ScriptIndex.js"></script>
<script>    
document.getElementById("Mostrar_todos").onclick = function Mostar_Datos(){
        window.open("Paginas/Todo.php","_self")
    }
document.getElementById("MostrarPeliculasAhora").onclick = function(){
     window.open("Paginas/MostrarTpelicula.php","_self")
    }
document.getElementById("VolverAtras").onclick = function (){
    window.open("index.php","_self")
}
</script>
