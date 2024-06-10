<?php
    $conexion=mysqli

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Datos</title>
</head>
<body>

    <br>

    <table>
        <tr>    
            <td>id</td>
            <td>nombre</td>
            <td>modelo</td>
            <td>marca</td>
            <td>Medidas</td>
            <td>stock</td>
        </tr>

        <?php
        $sql="SELECT * from almacen";
        $result=mysqli_query($conexion,$sql);

        while($mostrar=mysqli_fetch_array($result)){

        }
        
        ?>

        <tr>
            <td>?php echo $mostrar['id'] ?</td>
            <td>?php echo $mostrar['nombre'] ?</td>
            <td>?php echo $mostrar['modelo'] ?</td>
            <td>?php echo $mostrar['marca'] ?</td>
            <td>?php echo $mostrar['Medidas'] ?</td>
            <td>?php echo $mostrar['stock'] ?</td>
        </tr>
    </table>

</body>
</html>