<?php
require 'header.php';
if (!$_SESSION['isLoggedIn']) {
    header('Location: index.php');
}

$productID = $_GET['id'];
if ($productID <= 0 || !$productID) {
    die("É preciso informar uma ID para acessar essa página!");
}



if (isset($_POST['confirm']) && $_POST['confirm'] == "true") {

    $deleteProduct = mysqli_query($conn, "DELETE FROM products WHERE product_id = '$productID'");
    if ($deleteProduct) {
        echo '<div class="alert alert-success" role="alert">
            Produto deletado com sucesso! <a href="products.php">Voltar para a listagem!</a>
          </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
            Erro ao deletar produto!
        </div>';
    }
}
$queryProduct = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '$productID'");
$dados = mysqli_fetch_assoc($queryProduct);
if (!$dados) {
    die("Produto não encontrado!");
}

$price = $dados['product_price'];
$name = $dados['product_name'];
$description = $dados['product_description'];
$category = $dados['product_category'];
$special_offer = $dados['product_special_offer'];
$color = $dados['product_color'];

?>
<div class="container-xxl mt-3">
    <div class="row">
        <?php require 'sidemenu.php'; ?>
        <div class="col-md-9">
            <h4>Delete Product</h4>
            <div class="alert alert-danger" role="alert">
                Tem certeza que deseja apagar o produto de ID
                <?php echo $productID; ?>?
            </div>

            <form action="delete_product.php?id=<?php echo $productID; ?>" method="POST">
                <input id="confirm" name="confirm" type="hidden" value="true" />
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" disabled
                    value="<?php echo $name ?? '' ?>" />
                <label for="category" class="form-label">Category</label>
                <input id="category" name="category" type="text" class="form-control" disabled
                    value="<?php echo $category ?? '' ?>" />
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control"
                    disabled><?php echo $description ?? '' ?></textarea>
                <label for="price" class="form-label">Price</label>
                <input id="price" name="price" type="number" class="form-control" disabled
                    value="<?php echo $price ?? 0 ?>" />
                <label for="special_offer" class="form-label">Special Offer</label>
                <input id="special_offer" name="special_offer" type="number" class="form-control" disabled
                    value="<?php echo $special_offer ?? 0 ?>" />
                <label for="color" class="form-label">Color</label>
                <input id="color" name="color" type="number" class="form-control" disabled
                    value="<?php echo $color ?? 0 ?>" />

                <div class=" mt-3">
                    <button type="submit" class="btn btn-success">Deletar</button>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>