<?php
require 'header.php';
if (!$_SESSION['isLoggedIn']) {
    header('Location: index.php');
}

$productID = $_GET['id'];
if ($productID <= 0 || !$productID) {
    die("É preciso informar uma ID para acessar essa página!");
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

$errors = [];
if (count($_POST) > 0) {
    $price = $_POST['price'];
    if ($price <= 0) {
        $errors[] = "Campo 'price' precisa ser maior que zero!";
    }
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    if (strlen($name) <= 0) {
        $errors[] = "Campo 'name' é obrigatório!";
    }
    if (strlen($description) <= 0) {
        $errors[] = "Campo 'description' é obrigatório!";
    }
    if (strlen($category) <= 0) {
        $errors[] = "Campo 'category' é obrigatório!";
    }
    $special_offer = $_POST['special_offer'];
    if ($special_offer >= $price || $special_offer <= 0) {
        $errors[] = "Campo 'special offer' deve ser menor que o 'price' e maior que zero!";
    }
    $color = $_POST['color'];
    if (count($errors) == 0) {
        $createProduct = mysqli_query($conn, "UPDATE products SET product_name = '$name', product_category = '$category', product_description = '$description', product_price = '$price', product_special_offer = '$special_offer', product_color = '$color' WHERE product_id = '$productID'");
        if ($createProduct) {
            echo '<div class="alert alert-success" role="alert">
            Produto alterado com sucesso! <a href="products.php">Voltar para a listagem!</a>
          </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Erro ao alterar produto!
        </div>';
        }
    }
}
?>
<div class="container-xxl mt-3">
    <div class="row">
        <?php require 'sidemenu.php'; ?>
        <div class="col-md-9">
            <h4>Edit Product</h4>
            <?php
            foreach ($errors as $k => $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
            ?>
            <form action="edit_product.php?id=<?php echo $productID; ?>" method="POST">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" value="<?php echo $name ?? '' ?>" />
                <label for="category" class="form-label">Category</label>
                <input id="category" name="category" type="text" class="form-control"
                    value="<?php echo $category ?? '' ?>" />
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description"
                    class="form-control"><?php echo $description ?? '' ?></textarea>
                <label for="price" class="form-label">Price</label>
                <input id="price" name="price" type="number" class="form-control" value="<?php echo $price ?? 0 ?>" />
                <label for="special_offer" class="form-label">Special Offer</label>
                <input id="special_offer" name="special_offer" type="number" class="form-control"
                    value="<?php echo $special_offer ?? 0 ?>" />
                <label for="color" class="form-label">Color</label>
                <input id="color" name="color" type="number" class="form-control" value="<?php echo $color ?? 0 ?>" />

                <div class=" mt-3">
                    <button type="submit" class="btn btn-success">Editar</button>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>