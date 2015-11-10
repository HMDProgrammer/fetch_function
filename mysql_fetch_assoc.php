<?php
$connect = mysql_connect("localhost", "username", "password");

if (!$connect) {
    echo "Nepareizi ievadīta DB dati: " . mysql_error();
    exit;
}

if (!mysql_select_db("datubāze")) {
    echo "Nav atrasta datubāze, kas tika norādīta: " . mysql_error();
    exit;
}

$sql = "SELECT id as id_user, nombre_completo, estatus_usuario
        FROM   alguna_tabla
        WHERE  estatus_usuario = 1";

$resultado = mysql_query($sql);

if (!$resultado) {
    echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
    exit;
}

if (mysql_num_rows($resultado) == 0) {
    echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
    exit;
}

// Mientras exista una fila de datos, colocar esa fila en $fila como un array asociativo
// Nota: Si solo espera una fila, no hay necesidad de usar un bucle
// Nota: Si coloca extract($fila); dentro del siguiente bucle,
//       estará creando $id_usuario, $nombre_completo, y $estatus_usuario
while ($fila = mysql_fetch_assoc($resultado)) {
    echo $fila["id_usuario"];
    echo $fila["nombre_completo"];
    echo $fila["estatus_usuario"];
}

mysql_free_result($resultado);
?>
