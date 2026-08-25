<?php
// Inclui o arquivo de conexão
include('conectar.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos obrigatórios foram preenchidos
    if (!empty($_POST['name']) && !empty($_POST['question1']) && !empty($_POST['question2']) && !empty($_POST['question3'])) {

        // Sanitiza e coleta os dados do formulário
        $name = mysqli_real_escape_string($conexao, $_POST['name']);
        $question1 = mysqli_real_escape_string($conexao, $_POST['question1']);
        $question2 = mysqli_real_escape_string($conexao, $_POST['question2']);
        $question3 = mysqli_real_escape_string($conexao, $_POST['question3']);

        // Prepara a query de inserção
        $query = "INSERT INTO tbmenu (Email, Mais, Menos, Opiniao) VALUES ('$name', '$question1', '$question2', '$question3')";

        // Executa a query e verifica se a inserção foi bem-sucedida
        if (mysqli_query($conexao, $query)) {
            // Redireciona de volta para feedback.html com um parâmetro de sucesso
            header("Location: feedback.html?enviado=sim");
            exit;
        } else {
            echo "Erro ao inserir feedback: " . mysqli_error($conexao);
        }

    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
