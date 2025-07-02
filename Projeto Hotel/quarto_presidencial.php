<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="CSS/header.css" type="text/css" rel="stylesheet">
  <link href="CSS/quarto.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


  <title>Quarto Presidencial</title>

</head>

<body>

  <header class="cabecalho">
    <a href="index.html" class="logo">
      <img src="IMG/LOGO_IMG.png" alt="IMAGEM LOGO BANDEIRANTES">
    </a>

    <nav class="barra">
      <a href="index.html">Início</a>
      <a href="usuario.php">Minhas reservas</a>
    </nav>
  </header>

  <div class="tela">
    <div class="fotos">
      <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="IMG/hotel1.jpg" alt="Primeiro Slide"
              style="height: 500px; border-radius: 20px;">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="IMG/hotel2.jpg" alt="Segundo Slide"
              style="height: 500px; border-radius: 20px;">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="IMG/hotel3.jpg" alt="Terceiro Slide"
              style="height: 500px; border-radius: 20px;">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Próximo</span>
        </a>
      </div>
    </div>

    <div class="nomequarto">
      <h1>Quarto Presidencial</h1>
      <p>O melhor conforto disponivel</p>
      <a href="formulario.php?tipo=Presidencial" class="btn-comprar" id="link">Comprar Quarto</a>
    </div>

    <div class="descricao">
      <h1>Descrição</h1>
        <p><h1 id="item_nome">Capacidade:</h1> até 5 pessoas</p>
        <p><h1 id="item_nome">Valor:</h1> 600 por noite</p>
        <p><h1 id="item_nome">Ideal para:</h1> Estadias VIP, hóspides que valorisem exclusividade</p>
    </div>

    <div class="caracteristica">
      <h1>Caracteristicas</h1>
      <p>- Suíte ampla com sala de estar separada</p>
<p>- Cama king size com enxoval de luxo</p>
<p>- Banheiro de mármore com banheira de hidromassagem</p>
<p>- Duas Smart TVs (uma na sala e outra no quarto)</p>
<p>- Wi-Fi de altíssima velocidade</p>
<p>- Ar-condicionado com controle inteligente</p>
<p>- Minibar premium e máquina de café expresso</p>
<p>- Serviço de concierge 24 horas</p>
<p>- Varanda privativa com vista panorâmica</p>
    </div>

  </div>


  <footer class="text-center text-lg-start text-black">
    <div class="container p-4 pb-0">
      <section class="">
        <div class="row">
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">
              Sobre nós
            </h6>
            <p>
              Somos um hotel com a missão de garantir que nossos hóspedes se sintam extremamente bem acomodados e vivam uma experiência inesquecível.<br>
              
            </p>
          </div>

          <hr class="w-100 clearfix d-md-none" />

          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Contatos</h6>
            <p><i class="fas fa-home mr-3"></i> Av. Cesario de Melo, 2541. Rio de Janeiro</p>
            <p><i class="fas fa-envelope mr-3"></i>contato@bandeirantes.com</p>
            <p><i class="fas fa-phone mr-3"></i>+55 21 94718-1247</p>
            <p><i class="fas fa-print mr-3"></i>+55 21 95792-6993</p>
          </div>
        </div>
      </section>

      <hr class="my-3">

      <section class="p-3 pt-0">
        <div class="row d-flex align-items-center">
          <div class="col-md-7 col-lg-8 text-center text-md-start">
            <div class="p-3">
              © 2024 Copyright:
              <a class="text-black" href="">Bandeirantes LTDA.</a>
            </div>
          </div>

          <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
            <a class="btn btn-outline-light btn-floating m-1" class="text-black" role="button" href="https://facebook.com" style="font-size: 30px;"><i class='bx bxl-facebook-square'></i></a>

            <a class="btn btn-outline-light btn-floating m-1" class="text-black" role="button" href="https://x.com" style="font-size: 30px;"><i class='bx bxl-twitter'></i></a>

            <a class="btn btn-outline-light btn-floating m-1" class="text-black" role="button" href="https://instagram.com" style="font-size: 30px;"><i class='bx bxl-instagram'></i></a>
          </div>
        </div>
      </section>
    </div>
  </footer>  

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>


</body>

</html>