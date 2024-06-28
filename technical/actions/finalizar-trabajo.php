<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__).'../../php/conexion_bd.php');

session_start();

if(!isset($_SESSION['usuario'])){
    session_destroy();
    header('Location: ../');
    exit();
} else if($_SESSION['tipo_cuenta'] != 'work'){
    header('Location: ../');
    exit();
}

if(!$_SESSION['jornada']){
    echo '
        <script>
            alert("No tienes una jornada activa");
        </script>
    ';
    header('Location: ../');
    exit();
}

if(!isset($_GET['id_trabajo'])){
    echo '
        <script>
            alert("No se ha seleccionado una solicitud");
        </script>
    ';
    header('Location: ../');
    exit;
}

if(!isset($_GET['monto'])){
    echo '
        <script>
            alert("No se ha seleccionado un monto");
        </script>
    ';
    header('Location: ../');
    exit;
}

$id_trabajo = $_GET['id_trabajo'];
$monto = $_GET['monto'];

if (!is_uploaded_file($_FILES['file-upload']['tmp_name'])){
    echo '
        <script>
            alert("No se ha seleccionado un archivo");
        </script>
    ';
    header('Location: ../');
    exit;
}

$archivo = mysqli_real_escape_string($conexion, file_get_contents($_FILES['file-upload']['tmp_name']));
$archivo = "'$archivo'";

$query_update = "UPDATE trabajo SET status = 1, evidencia = $archivo WHERE id_trabajo = $id_trabajo";
$success = mysqli_query($conexion, $query_update);

if ($success) {
    // Obtener id_jornada
    $id_usuario = $_SESSION['id'];
    $query_jornada = "SELECT id_jornada FROM jornadas_trabajo WHERE id_usuario = $id_usuario AND hora_fin IS NULL";
    $result_jornada = mysqli_query($conexion, $query_jornada);
    
    if ($result_jornada && mysqli_num_rows($result_jornada) > 0) {
        $row_jornada = mysqli_fetch_assoc($result_jornada);
        $id_jornada = $row_jornada['id_jornada'];
        
        // Insertar en nota_reporte
        $query_insert_nota = "INSERT INTO nota_reporte (id_jornada, id_trabajo, id_usuario,reposicion) VALUES ($id_jornada, $id_trabajo, $id_usuario,'no repuesto')";
        mysqli_query($conexion, $query_insert_nota);
    }

    $_SESSION['servicio'] = "none";

    // Obtener id_cliente desde la tabla solicitudes
    $query_cliente = "SELECT s.id_cliente FROM solicitudes s JOIN trabajo t ON s.id_solicitud = t.id_solicitud WHERE t.id_trabajo = $id_trabajo";
    $result_cliente = mysqli_query($conexion, $query_cliente);
    $cliente = mysqli_fetch_assoc($result_cliente);
    $id_cliente = $cliente['id_cliente'];

    $query_insert_pago = "INSERT INTO pagos (fecha_pago, hora_pago, monto, id_trabajo, status,id_usuario) VALUES (CURDATE(), CURTIME(), $monto, $id_trabajo, 0,$id_cliente)";
    mysqli_query($conexion, $query_insert_pago);

    header('Location: ../');
    exit();
} else {
    echo '
        <script>
            alert("Hubo un error al actualizar el trabajo");
        </script>
    ';
    header('Location: ../');
    exit();
}
?>
