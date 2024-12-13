<?php

require_once 'conexao.php';


$usuario = $_POST['usuario'];
$email = $_POST['email'];


if (!empty($usuario) && !empty($email)) {
    // Obtém a conexão com o banco
    $conn = get_connection();

   
    $sql = "INSERT INTO usuarios (usuario, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $usuario, $email);

        if ($stmt->execute()) {
          
            header("Location: login.html");
            exit();
        } else {
            echo "<h1>Erro ao criar conta: " . $stmt->error . "</h1>";
        }

        // Fecha o statement
        $stmt->close();
    } else {
        echo "<h1>Erro ao preparar consulta: " . $conn->error . "</h1>";
    }

    // Fecha a conexão
    $conn->close();
} else {
 
    exit();
}
?>
