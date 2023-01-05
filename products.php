<?php 

include('functions/userfunctions.php');  //this line of code need to go first so that the isset($_SESSION['auth'] for user/admin account if log in or logout will be displayed 
include('includes/header.php'); 

//If category is set - only then will going to proceed. This is also to avoid error, just in case that the user will change something in url
if(isset($_GET['category']))
{
    $category_slug = $_GET['category'];
    $category_data = getSlugActive("categories", $category_slug); //$category variable will now have the current category
    $category = mysqli_fetch_array($category_data); 
    
    //If condition to avoid error when category exact name is missing/mispelled from url, like category=computerr (wrong spelling)
    if($category)
    {
        $cid = $category['id']; //$cid means category id
        ?>

        <div class="py-3 bg-primary">
            <div class="container">
                <h6 class="text-white">
                    <a class="text-white" href="categories.php">
                        Home / 
                    </a>
                    <a class="text-white" href="categories.php">
                        Categories /
                    </a>
                    <?= $category['name']; ?>
                </h6>
            </div>
        </div>

        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?= $category['name']; ?></h2>
                        <hr>
                        <div class="row">
                            <?php 
                                $products = getProdByCategory($cid);

                                if(mysqli_num_rows($products) > 0) //if there's product available then we're going to loop through it 
                                {
                                    foreach($products as $item)
                                    {
                                        ?>
                                            <div class="col-md-3 mb-2">
                                                <a href="product-view.php?product=<?= $item['slug']; ?>"> <!-- When you click on the product, it will go to product-view.php page along with the product slug in the url -->
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                        <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
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
                                    echo "No products available";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php 
    }
    else
    {
        echo "Something went wrong"; //When user type something different in URL 
    }

}
else
{
    echo "Something went wrong"; //When the word category is missing/mispelled in url or type something different instead of word category in URL 
}

include('includes/footer.php'); 

?>