<!DOCTYPE html>
<?php include('layouts/header.php'); ?>
<section id="products">
    <div class="container">
        <h5>DETALHE DO PRODUTO</h5>

        <div class="row justify-content-center gx-3 mt-5">
            <?php
            function mostra_miniatura($url)
            {
                if (strlen($url) > 1) {
                    echo "<img src='$url' width=50 height=50 />";
                }
            }
            $id = $_GET['id'];
            $queryProduct = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '$id'");
            $product = mysqli_fetch_assoc($queryProduct);
            if (count($product) == 0) {
                echo "Nenhum registro encontrado!";
            }

            ?>
            <div class="col-sm-4 text-center">

                <?php
                if (strlen($product['product_image']) > 1) {
                    ?>
                    <div class="container">
                        <?php echo "<img id='principal' src='" . $product['product_image'] . "' width=300 height=300 />"; ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php mostra_miniatura($product['product_image2']); ?>
                        </div>
                        <div class="col-sm-3">
                            <?php mostra_miniatura($product['product_image3']); ?>
                        </div>
                        <div class="col-sm-3">
                            <?php mostra_miniatura($product['product_image4']); ?>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="container text-center" style="width: 150px; height: 150px; border: 1px solid #CCC;">
                        Sem imagem
                    </div>
                    <?php
                }
                ?>


            </div>
            <div class="col-sm-8 text-left">
                <div class="fw-bold"><?php echo $product['product_name'] ?>
                    <div style="font-size: 10px; color: #555"><?php echo $product['product_category'] ?></div>
                </div>
                <div class="fs-1 fw-bold mt-5">R$ <?php echo $product['product_price'] ?></div>

            </div>
        </div>



    </div>

    </div>
</section>
<?php include('layouts/footer.php'); ?>