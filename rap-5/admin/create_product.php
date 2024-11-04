<?php
require 'header.php';
if (!$_SESSION['isLoggedIn']) {
    header('Location: index.php');
}

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
        $createProduct = mysqli_query($conn, "INSERT INTO products (product_name, product_category, product_description, product_price, product_special_offer, product_color) VALUES ('$name', '$category', '$description', '$price', '$special_offer', '$color')");
        if ($createProduct) {
            echo '<div class="alert alert-success" role="alert">
            Produto criado com sucesso! <a href="products.php">Voltar para a listagem!</a>
          </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Erro ao criar produto!
        </div>';
        }
    }
}
?>
<div class="container-xxl mt-3">
    <div class="row">
        <?php require 'sidemenu.php'; ?>
        <div class="col-md-9">
            <h4>Create Product</h4>
            <?php
            foreach ($errors as $k => $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
            ?>
            <form action="create_product.php" method="POST">
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

                <div class="d-flex mt-3" style="gap: 20px">
                    <a href="products.php">Voltar para a listagem</a>
                    <button type="submit" class="btn btn-success">Criar</button>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>