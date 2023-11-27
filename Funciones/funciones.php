<?php
//generales
function DevolverXML(){
    return simplexml_load_file("https://raw.githubusercontent.com/dracohe/CARLOS/master/guide_IPTV.xml");
}
function verDia($hora){
    if(intval(substr($hora,6,2)) == intval(date('d'))){
        return true; 
    }else return false;
}
function ComprobarHoraBuena($horaInicio,$HoraFin){
    $Fecha = date('Y').date('m').date('d').date('H').date('i').date('s');
    $horaInicio = explode(" +",$horaInicio);
    $HoraFin = explode(" +",$HoraFin);
    if($Fecha>=$horaInicio[0] && $Fecha<=$HoraFin[0])return true;
    else return false;
}
function DevolverDescripcion($Datos){
    $datoArray = explode("Argumento: ",$Datos);
    if(isset($datoArray[1])){
        $recortarDescripcion = explode(".",$datoArray[1]);
        return $recortarDescripcion[0];
    }else return "Sin descripcion";
}

function DevolverCACIT($datos){
    $CadenaFinal = explode("+",$datos);
    if(sizeof($CadenaFinal)>1)return "+".substr($CadenaFinal[1],0,2);
    return "Indefined";
}
function DevolverFecha($hora){
    return substr( $hora,6,2)."/".substr( $hora,4,2)."/".substr( $hora,0,4);
}
function DevolverHoraBuena($hora){
   /* $año = substr( $hora,0,4);
    $mes = substr( $hora,4,2);
    $dia = substr( $hora,6,2);*/
    $horas = substr( $hora,8,2);
    $minutos = substr( $hora,10,2);
    $segundos = substr( $hora,12,2);
    return $horas.":".$minutos.":".$segundos;
}
// de la pagina por criterios
function ComprobarHoraCriterios($horaInicio,$HoraFin,$Fecha){ // pasada la hora actual ver si esta en los rangoss
    $horaInicio = explode(" +",$horaInicio);
    $HoraFin = explode(" +",$HoraFin);
    if($Fecha>=$horaInicio[0] && $Fecha<=$HoraFin[0])return true;
    else return false;
}
function devolverHora($hora){// pasada la hora actual devuelve la hora en forma de string
    $hora = explode(":",$hora);
    $Fecha = date('Y').date('m').date('d').$hora[0].$hora[1]."00";
    return $Fecha;
}

?>