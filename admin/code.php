<?php 

session_start();
include('../config/dbcon.php'); //import the database connection
include('../functions/myfunctions.php'); //function for redirection of user that will use in else statement in checking if $cate_query_run runs successfullu  

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0' ; // "?" is a ternary operator which is a shorthand for the if..else statement, if it's TRUE it will insert '1' else it will insert '0' 
    $popular = isset($_POST['popular']) ? '1':'0' ;

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    //This will give us the image extension, pathinfo() returns information about path 
    $image_ext = pathinfo($image, PATHINFO_EXTENSION); 

    //This will redeem the file 
    $filename = time().'.'.$image_ext; 

    //Query to insert the category data in the database 
    $cate_query = "INSERT INTO categories 
    (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image)
    VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular', '$filename')";

    //Write the category query run variable to run the mysqlite query function 
    $cate_query_run = mysqli_query($con, $cate_query);

    //If condition to check if $cate_query_run will run succesfully 
    if($cate_query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename); //move_uploaded_file() function moves an uploaded file to a new destination. Note: This function only works on files uploaded via PHP's HTTP POST upload mechanism. Note: If the destination file already exists, it will be overwritten.

        redirect("add-category.php", "Category Added Successfully");
    }
    else //if the query does not run successully, there will an error, we're just going to redirect the user back to the add-category page
    {
        redirect("add-category.php", "Something Went Wrong");
    }
}
else if(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0' ; // "?" is a ternary operator which is a shorthand for the if..else statement, if it's TRUE it will insert '1' else it will insert '0' 
    $popular = isset($_POST['popular']) ? '1':'0' ;

    //it is not necessary for admin to update the image also
    $new_image = $_FILES['image']['name']; 
    $old_image = $_POST['old_image'];

    if($new_image != "") //if $new_image is not equal to null or if the admin uploaded new_image then it will going to update in the database else the old_name itself we'll just upload it in the database
    {
        // $update_filename = $new_image;
        //This will give us the image extension, pathinfo() returns information about path 
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION); //we've passed the $new_image here
        $update_filename = time().'.'.$image_ext; //This will rename the new file 

    }
    else 
    {
        $update_filename = $old_image;
    }

    $path = "../uploads";

    //Once done in process, we'll update the database
    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id' "; 

    $update_query_run = mysqli_query($con, $update_query);

    //will check if the $update_query_run is running successfully 
    if($update_query_run)
    {
        if($_FILES['image']['name'] != "") //will check if there's a new file, if there's a new file then it will move the new file in the folder
        {
            //will move the uploaded new file in the folder
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename); //move_uploaded_file() function moves an uploaded file to a new destination. Note: This function only works on files uploaded via PHP's HTTP POST upload mechanism. Note: If the destination file already exists, it will be overwritten.
            if(file_exists("../uploads/".$old_image)) //if file already existing then it will overwrite by the new image
            {
                unlink("../uploads/".$old_image); //will delete the past image associated in that category
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Updated Successfully"); //will redirect back to current editing category after clicking update button   
    }
    else 
    {
        redirect("edit-category.php?id=$category_id", "Something went wrong"); //will redirect back to current editing category if $update_query_run does not work 
    }
}
else if(isset($_POST['delete_category_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id='$category_id' ";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    //If condition to check if $delete_query_run will run succesfully 
    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image)) //if file exists inside uploads folder with the $image name then just delete it 
        {
            unlink("../uploads/".$image); //will delete image
        }   
        redirect("category.php", "Category deleted Successfully"); 
    }
    else
    {
        redirect("category.php", "Something went wrong"); 
    }
}

else if(isset($_POST['add_product_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    // $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0' ; // "?" is a ternary operator which is a shorthand for the if..else statement, if it's TRUE it will insert '1' else it will insert '0' 
    $trending = isset($_POST['trending']) ? '1':'0' ;

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    //This will give us the image extension, pathinfo() returns information about path 
    $image_ext = pathinfo($image, PATHINFO_EXTENSION); 

    //This will redeem the file 
    $filename = time().'.'.$image_ext; 

    //Server-side validation part which we don't want to allow null in these fields before inserting it in the database 
    if($name != "" && $slug != "" && $description != "") 
    {
        $product_query = "INSERT INTO products (category_id, name, slug, description, original_price, selling_price, qty, meta_title, meta_description, meta_keywords, status, trending, image) VALUES ('$category_id', '$name', '$slug', '$description', '$original_price', '$selling_price', '$qty', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$trending', '$filename')";

        //SQL Query function 
        $product_query_run = mysqli_query($con, $product_query);

        if($product_query_run) //if product_query_run run successfully then we're going to move the image into our folder
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename); //we're putting the file in the $path, the $path is in the uploads folder along with the $filename, with the $filename we're just pushing it in the uploads folder.  move_uploaded_file() function moves an uploaded file to a new destination. Note: This function only works on files uploaded via PHP's HTTP POST upload mechanism. Note: If the destination file already exists, it will be overwritten.

            redirect("add-product.php", "Product Added Successfully");
        }
        else
        {
            redirect("add-product.php", "Something went wrong");
        }
    }
    else
    {
        redirect("add-product.php", "Please complete all fields.");
    }

}

else if(isset($_POST['update_product_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    // $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0' ; // "?" is a ternary operator which is a shorthand for the if..else statement, if it's TRUE it will insert '1' else it will insert '0' 
    $trending = isset($_POST['trending']) ? '1':'0' ;

    $path = "../uploads";
    
    //it is not necessary for admin to update the image also
    $new_image = $_FILES['image']['name']; //fetching the filename
    $old_image = $_POST['old_image']; //fetching the value of old_image from the input type:hidden/edit-product.php to $old_image variable

    if($new_image != "") //if $new_image is not equal to null or if the admin uploaded new_image then it will going to update in the database else the old_name itself we'll just upload it in the database
    {
        // $update_filename = $new_image;
        //This will give us the image extension, pathinfo() returns information about path 
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION); //we've passed the $new_image here
        $update_filename = time().'.'.$image_ext; //This will rename the new file 

    }
    else 
    {
        $update_filename = $old_image; //we're just giving the old filename in the $update_filename variable
    }
    
    //Query to update the database
    $update_product_query = "UPDATE products SET category_id='$category_id', name='name', slug='$slug', description='$description',  "
}

else //if someone tries to access this access code.php without any conditions above, then we'll just redirect them back to homepage
{
    header('Location: ../index.php');
}

?>  