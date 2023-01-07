<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
            if(isset($_GET['id'])) //Will check if the id is set in url or not 

            {
                $id = $_GET['id'];
                $category = getByID("categories", $id);

                if(mysqli_num_rows($category) > 0) //will check if there's any record with that id then we're going to execute below
                {
                    $data = mysqli_fetch_array($category);
                    ?>  
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Category
                                    <a href="category.php" class="btn btn-primary float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data"> <!-- enctype is used in form element that have a file upload, in this form that we created it's uploading the image,-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                            <label for="">Name</label>
                                            <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name" class="form-control">  <!-- css will be found on header.php style  -->
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Slug</label>
                                            <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter slug" class="form-control">  
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Description</label>
                                            <textarea rows="3" name="description" placeholder="Enter description" class="form-control"><?= $data['description'] ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Upload Image</label>
                                            <input type="file" name="image" class="form-control">
                                            <label for="">Current Image</label> 
                                            <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                            <img src="../uploads/<?= $data['image'] ?>" height="50px" width="50px" alt=""> 
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Meta Title</label>
                                            <input type="text" name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Enter meta title" class="form-control">  
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Meta Description</label>
                                            <textarea rows="3" name="meta_description" placeholder="Enter meta description" class="form-control"><?= $data['meta_description'] ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Meta Keywords</label>
                                            <textarea rows="3" name="meta_keywords" placeholder="Enter meta keywords" class="form-control"><?= $data['meta_keywords'] ?></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Hidden</label>
                                             <input type="checkbox" <?= $data['status'] ? "checked":"" ?> name="status"> <!--if it's true that means it's 1, then we have to keep it checked or print it checked, else leave it like that  -->
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Popular</label>
                                            <input type="checkbox" <?= $data['popular'] ? "checked":"" ?> name="popular">  
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    <?php
                }
                else
                {
                    echo "Category not found";
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