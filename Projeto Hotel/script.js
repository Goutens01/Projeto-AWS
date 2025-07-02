document.getElementById("bnt_confirma").addEventListener("click", confirmacao);

function confirmacao(event) {
    // Impede o envio do formulário até a validação
    event.preventDefault();

    // Verifica se todos os campos obrigatórios estão preenchidos
    var nome = document.getElementById("nome").value;
    var telefone = document.getElementById("telefone").value;
    var nascimento = document.getElementById("nascimento").value;
    var email = document.getElementById("email").value;
    var cpf = document.getElementById("cpf").value;
    var checkin = document.getElementById("checkin").value;
    var checkout = document.getElementById("checkout").value;

    if (nome && telefone && nascimento && email && cpf && checkin && checkout) {
        // Se todos os campos obrigatórios estão preenchidos, exibe a div de confirmação
        document.getElementById("confirma").style.display = "block";
    } else {
        // Se algum campo obrigatório não está preenchido, avisa o usuário
        alert("Por favor, preencha todos os campos obrigatórios.");
    }
}
