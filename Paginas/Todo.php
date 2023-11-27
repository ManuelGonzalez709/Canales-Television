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
    $xml = DevolverXML(); $img ;
        echo "<div><br><table border = \"1\">";
        foreach($xml->channel as $datosMostrar){
            echo "<tr><td>Canal</td><td>Imagen</td><td>Programas</td></tr>";
            echo 
                "<tr>
                    <td>".$datosMostrar['id'].
                "</td>";
            if(isset($datosMostrar->icon['src'])){
                echo 
                "<td>
                    <img src=".$datosMostrar->icon['src']." alt=".$datosMostrar['id']." width=\"200px\">
                </td>";
                $img = $datosMostrar->icon['src'];
            }
            else {
                echo
                    "<td>
                        <img src=".$img." alt=".$datosMostrar['id']." width=\"200px\">
                    </td>";
            }
            MostrarProgramas($xml,$datosMostrar['id']);
        }
        echo "</table></div>"; // al terminar todo cierro la tabla
    function MostrarProgramas($xml,$nombreCanal){
        $programas = $xml->xpath("//programme[@channel='$nombreCanal']"); 
        if(isset($programas)){
            echo "<td><div class=\"Programas\"><table border = \"1\">"; 
            echo "<tr class=\"Cabecera_Programas\"><td>Nombre</td><td>Hora Inicio</td><td>Hora Fin</td><td>CACIT</td><td>Descripcion</td></tr>"; 
            foreach($programas as $datos){
                if(verDia($datos["start"]))
                    echo 
                    "<tr>
                        <td class=\"Titulo\">".$datos->title."</td><td>".DevolverHoraBuena($datos["start"])."</td>
                        <td>".DevolverHoraBuena($datos["stop"])."</td>
                        <td>".DevolverCACIT($datos->desc)."</td>
                        <td>".DevolverDescripcion($datos->desc)."</td>
                    </tr>";
            }
            echo "</td></table></div>"; 
            // cierro el tr abierto , cierro la tabla y cierro el div
        }
    }
?>
<script>
    document.getElementById("VolverAtras").onclick = function (){
    window.open("../index.php","_self")
}
</script>
<script src="../Scripts/TodoInfoCanal.js"></script>