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
            <h4>Orders</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $allOrders = mysqli_query($conn, "SELECT * FROM orders");
                    $queryOrders = mysqli_query($conn, "SELECT * FROM orders limit $paginationIni, $rowsPerPage");
                    $dados = mysqli_fetch_all($queryOrders, MYSQLI_ASSOC);
                    $allDados = mysqli_fetch_all($allOrders, MYSQLI_ASSOC);
                    $totalRegistros = count($allDados);
                    $totalPages = ceil($totalRegistros / $rowsPerPage);
                    if (count($dados) == 0) {
                        echo "Nenhum registro encontrado!";
                    }
                    foreach ($dados as $k => $order) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $order['order_id'] ?></th>
                            <td><?php echo $order['order_status'] ?></td>
                            <td><?php echo $order['user_id'] ?></td>
                            <td><?php echo $order['order_date'] ?></td>
                            <td><button type="button"
                                    onClick="location.href = 'edit_order.php?id=<?php echo $order['order_id']; ?>';"
                                    class="btn btn-primary">Edit</button></td>
                            <td><button type="button"
                                    onClick="location.href = 'delete_order.php?id=<?php echo $order['order_id']; ?>';"
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
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1 ?>">Anterior</a></li>
                        <?php
                    }
                    ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) {
                        ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
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