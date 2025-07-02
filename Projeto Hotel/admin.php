<?php
// Conexão com o banco de dados
$conn = new mysqli("db-projeto-hotel.cq56pxdmv295.us-east-1.rds.amazonaws.com", "admin", "19672004", "HotelDB");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para obter todas as reservas
function obterReservas($conn) {
    $query = "SELECT r.ID_RESERVA, r.ID_QUARTO, r.DT_CHECKIN, r.DT_CHECKOUT, r.STATUS, r.CLI_NOME, r.CLI_TEL, r.CLI_EMAIL, r.CLI_CPF, q.TIPO
              FROM reserva r
              JOIN quarto q ON r.ID_QUARTO = q.ID_QUARTO";
    return $conn->query($query);
}

// Cancelar reserva
if (isset($_GET['cancelar'])) {
    $idReserva = $_GET['cancelar'];
    $queryCancelar = "UPDATE reserva SET STATUS = 'CANCELADO' WHERE ID_RESERVA = ?";
    $stmtCancelar = $conn->prepare($queryCancelar);
    $stmtCancelar->bind_param("i", $idReserva);
    $stmtCancelar->execute();

    echo "<script>alert('Reserva cancelada com sucesso!');</script>";
    header("Location: admin.php"); // Atualiza a página após cancelar
    exit();
}

// Editar reserva
if (isset($_POST['editar'])) {
    $idReserva = $_POST['id_reserva'];
    $status = $_POST['status'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Atualizar informações da reserva
    $queryEditar = "UPDATE reserva SET STATUS = ?, DT_CHECKIN = ?, DT_CHECKOUT = ? WHERE ID_RESERVA = ?";
    $stmtEditar = $conn->prepare($queryEditar);
    $stmtEditar->bind_param("sssi", $status, $checkin, $checkout, $idReserva);
    $stmtEditar->execute();

    echo "<script>alert('Reserva editada com sucesso!');</script>";
    header("Location: admin.php"); // Atualiza a página após editar
    exit();
}

$reservas = obterReservas($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/admin.css" type="text/css" rel="stylesheet">

    <title>Admin</title>
</head>
<body>

<h1>Gerenciar Reservas</h1>

<!-- Exibe todas as reservas -->
<table>
    <thead>
        <tr>
            <th>ID Reserva</th>
            <th>Tipo do Quarto</th>
            <th>Nome do Cliente</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($reserva = $reservas->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $reserva['ID_RESERVA']; ?></td>
                <td><?php echo $reserva['TIPO']; ?></td>
                <td><?php echo $reserva['CLI_NOME']; ?></td>
                <td><?php echo $reserva['CLI_TEL']; ?></td>
                <td><?php echo $reserva['CLI_EMAIL']; ?></td>
                <td><?php echo $reserva['DT_CHECKIN']; ?></td>
                <td><?php echo $reserva['DT_CHECKOUT']; ?></td>
                <td><?php echo $reserva['STATUS']; ?></td>
                <td>
                    <!-- Botão para editar -->
                    <button class="edit-btn" onclick="editarReserva(<?php echo $reserva['ID_RESERVA']; ?>, '<?php echo $reserva['DT_CHECKIN']; ?>', '<?php echo $reserva['DT_CHECKOUT']; ?>', '<?php echo $reserva['STATUS']; ?>')">Editar</button>

                    <!-- Botão para cancelar -->
                    <a href="admin.php?cancelar=<?php echo $reserva['ID_RESERVA']; ?>">
                        <button class="cancel-btn">Cancelar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Formulário para editar a reserva -->
<div id="editForm" style="display:none;">
    <h3>Editar Reserva</h3>
    <form method="POST" action="admin.php">
        <input type="hidden" name="id_reserva" id="id_reserva">
        <label for="checkin">Data de Check-in:</label><br>
        <input type="date" name="checkin" id="checkin" required><br><br>

        <label for="checkout">Data de Check-out:</label><br>
        <input type="date" name="checkout" id="checkout" required><br><br>

        <label for="status">Status:</label><br>
        <select name="status" id="status" required>
            <option value="PENDENTE">PENDENTE</option>
            <option value="CONFIRMADO">CONFIRMADO</option>
            <option value="CANCELADO">CANCELADO</option>
        </select><br><br>

        <button type="submit" name="editar">Salvar Alterações</button>
    </form>
    <button onclick="document.getElementById('editForm').style.display='none'">Fechar</button>
</div>

<script>
    function editarReserva(id, checkin, checkout, status) {
        document.getElementById('id_reserva').value = id;
        document.getElementById('checkin').value = checkin;
        document.getElementById('checkout').value = checkout;
        document.getElementById('status').value = status;
        document.getElementById('editForm').style.display = 'block';
    }
</script>

</body>
</html>
