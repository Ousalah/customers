<?php
  session_start();
  $pageTitle = 'Petit Bateau - Clients';

  include "init.php";

?>
  <body>
    <!-- Start Header -->
    <div class="top-nav">
      <div class="container">Logout</div>
    </div>
    <div class="man-nav">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="breadcrumb"><span>Customers</span></div>
          </div>
          <div class="col-sm-6">
            <div class="breadcrumb"><input type="search"></div>
          </div>
          <div class="col-sm-6">
            <div class="breadcrumb"><button class="btn btn-success">Create</button></div>
          </div>
          <div class="col-sm-6">
            <div class="breadcrumb">
              <span class="pull-left">
                1-10/50
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
              </span>
              <span class="pull-right">
                <i class="fa fa-th-list" aria-hidden="true"></i>
                <i class="fa fa-th-large" aria-hidden="true"></i>
              </span>
              <span class="clearfix"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Header -->

    <!--  Start Customers grid -->
    <div class="customers-grid">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="customer-grid">
              <div class="customer-details text-center">
                <h3 class="fullname"><i class="fa fa-user"></i> the full name</h3>
                <p><i class="fa fa-map-marker"></i> here is the address of the customer</p>
                <p><i class="fa fa-phone"></i> 06 62 662 660</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="customer-grid">
              <div class="customer-details text-center">
                <h3 class="fullname"><i class="fa fa-user"></i> the full name</h3>
                <p><i class="fa fa-map-marker"></i> here is the address of the customer</p>
                <p><i class="fa fa-phone"></i> 06 62 662 660</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="customer-grid">
              <div class="customer-details text-center">
                <h3 class="fullname"><i class="fa fa-user"></i> the full name</h3>
                <p><i class="fa fa-map-marker"></i> here is the address of the customer</p>
                <p><i class="fa fa-phone"></i> 06 62 662 660</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="customer-grid">
              <div class="customer-details text-center">
                <h3 class="fullname"><i class="fa fa-user"></i> the full name</h3>
                <p><i class="fa fa-map-marker"></i> here is the address of the customer</p>
                <p><i class="fa fa-phone"></i> 06 62 662 660</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="customer-grid">
              <div class="customer-details text-center">
                <h3 class="fullname"><i class="fa fa-user"></i> the full name</h3>
                <p><i class="fa fa-map-marker"></i> here is the address of the customer</p>
                <p><i class="fa fa-phone"></i> 06 62 662 660</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="customer-grid">
              <div class="customer-details text-center">
                <h3 class="fullname"><i class="fa fa-user"></i> the full name</h3>
                <p><i class="fa fa-map-marker"></i> here is the address of the customer</p>
                <p><i class="fa fa-phone"></i> 06 62 662 660</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="customer-grid">
              <div class="customer-details text-center">
                <h3 class="fullname"><i class="fa fa-user"></i> the full name</h3>
                <p><i class="fa fa-map-marker"></i> here is the address of the customer</p>
                <p><i class="fa fa-phone"></i> 06 62 662 660</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  End Customers grid -->

    <!--  Start -->
    <!-- <form class="" action="controller/Customers.php?t=client&a=add" method="post"> -->
    <!-- <form class="" action="controller/Customers.php?t=ztest&a=add" method="post"> -->
      <!-- <input type="text" name="username"> -->
      <!-- <input type="text" name="client">
      <input type="text" name="code_clt" value="0000208">
      <input type="submit" value="save">

    </form> -->
    <!-- End  -->

    <?php include $tpl . "footer.php"; ?>
