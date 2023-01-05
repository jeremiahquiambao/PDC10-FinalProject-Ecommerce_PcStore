 <!-- JQuery -->
 <script src="assets/js/jquery-3.6.1.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/custom.js"></script>

<!-- ALERTIFY JS - will be use for Redirection -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script> //Alertify JS code 

    alertify.set('notifier','position', 'top-right'); //this will just set the position of the alertify
    <?php 
        if(isset($_SESSION['message'])) 
        { 
            ?> 
                alertify.success('<?= $_SESSION['message']; ?>'); //the less than ?= before $_SESSION means echo    
            <?php  
                unset($_SESSION['message']); //this will prevent the redirecting message to stop after it was succesfully added and will not repeat to appear everytime we refresh the page
        } 
    ?>
</script>


</body>
</html>