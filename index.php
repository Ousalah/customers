<?php
  session_start();
  $pageTitle = 'Petit Bateau - Clients';

  include_once "init.php";

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
                  <i class="fa fa-th-list list-view active" data-class="customers-list" aria-hidden="true"></i>
                  <i class="fa fa-th-large grid-view" data-class="customers-grid" aria-hidden="true"></i>
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
    <div class="_customers-view customers-grid">
        <!-- start retry button -->
        <div class="container">
          <div class="retry-btn">
            <button class="btn btn-dark btn-sm">retry</button>
          </div>
        </div>
        <!-- end retry button -->
    </div>
    <!--  End Customers grid -->

    <!--  Start customers list-->
    <div class="_customers-view customers-list">
      <div class="container">
        <!-- start retry button -->
        <div class="retry-btn">
          <button class="btn btn-dark btn-sm">retry</button>
        </div>
        <!-- end retry button -->
        <div class="row">
          <div class="col-xs-12">
            <table id="table-customers-list" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>Client</th>
                  <th>Telephone</th>
                  <th>Fax</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>
                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>
                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
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
