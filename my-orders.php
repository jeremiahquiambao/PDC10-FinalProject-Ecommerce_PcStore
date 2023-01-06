<?php 

include('functions/userfunctions.php');  //this line of code need to go first so that the isset($_SESSION['auth'] for user/admin account if log in or logout will be displayed 
include('includes/header.php'); //header.php already have session_start()

include('authenticate.php'); //for user authentication when trying to access this page 
 
?>

<div class="py-3 bg-danger">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white">
                Home /
            </a>
            <a href="my-orders.php" class="text-white">
                My Orders
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No.</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getOrders();

                                if(mysqli_num_rows($orders) > 0)
                                {
                                    foreach($orders as $item)
                                    {
                                    ?>
                                    
                                        <tr>
                                            <td> <?= $item['id']; ?> </td>
                                            <td> <?= $item['tracking_no']; ?> </td>

                                            <?php $total_price = $item['total_price']; ?>
                                            <td>&#8369;<?= $english_format_number = number_format($total_price); ?></td>
                                            
                                            <td> <?= $item['created_at']; ?> </td>
                                            <td>
                                                <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-success">View details</a>
                                            </td>
                                        </tr>
                                    <?php
                                    } 
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="5">No orders yet</td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>