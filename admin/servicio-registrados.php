<?php 
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';


$sql="SELECT fecha_registro, COUNT(*) AS resultado FROM registrados GROUP BY DATE(fecha_registro) ORDER BY fecha_registro ";
$resultado = $conn->query($sql);
$arreglo_registro = array();
while ($registro_dia = $resultado->fetch_assoc()) {
    $fecha = $registro_dia['fecha_registro'];
    // movemos la fecha del while a FECHA
    $registro['fecha'] =  date('Y-m-d', strtotime($fecha));
    // creamos arreglo $registro['fecha'] y le introducimos la fecha formateada del arreglo $fecha
    $registro['cantidad'] = $registro_dia['resultado'];
    // agregamos la canitad al $registro que tenia el while
    $arreglo_registro[] = $registro;
}
echo json_encode($arreglo_registro);

?>


