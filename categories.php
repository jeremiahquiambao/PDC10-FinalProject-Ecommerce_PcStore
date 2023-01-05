<?php 

include('functions/userfunctions.php');  //this line of code need to go first so that the isset($_SESSION['auth'] for user/admin account if log in or logout will be displayed 
include('includes/header.php'); 

?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">Home / Categories</h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Our Categories</h1>
                <hr>
                <div class="row">
                    <?php 
                        $categories = getAllActive("categories");

                        if(mysqli_num_rows($categories) > 0) //if there's categories available then we're going to loop through it 
                        {
                            foreach($categories as $item)
                            {
                                ?>
                                    <div class="col-md-3 mb-2">
                                        <a href="products.php?category=<?= $item['slug']; ?>">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                <img src="uploads/<?= $item['image']; ?>" alt="Category Image" class="w-100">
                                                <h4 class="text-center"><?= $item['name']; ?></h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        }
                        else 
                        {
                            echo "No categories available";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>