<?php 
  /* 
  $_SERVER is a PHP super global variable which holds information about headers, paths, and script locations.
  $_SERVER['SCRIPT_NAME']	Returns the path of the current script
  substr() function returns a part of a string.
  The strrpos() function finds the position of the last occurrence of a string inside another string.
  */
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1); //this will result to index.php
?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="index.php">
        <img src="assets/images/virus.png" class="navbar-brand-img h-100" alt="main_logo"> 
        <span class="ms-1 font-weight-bold text-white">Techno Hub</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white <?= $page == "index.php"? 'active bg-gradient-primary':'' ?>" href="index.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link text-white <?= $page == "category.php"? 'active bg-gradient-primary':'' ?>" href="category.php"> <!-- if the page equals to category.php (when user click the category) then it will echo active bg-gradient primary(the active link) -->
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">All Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page == "add-category.php"? 'active bg-gradient-primary':'' ?>" href="add-category.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">add</i>
            </div>
            <span class="nav-link-text ms-1">Add Category</span>
          </a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link text-white <?= $page == "products.php"? 'active bg-gradient-primary':'' ?>" href="products.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">All Products</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page == "add-product.php"? 'active bg-gradient-primary':'' ?>" href="add-product.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">add</i>
            </div>
            <span class="nav-link-text ms-1">Add Products</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" 
        href="../logout.php">
        Log out
        </a>
      </div>
    </div>
  </aside>