<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
                if(isset($_GET['id'])) //if the id is present in our url, then will fetch that id then fetch the record of that id 
                {
                    $id = $_GET['id']; //fetch the id 

                    $product = getByID("products", $id); //fetch the record of that id 

                    if(mysqli_num_rows($product) > 0)  //if id is found in products table then we're going to fetch  
                    {
                        $data = mysqli_fetch_array($product); //we now got the record in the $data variablen then we will print it in all the text boxes
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Product
                                        <a href="products.php" class="btn btn-primary float-end">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data"> <!-- enctype is used in form element that have a file upload, in this form that we created it's for uploading the image -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class=mb-0 for="">Select Category</label>
                                                <select name="category_id" class="form-select mb-2"> <!-- CSS style will be found in header.php -->
                                                    <option selected>Select Category</option> 
                                                    <?php 
                                                        $categories = getAll("categories");
                                                        //Will check if categories table is empty
                                                        if(mysqli_num_rows($categories) > 0) //if there's category then we'll proceed with the loop and display the categories available 
                                                        {
                                                            foreach ($categories as $item) { //we're just displaying here the  default selected category when added the product before
                                                                ?>
                                                                    <option value="<?= $item['id']; ?>" <?= $data['category_id'] == $item['id']? 'selected':'' ?> ><?= $item['name']; ?></option>
                                                                <?php 
                                                            }
                                                        }
                                                        else 
                                                        {
                                                            echo "No category available";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="product_id" value="<?= $data['id']; ?>">
                                            <div class="col-md-6">
                                                <label class=mb-0 for="">Name</label>
                                                <input type="text" required name="name" value="<?= $data['name']; ?>" placeholder="Enter Product Name" class="form-control mb-2">  <!-- css will be found on header.php style  -->
                                            </div>
                                            <div class="col-md-6">
                                                <label class=mb-0 for="">Slug</label>
                                                <input type="text" required name="slug" value="<?= $data['slug']; ?>" placeholder="Enter slug" class="form-control mb-2">  
                                            </div>
                                            <!-- <div class="col-md-12">
                                                <label class=mb-0 for="">Small Description</label>
                                                <textarea rows="3" name="small_description" placeholder="Enter small description" class="form-control mb-2"></textarea>
                                            </div> -->
                                            <div class="col-md-12">
                                                <label class=mb-0 for="">Description</label>
                                                <textarea rows="3" required name="description" placeholder="Enter description" class="form-control mb-2"><?= $data['description']; ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class=mb-0 for="">Original Price</label>
                                                <input type="text" required name="original_price" value="<?= $data['original_price']; ?>" placeholder="Enter Original Price" class="form-control mb-2">  <!-- css will be found on header.php style  -->
                                            </div>
                                            <div class="col-md-6">
                                                <label class=mb-0 for="">Selling Price</label>
                                                <input type="text" required name="selling_price" value="<?= $data['selling_price']; ?>" placeholder="Enter Selling Price" class="form-control mb-2">  
                                            </div>
                                            <div class="col-md-12">
                                                <label class=mb-0 for="">Upload Image</label>
                                                <input type="hidden" name="old_image" value="<?= $data['image']; ?>"> <!-- this is when the user not updating the image, so we're just going to fetch the old image name, then update that thing -->
                                                <input type="file"   name="image" class="form-control mb-2">  
                                                <label class=mb-0 for="">Current Image</label>
                                                <img src="../uploads/<?= $data['image']; ?>" alt="Product Image" height="50px" width="50px">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class=mb-0 for="">Quantity</label>
                                                    <input type="number" required name="qty" value="<?= $data['qty']; ?>" placeholder="Enter Quantity" class="form-control mb-2">  
                                                </div>
                                                <div class="col-md-3">
                                                    <label class=mb-0 for="">Hidden</label>
                                                    <input type="checkbox" name="status" <?= $data['status'] == '0'? '':'checked' ?> >  <!-- 0 means visible(unchecked), 1 means invisible that's why need to be check -->
                                                </div>
                                                <div class="col-md-3">
                                                    <label class=mb-0 for="">Trending</label>
                                                    <input type="checkbox" name="trending" <?= $data['trending'] == '0'? '':'checked' ?> >  
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class=mb-0 for="">Meta Title</label>
                                                <input type="text" required name="meta_title" value="<?= $data['meta_title']; ?>" placeholder="Enter meta title" class="form-control mb-2">  
                                            </div>
                                            <div class="col-md-12">
                                                <label class=mb-0 for="">Meta Description</label>
                                                <textarea rows="3" required name="meta_description" placeholder="Enter meta description" class="form-control mb-2"><?= $data['meta_description']; ?> </textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class=mb-0 for="">Meta Keywords</label>
                                                <textarea rows="3" required name="meta_keywords" placeholder="Enter meta keywords" class="form-control mb-2"><?= $data['meta_keywords']; ?></textarea>
                                            </div>
                                        
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                                            </div>
                                        </div>
                                    </form>  
                                </div>
                            </div>
                        <?php
                    }
                    else 
                    {
                        echo "Product not found for the given id";
                    }
                }
                else 
                {
                    echo "Id missing from url";
                } 
            ?>    
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>