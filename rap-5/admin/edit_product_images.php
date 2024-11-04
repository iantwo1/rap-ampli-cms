<?php
require 'header.php';
if (!$_SESSION['isLoggedIn']) {
    header('Location: index.php');
}

$productID = $_GET['id'];
if ($productID <= 0 || !$productID) {
    die("É preciso informar uma ID para acessar essa página!");
}



$errors = [];

function insereImagem($arquivo)
{

    $pasta = '../assets/imgs/';
    if (!isset($arquivo['size']) || $arquivo['size'] == 0) {
        return;
    }
    $nome_arquivo = $arquivo['name'];
    $tmp_name = $arquivo['tmp_name'];
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

    if (!in_array(strtolower($extensao), ['jpg', 'jpeg', 'png', 'gif'])) {
        throw new Exception('Tipo de arquivo não suportado! Deve ser uma imagem!');
    }
    if (move_uploaded_file($tmp_name, $pasta . $nome_arquivo)) {
        return $pasta . $nome_arquivo;
    } else {
        throw new Exception("Upload falhou!");
    }

}

if (count($_FILES) + count($_POST) > 0) {
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['image4'];
    try {
        $arq1 = insereImagem($image1);
        $arq2 = insereImagem($image2);
        $arq3 = insereImagem($image3);
        $arq4 = insereImagem($image4);
        if ($arq1) {
            mysqli_query($conn, "UPDATE products SET product_image = '$arq1' WHERE product_id = '$productID'");
        }
        if ($arq2) {
            mysqli_query($conn, "UPDATE products SET product_image2 = '$arq2' WHERE product_id = '$productID'");
        }
        if ($arq3) {
            mysqli_query($conn, "UPDATE products SET product_image3 = '$arq3' WHERE product_id = '$productID'");
        }
        if ($arq4) {
            mysqli_query($conn, "UPDATE products SET product_image4 = '$arq4' WHERE product_id = '$productID'");
        }
    } catch (Exception $error) {
        $errors[] = $error->getMessage();
    }





    if (count($errors) == 0) {
        echo '<div class="alert alert-success" role="alert">
            Produto alterado com sucesso! <a href="products.php">Voltar para a listagem!</a>
          </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
            Erro ao alterar produto!
        </div>';
    }
}

$queryProduct = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '$productID'");
$dados = mysqli_fetch_assoc($queryProduct);
if (!$dados) {
    die("Produto não encontrado!");
}

$name = $dados['product_name'];
$campo_image1 = $dados['product_image'];
$campo_image2 = $dados['product_image2'];
$campo_image3 = $dados['product_image3'];
$campo_image4 = $dados['product_image4'];

?>
<div class="container-xxl mt-3">
    <div class="row">
        <?php require 'sidemenu.php'; ?>
        <div class="col-md-9">
            <h4>Edit Product Images</h4>
            <?php
            foreach ($errors as $k => $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
            ?>
            <form action="edit_product_images.php?id=<?php echo $productID; ?>" method="POST"
                enctype="multipart/form-data">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" value="<?php echo $name ?? '' ?>"
                    disabled />
                <label id="image1" for="image1" class="form-label">Image 1</label>
                <?php if (strlen($campo_image1) > 1) {
                    echo "<div class='container'>";
                    echo "<img src='$campo_image1' width=150 height=150 />";
                    echo "</div>";
                }
                ?>
                <input type="file" name="image1" class="form-control" />
                <label id="image2" for="image2" class="form-label">Image 2</label>
                <?php if (strlen($campo_image2) > 1) {
                    echo "<div class='container'>";
                    echo "<img src='$campo_image2' width=150 height=150 />";
                    echo "</div>";
                }
                ?>
                <input type="file" name="image2" class="form-control" />
                <label id="image3" for="image3" class="form-label">Image 3</label>
                <?php if (strlen($campo_image3) > 1) {
                    echo "<div class='container'>";
                    echo "<img src='$campo_image3' width=150 height=150 />";
                    echo "</div>";
                }
                ?>
                <input type="file" name="image3" class="form-control" />
                <label id="image4" for="image4" class="form-label">Image 4</label>
                <?php if (strlen($campo_image4) > 1) {
                    echo "<div class='container'>";
                    echo "<img src='$campo_image4' width=150 height=150 />";
                    echo "</div>";
                }
                ?>
                <input type="file" name="image4" class="form-control" />
                <div class=" mt-3">
                    <button type="submit" class="btn btn-success">Editar</button>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>