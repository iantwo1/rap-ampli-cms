<?php
require 'header.php';
if (!$_SESSION['isLoggedIn']) {
    header('Location: index.php');
}

$orderID = $_GET['id'];
if ($orderID <= 0 || !$orderID) {
    die("É preciso informar uma ID para acessar essa página!");
}

$confirm = $_POST['confirm'] ?? 'false';
if ($confirm == 'true') {
    $deleteOrder = mysqli_query($conn, "DELETE FROM orders WHERE order_id = '$orderID'");
    if ($deleteOrder) {
        echo '<div class="alert alert-success" role="alert">
        Pedido apagado com sucesso! <a href="dashboard.php">Voltar para a lista</a>
    </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Erro ao apagar pedido!
    </div>';
    }
}

$queryOrder = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = '$orderID'");
$dados = mysqli_fetch_assoc($queryOrder);
if (!$dados) {
    die("Pedido não encontrado! Volte a listagem!");
}
?>
<div class="container-xxl">
    <div class="row">
        <?php require 'sidemenu.php'; ?>
        <div class="col-md-9">
            <h4>Delete Order</h4>
            <div class="alert alert-danger" role="alert">
                Tem certeza que deseja apagar o pedido de ID
                <?php echo $orderID; ?>?
            </div>
            <form action="delete_order.php?id=<?php echo $orderID; ?>" method="POST">
                <input id="confirm" name="confirm" type="hidden" value="true" />
                <label for="shipping_city" class="form-label">Shipping City</label>
                <input id="shipping_city" name="shipping_city" type="text" disabled class="form-control"
                    value="<?php echo $dados['shipping_city']; ?>" />
                <label for="shipping_uf" class="form-label">Shipping UF</label>
                <input id="shipping_uf" name="shipping_uf" type="text" disabled class="form-control"
                    value="<?php echo $dados['shipping_uf']; ?>" />
                <label for="shipping_address" class="form-label">Shipping Address</label>
                <input id="shipping_address" name="shipping_address" type="text" disabled class="form-control"
                    value="<?php echo $dados['shipping_address']; ?>" />
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Sim, deletar</button>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>