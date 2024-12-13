<?php

require_once 'conexao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $email = $_POST['email'];
    $usuario = $_POST['user'];


    if (empty($email) || empty($usuario)) {
     
        header("Location: login.html?erro=preencha");
        exit;
    }

    // Conecta ao banco de dados
    $conn = get_connection();

    
    $sql = "SELECT * FROM usuarios WHERE email = ? AND usuario = ?";
    $stmt = $conn->prepare($sql);

   
    if ($stmt) {
        $stmt->bind_param("ss", $email, $usuario); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 

   
        if ($result->num_rows > 0) {
          
            header("Location: down.html");
            exit;
        } else {
        
            header("Location: login.html?erro=credenciais");
            exit;
        }

   
        $stmt->close();
    } else {
        
        echo "Erro ao preparar consulta: " . $conn->error;
    }

    
    $conn->close();
}
?>
