<?php
include("header.php");
$error = $_GET['error'] ?? null;
?>
<div class="container-fluid">
    <div class="mx-auto w-25 h-50 mt-2 p-4 border flex align-content-center">
        <h3 class="text-center">Login</h3>
        <?php
        if ($error) {
            echo "<div class='bg-danger w-100 text-center text-light p-3'>Erro no login! Verifique os dados digitados!</div>";
        }
        ?>
        <form method="post" action="login.php" class="d-flex flex-column align-items-center" style="gap: 5px">
            <label for="usuario">E-mail</label>
            <input type="text" name="usuario" id="usuario" />
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" />
            <button class="bg-primary text-light" type="submit">Entrar</button>
        </form>
    </div>
</div>