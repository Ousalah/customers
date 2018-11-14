<?php
  session_start();
  $pageTitle = 'Petit Bateau - Clients';

  include "init.php";

?>
  <body>
    <!-- Start Header -->
    <div class="main-nav">
      <div class="container">Logout</div>
    </div>
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="zones"><span class="main-breadcrumb">Customers</span></div>
          </div>
          <div class="col-sm-6">
            <form class="zones form-horizontal" action="" method="get">
              <input type="text" class="search form-control" placeholder="Search.." name="s">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <div class="col-sm-6">
            <div class="zones">
              <div class="actions">
                <button class="btn btn-success">Create</button>
                <button class="btn btn-transparent btn-transparent-success">Import</button>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="zones">
              <div class="navigations">
                <span class="pull-left">
                  1-10/50
                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                  <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </span>
                <span class="pull-right view-mode">
                  <i class="fa fa-th-large grid-view active" aria-hidden="true"></i>
                  <i class="fa fa-th-list list-view" aria-hidden="true"></i>
                </span>
                <span class="clearfix"></span>
              </div>
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

    <!--  Start customers list-->
    <div class="customers-list">
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Username</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!--  End customers list-->

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
