<?php
require 'header.php';
if (!$_SESSION['isLoggedIn']) {
    header('Location: index.php');
}

$orderID = $_GET['id'];
if ($orderID <= 0 || !$orderID) {
    die("É preciso informar uma ID para acessar essa página!");
}
$errors = [];
if (count($_POST) > 0) {
    $cost = $_POST['cost'];
    if ($cost <= 0) {
        $errors[] = "Campo 'cost' precisa ser maior que zero!";
    }
    $shipping_city = $_POST['shipping_city'];
    $shipping_uf = $_POST['shipping_uf'];
    $shipping_address = $_POST['shipping_address'];
    if (strlen($shipping_city) <= 0 || strlen($shipping_uf) <= 0 || strlen($shipping_address) <= 0) {
        $errors[] = 'Campos de endereço são obrigatórios!';
    }
    if (count($errors) == 0) {
        $updateOrder = mysqli_query($conn, "UPDATE orders SET order_cost='$cost', shipping_city='$shipping_city', shipping_uf='$shipping_uf', shipping_address='$shipping_address' WHERE order_id='$orderID'");
        if ($updateOrder) {
            echo '<div class="alert alert-success" role="alert">
            Pedido editado com sucesso!
          </div>';
        }
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
            <h4>Edit Order</h4>
            <?php
            foreach ($errors as $k => $error) {
                echo '<div class="alert alert-error" role="alert">' + $error + '</div>';
            }
            ?>
            <form action="edit_order.php?id=<?php echo $orderID; ?>" method="POST">
                <label for="cost" class="form-label">Cost</label>
                <input id="cost" name="cost" type="number" class="form-control"
                    value="<?php echo $dados['order_cost']; ?>" />
                <label for="shipping_city" class="form-label">Shipping City</label>
                <input id="shipping_city" name="shipping_city" type="text" class="form-control"
                    value="<?php echo $dados['shipping_city']; ?>" />
                <label for="shipping_uf" class="form-label">Shipping UF</label>
                <input id="shipping_uf" name="shipping_uf" type="text" class="form-control"
                    value="<?php echo $dados['shipping_uf']; ?>" />
                <label for="shipping_address" class="form-label">Shipping Address</label>
                <input id="shipping_address" name="shipping_address" type="text" class="form-control"
                    value="<?php echo $dados['shipping_address']; ?>" />
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>