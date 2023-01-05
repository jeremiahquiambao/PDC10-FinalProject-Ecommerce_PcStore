$(document).ready(function() {

    //Click Event for Delete Button in Product
    $(document).on('click', '.delete_product_btn', function (e) {     
        e.preventDefault();

        var id = $(this).val();
        //alert(id);

        //Sweet Alert Message for Action confirmation 
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: "POST",
                    url: "code.php", //will send it to code.php, custom.js will be included in the products.php
                    data: { //will pass the product id and button name 
                        'product_id':id,
                        'delete_product_btn': true
                    },
                    success: function (response) {
                        if(response == 200)
                        {
                            swal("Success!", "Product Deleted Successfully!", "success"); //heading(success), message(deleted), icon(success)
                            $("#products_table").load(location.href + " #products_table"); //#products_table should have space after opening string or else it will not work. If something goes wrong then that means no data has been deleted - which means don't need to reload 
                        }
                        else if (response == 500)
                        {
                            swal("Error!", "Something went wrong!", "error"); //heading(success), message(deleted), icon(success)
                        }
                    }
                });
            } 
          });
    });

    //Click Event for Delete Button in Category
    $(document).on('click', '.delete_category_btn', function (e) {        
        e.preventDefault();

        var id = $(this).val();
        //alert(id);

        //Sweet Alert Message for Action confirmation 
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: "POST",
                    url: "code.php", //will send it to code.php, custom.js will be included in the products.php
                    data: { //will pass the product id and button name 
                        'category_id':id,
                        'delete_category_btn': true
                    },
                    success: function (response) {
                        if(response == 200)
                        {
                            swal("Success!", "Product Deleted Successfully!", "success"); //heading(success), message(deleted), icon(success)
                            $("#category_table").load(location.href + " #products_table"); //#products_table should have space after opening string or else it will not work. If something goes wrong then that means no data has been deleted - which means don't need to reload 
                        }
                        else if (response == 500)
                        {
                            swal("Error!", "Something went wrong!", "error"); //heading(success), message(deleted), icon(success)
                        }
                    }
                });
            } 
          });
    });

});