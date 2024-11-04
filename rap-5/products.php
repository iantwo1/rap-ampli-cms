<!DOCTYPE html>
<?php include('layouts/header.php'); ?>
<section id="products">
    <div class="container">
        <h5>PRODUTOS</h5>

        <div class="row justify-content-center" style="gap: 10px;">
            <?php
            $page = $_GET['page'] ?? 1;
            $rowsPerPage = 8;
            $paginationIni = $page == 1 ? 0 : (($page - 1) * $rowsPerPage);
            $allProducts = mysqli_query($conn, "SELECT * FROM products");
            $queryProducts = mysqli_query($conn, "SELECT * FROM products limit $paginationIni, $rowsPerPage");
            $dados = mysqli_fetch_all($queryProducts, MYSQLI_ASSOC);
            $allDados = mysqli_fetch_all($allProducts, MYSQLI_ASSOC);
            $totalRegistros = count($allDados);
            $totalPages = ceil($totalRegistros / $rowsPerPage);
            if (count($dados) == 0) {
                echo "Nenhum registro encontrado!";
            }
            foreach ($dados as $k => $product) {
                ?>
                <div class="card col-sm-4 text-center">
                    <div class="card-body">
                        <?php
                        if (strlen($product['product_image']) > 1) {
                            ?>
                            <div class="container">
                                <?php echo "<img src='" . $product['product_image'] . "' width=150 height=150 />"; ?>
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
                        <div class="card-title fw-bold"><?php echo $product['product_name'] ?>
                            <div style="font-size: 10px; color: #555"><?php echo $product['product_category'] ?></div>
                        </div>
                        <span class="fs-5 fw-bold">R$ <?php echo $product['product_price'] ?></span>
                        <div>
                            <a href="single_product.php?id=<?php echo $product['product_id']; ?>"
                                class="btn btn-primary mt-2">Ver mais detalhes</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col-xs-12">
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php
                        if ($page != 1) {
                            ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1 ?>">Anterior</a>
                            </li>
                            <?php
                        }
                        ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) {
                            ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if ($page + 1 <= $totalPages) {
                            ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1 ?>">Próxima</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</section>
<?php include('layouts/footer.php'); ?>