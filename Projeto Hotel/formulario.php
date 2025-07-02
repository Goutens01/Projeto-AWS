<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$valida = false;


$conn = new mysqli("db-projeto-hotel.cq56pxdmv295.us-east-1.rds.amazonaws.com", "admin", "19672004", "HotelDB");


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtém o tipo do quarto via GET
$tipoQuarto = isset($_GET['tipo']) ? htmlspecialchars($_GET['tipo']) : 'Não especificado';

// Função para contar os quartos disponíveis
function contarQuartosDisponiveis($tipoQuarto, $conn) {
    $query = "SELECT COUNT(*) AS disponiveis FROM quarto WHERE TIPO = ? AND STATUS = 'LIVRE'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tipoQuarto);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    return $dados['disponiveis'];
}

// Verifica a disponibilidade de quartos
$quartosDisponiveis = contarQuartosDisponiveis($tipoQuarto, $conn);

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(strlen(htmlspecialchars($_POST['cpf'])) == 11){
        $valida = true;
        echo "<script>alert('Coloque um CPF com Tamanho válido!');</script>";
    }
    









    if($valida == true){

    $nome = htmlspecialchars($_POST['nome']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $nascimento = htmlspecialchars($_POST['nascimento']);
    $email = htmlspecialchars($_POST['email']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $checkin = htmlspecialchars($_POST['checkin']);
    $checkout = htmlspecialchars($_POST['checkout']);

    // Verifica novamente a disponibilidade antes de reservar
    $queryQuartoLivre = "SELECT ID_QUARTO FROM quarto WHERE TIPO = ? AND STATUS = 'LIVRE' LIMIT 1";
    $stmt = $conn->prepare($queryQuartoLivre);
    $stmt->bind_param("s", $tipoQuarto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $quarto = $result->fetch_assoc();
        $idQuarto = $quarto['ID_QUARTO'];

        // Insere a reserva na tabela
        $queryReserva = "INSERT INTO reserva (ID_QUARTO, DT_CHECKIN, DT_CHECKOUT, STATUS, CLI_NOME, CLI_TEL, CLI_NASC, CLI_EMAIL, CLI_CPF)
                         VALUES (?, ?, ?, 'PENDENTE', ?, ?, ?, ?, ?)";
        $stmtReserva = $conn->prepare($queryReserva);
        $stmtReserva->bind_param("isssssss", $idQuarto, $checkin, $checkout, $nome, $telefone, $nascimento, $email, $cpf);
        $stmtReserva->execute();

        // Atualiza o status do quarto para 'OCUPADO'
        $queryAtualizaQuarto = "UPDATE quarto SET STATUS = 'OCUPADO' WHERE ID_QUARTO = ?";
        $stmtAtualiza = $conn->prepare($queryAtualizaQuarto);
        $stmtAtualiza->bind_param("i", $idQuarto);
        $stmtAtualiza->execute();

        echo "<script>alert('Reserva realizada com sucesso!');</script>";
        header("Location: index.html"); // Atualiza a página após reservar
        exit();
    } else {
        echo "<script>alert('Todos os quartos desse tipo já estão ocupados!');</script>";
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Reserva</title>
    <link href="CSS/formularioquarto.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="tela">
        <h1>Formulário de Reserva</h1>

        <!-- Exibe o tipo do quarto e a quantidade disponível -->
        <p><strong>Tipo do Quarto:</strong> <?php echo $tipoQuarto; ?></p>
        <p><strong>Quartos Disponíveis:</strong> <?php echo $quartosDisponiveis; ?></p>

        <form method="post" action="formulario.php?tipo=<?php echo $tipoQuarto; ?>">
            <!-- Dados do cliente -->
            <label for="nome">Nome Completo:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="telefone">Telefone:</label><br>
            <input type="text" id="telefone" name="telefone" required><br><br>

            <label for="nascimento">Data de Nascimento:</label><br>
            <input type="date" id="nascimento" name="nascimento" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" required><br><br>

            <label for="checkin">Data de Check-in:</label><br>
            <input type="date" id="checkin" name="checkin" required><br><br>

            <label for="checkout">Data de Check-out:</label><br>
            <input type="date" id="checkout" name="checkout" required><br><br>
            
            <input type="button" id="bnt_confirma" value="RESERVAR">
            
            <div id="confirma" style="display: none;">
                <label for="">Deseja mesmo confirmar a reserva?</label>
                <button type="submit">Reservar</button>
            </div>
            

        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
