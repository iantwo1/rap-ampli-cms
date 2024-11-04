<html lang="en">
<?php
include("server/connection.php");
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="
https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css
" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css" />
  <title>RAP-5</title>
  <script>document.write('<script src="http://'
      + (location.host || 'localhost').split(':')[0]
      + ':35729/livereload.js?snipver=1"></'
      + 'script>')</script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="assets/imgs/logo.svg" height="50px" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-buttons align-items-center">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link">Fale Conosco</a>
          </li>
          <li class="nav-item">
            <i class="nav-link fa fa-shopping-cart" aria-hidden="true"></i>
          </li>
          <li class="nav-item">
            <i class="nav-link fa fa-user" aria-hidden="true"></i>
          </li>
        </ul>

      </div>
    </div>
  </nav>