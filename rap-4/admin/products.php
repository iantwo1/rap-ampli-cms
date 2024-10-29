<?php
require 'header.php';
if (!$_SESSION['isLoggedIn']) {
    header('Location: index.php');
}
$page = $_GET['page'] ?? 1;
$rowsPerPage = 5;
$paginationIni = $page == 1 ? 0 : (($page - 1) * $rowsPerPage);
?>
<div class="container-xxl mt-3">
    <div class="row">
        <?php require 'sidemenu.php'; ?>
        <div class="col-md-9">
            <nav class="d-flex" style="gap: 25px">
                <h4>Products</h4>

                <button type="button" onClick="location.href = 'create_product.php'" class="btn btn-primary">Create
                    product</button>
            </nav>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Edit Images</th>
                        <th scope="col">Delete</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
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
                        <tr>
                            <th scope="row"><?php echo $product['product_id'] ?></th>
                            <td><?php echo $product['product_name'] ?></td>
                            <td><?php echo $product['product_category'] ?></td>
                            <td><?php echo $product['product_price'] ?></td>
                            <td><button type="button"
                                    onClick="location.href = 'edit_product.php?id=<?php echo $product['product_id']; ?>';"
                                    class="btn btn-primary">Edit</button></td>
                            <td><button type="button"
                                    onClick="location.href = 'edit_product_images.php?id=<?php echo $product['product_id']; ?>';"
                                    class="btn btn-primary">Edit images</button></td>
                            <td><button type="button"
                                    onClick="location.href = 'delete_product.php?id=<?php echo $product['product_id']; ?>';"
                                    class="btn btn-danger">Delete</button></td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
            <nav>
                <ul class="pagination">
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
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1 ?>">Próxima</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>