<footer class="footer pt-5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-12">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">Services</a>
              </li>
              <li class="nav-item"> 
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
</footer>
    </main>

    <script src="assets/js/jquery-3.6.6.min.js"></script> <!-- jQuery, if didn't work then try 3.6.0-->
    <script src="assets/js/bootstrap.bundle.min.js"></script> <!-- includes bootstrap and popper -->
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script src="assets/js/smooth-scrollbar.min.js"></script>
    
    <!-- SWEET ALERT for action confirmation -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script src="assets/js/custom.js"></script>



    <!-- ALERTIFY JS - will be use for Redirection -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script> //Alertify JS code 
        <?php 
        if(isset($_SESSION['message'])) 
        { 
          ?> 
          alertify.set('notifier','position', 'top-right');
          alertify.success('<?= $_SESSION['message']; ?>'); //the less than ?= before $_SESSION means echo 
          <?php 
          unset($_SESSION['message']); //this will prevent the message "Category Added Successfully" to stop after it was succesfully added and will not repeat to appear everytime we refresh the page
        } 
        ?>
    </script>

</body>
</html>