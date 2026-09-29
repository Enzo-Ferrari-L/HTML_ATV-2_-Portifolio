<?php
// 1. A lógica de processamento em PHP precisa ser executada antes da renderização do HTML
$mensagem = "";

// Checa se existe a confirmação de sucesso nos parâmetros da requisição GET (pós-redirecionamento)
if (isset($_GET['status']) && $_GET['status'] === 'sucesso') {
    $mensagem = "<p style='color: darkgreen;'>Produto cadastrado com sucesso!</p>";
}

// Confirma se as informações foram enviadas via método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém os dados e remove espaços em branco nas extremidades dos textos
    $nome_produto = trim($_POST["nome_produto"] ?? '');
    $preco = trim($_POST["preco"] ?? '');

    // Checa no servidor se ambos os campos foram devidamente preenchidos
    if (!empty($nome_produto) && !empty($preco)) {
        $servername = "localhost";
        $username = "root";
        $password = "Senai@118";
        $dbname = "exercicio";

        // Inicializa a conexão com a base de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Valida se a conexão foi estabelecida sem falhas
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Emprega Prepared Statement para mitigar riscos de SQL Injection
        $stmt = $conn->prepare("INSERT INTO produtos (nome, preco) VALUES (?, ?)");
        $stmt->bind_param("sd", $nome_produto, $preco);

        if ($stmt->execute()) {
            // Finaliza as conexões abertas antes de efetuar o redirecionamento
            $stmt->close();
            $conn->close();

            // Redireciona para a própria página via GET (evita o reenvio acidental do POST)
            header("Location: " . $_SERVER['PHP_SELF'] . "?status=sucesso");
            exit();
        } else {
            $mensagem = "<p style='color: red;'>Erro ao cadastrar no banco de dados.</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        $mensagem = "<p style='color: red;'>Por favor, preencha todos os campos!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
</head>
<body>

    <h1>Cadastro de Produtos</h1>

    <!-- Apresenta o feedback de resposta ao usuário (sucesso ou falha) -->
    <?php if (!empty($mensagem)) { echo $mensagem; } ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="nome_produto">Nome do Produto: </label><br>
        <input type="text" id="nome_produto" name="nome_produto" required><br><br>

        <label for="preco">Preço: </label><br>
        <input type="number" id="preco" name="preco" step="0.01" min="0.01" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>