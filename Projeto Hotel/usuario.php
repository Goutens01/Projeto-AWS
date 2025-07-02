<?php
// Conexão com o banco de dados
$conn = new mysqli("db-projeto-hotel.cq56pxdmv295.us-east-1.rds.amazonaws.com", "admin", "19672004", "HotelDB");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para obter as reservas de um cliente com base no CPF
function obterReservasPorCpf($conn, $cpf) {
    $query = "SELECT r.ID_RESERVA, r.ID_QUARTO, r.DT_CHECKIN, r.DT_CHECKOUT, r.STATUS, r.CLI_NOME, r.CLI_TEL, r.CLI_EMAIL, r.CLI_CPF, q.TIPO
              FROM reserva r
              JOIN quarto q ON r.ID_QUARTO = q.ID_QUARTO
              WHERE r.CLI_CPF = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    return $stmt->get_result();
}

// Função para atualizar o status para "CONFIRMADO"
function confirmarReserva($conn, $idReserva) {
    $query = "UPDATE reserva SET STATUS = 'CONFIRMADO' WHERE ID_RESERVA = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idReserva);
    $stmt->execute();
}

// Variáveis de erro e sucesso
$erro = "";
$alerta = ""; // Usado para exibir alertas via JavaScript
$reservas = [];

// Inicializa o CPF
$cpf = "";

// Buscar reservas com base no CPF
if (isset($_POST['buscar'])) {
    $cpf = $_POST['CLI_CPF'];

    $result = obterReservasPorCpf($conn, $cpf);

    // Verifica se o cliente tem reservas
    if ($result->num_rows == 0) {
        $erro = "Nenhuma reserva encontrada para este CPF.";
    } else {
        while ($row = $result->fetch_assoc()) {
            $reservas[] = $row;
        }
    }
}

// Confirmar pagamento
if (isset($_POST['confirmar_pagamento'])) {
    $idReserva = $_POST['ID_RESERVA'];
    $cpf = $_POST['CLI_CPF']; // Recupera o CPF enviado no formulário

    confirmarReserva($conn, $idReserva);
    $alerta = "Pagamento realizado! Reserva confirmada.";

    // Recarrega as reservas após a confirmação
    $result = obterReservasPorCpf($conn, $cpf);
    while ($row = $result->fetch_assoc()) {
        $reservas[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/usuario.css" type="text/css" rel="stylesheet">
    <link href="CSS/header.css" type="text/css" rel="stylesheet">
    <title>Consulta de Reservas</title>
    <script>
        <?php if (!empty($alerta)) : ?>
            alert("<?php echo $alerta; ?>");
        <?php endif; ?>
    </script>
</head>
<body>

<header class="cabecalho">
    <a href="index.html" class="logo">
      <img src="IMG/LOGO_IMG.png" alt="IMAGEM LOGO BANDEIRANTES">
    </a>

    <nav class="barra">
      <a href="index.html">Início</a>
      <a href="#card-deck">Quartos</a>
      <a href="#">Sobre</a>
      <a href="usuario.php">Minhas reservas</a>
    </nav>
  </header>

<h1>Consulta de Reservas</h1>

<!-- Formulário de pesquisa -->
<form method="POST" action="usuario.php">
    <label for="CLI_CPF">CPF:</label>
    <input type="text" name="CLI_CPF" required value="<?php echo htmlspecialchars($cpf); ?>"><br><br>

    <button type="submit" name="buscar">Buscar Reservas</button>
</form>

<?php if ($erro) : ?>
    <p class="erro"><?php echo $erro; ?></p>
<?php endif; ?>

<?php if (count($reservas) > 0) : ?>
    <?php foreach ($reservas as $reserva) : ?>
        <table>
            <tr>
                <th>ID Reserva</th>
                <td><?php echo $reserva['ID_RESERVA']; ?></td>
            </tr>
            <tr>
                <th>Tipo de Quarto</th>
                <td><?php echo $reserva['TIPO']; ?></td>
            </tr>
            <tr>
                <th>Nome</th>
                <td><?php echo $reserva['CLI_NOME']; ?></td>
            </tr>
            <tr>
                <th>Telefone</th>
                <td><?php echo $reserva['CLI_TEL']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $reserva['CLI_EMAIL']; ?></td>
            </tr>
            <tr>
                <th>Check-in</th>
                <td><?php echo $reserva['DT_CHECKIN']; ?></td>
            </tr>
            <tr>
                <th>Check-out</th>
                <td><?php echo $reserva['DT_CHECKOUT']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $reserva['STATUS']; ?></td>
            </tr>
        </table>

        <!-- Botão para confirmar pagamento -->
        <?php if ($reserva['STATUS'] == 'PENDENTE') : ?>
            <form method="POST" action="usuario.php">
                <input type="hidden" name="ID_RESERVA" value="<?php echo $reserva['ID_RESERVA']; ?>">
                <input type="hidden" name="CLI_CPF" value="<?php echo $cpf; ?>">

                <button type="submit" name="confirmar_pagamento" class="confirmar-btn">Confirmar Pagamento</button>
            </form>
        <?php endif; ?>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
