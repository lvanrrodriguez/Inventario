<?php
// Verificar si se han recibido las variables 'producto' y 'stock'
if(isset($_POST['producto']) && isset($_POST['stock'])){
    $producto = $_POST['producto'];
    $stock = $_POST['stock'];

    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'ControlStock');

    // Verificar la conexión
    if(!$conn){
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Consulta para insertar el nuevo producto y su stock en la tabla 'productos'
    $sql_insert_producto = "INSERT INTO productos (producto, stock) VALUES ('$producto', '$stock')";

    // Consulta para insertar el nuevo producto y su stock en la tabla 'historial_agregados'
    $sql_insert_historial = "INSERT INTO historial_agregados (producto, stock) VALUES ('$producto', '$stock')";

    // Ejecutar ambas consultas
    if(mysqli_query($conn, $sql_insert_producto) && mysqli_query($conn, $sql_insert_historial)){
        // Éxito: Redirigir al usuario a la página principal
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql_insert_producto . "<br>" . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    echo "No se han recibido las variables 'producto' y 'stock'";
}
?>


