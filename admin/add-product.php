<?php 

include('includes/header.php');
include('middleware/adminMiddleware.php');

?>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
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
                                            foreach ($categories as $item) {
                                                ?>
                                                    <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
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
                            <div class="col-md-6">
                                <label class=mb-0 for="">Name</label>
                                <input type="text" required name="name" placeholder="Enter Product Name" class="form-control mb-2">  <!-- css will be found on header.php style  -->
                            </div>
                            <div class="col-md-6">
                                <label class=mb-0 for="">Slug</label>
                                <input type="text" required name="slug" placeholder="Enter slug" class="form-control mb-2">  
                            </div>
                            <!-- <div class="col-md-12">
                                <label class=mb-0 for="">Small Description</label>
                                <textarea rows="3" name="small_description" placeholder="Enter small description" class="form-control mb-2"></textarea>
                            </div> -->
                            <div class="col-md-12">
                                <label class=mb-0 for="">Description</label>
                                <textarea rows="3" required name="description" placeholder="Enter description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class=mb-0 for="">Original Price</label>
                                <input type="text" required name="original_price" placeholder="Enter Original Price" class="form-control mb-2">  <!-- css will be found on header.php style  -->
                            </div>
                            <div class="col-md-6">
                                <label class=mb-0 for="">Selling Price</label>
                                <input type="text" required name="selling_price" placeholder="Enter Selling Price" class="form-control mb-2">  
                            </div>
                            <div class="col-md-12">
                                <label class=mb-0 for="">Upload Image</label>
                                <input type="file" required name="image" class="form-control mb-2">  
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class=mb-0 for="">Quantity</label>
                                    <input type="number" required name="qty" placeholder="Enter Quantity" class="form-control mb-2">  
                                </div>
                                <div class="col-md-3">
                                    <label class=mb-0 for="">Status</label>
                                    <input type="checkbox" name="status">  
                                </div>
                                <div class="col-md-3">
                                    <label class=mb-0 for="">Trending</label>
                                    <input type="checkbox" name="trending">  
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class=mb-0 for="">Meta Title</label>
                                <input type="text" required name="meta_title" placeholder="Enter meta title" class="form-control mb-2">  
                            </div>
                            <div class="col-md-12">
                                <label class=mb-0 for="">Meta Description</label>
                                <textarea rows="3" required name="meta_description" placeholder="Enter meta description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class=mb-0 for="">Meta Keywords</label>
                                <textarea rows="3" required name="meta_keywords" placeholder="Enter meta keywords" class="form-control mb-2"></textarea>
                            </div>
                           
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>