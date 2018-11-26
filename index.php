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

    <!-- Start add customers -->
    <div class="customers-add">
      <div class="container">
        <div class="row">
          <form>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail3" class="col-xs-2 control-label">Email</label>
                <div class="col-xs-8">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="inputPassword3" class="col-xs-2 control-label">Password</label>
                <div class="col-xs-8">
                  <input type="text" class="form-control" id="inputPassword3" placeholder="Password">
                </div>
              </div>
            </div>
          </form>
        </div>
        <!--  -->
        <ul class="nav nav-tabs nav-justified" role="tablist" style="margin-top: 30px;">
          <li class="active" role="presentation">
            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a>
          </li>
          <li role="presentation">
            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
          </li>
          <li role="presentation">
            <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a>
          </li>
        </ul>
        <!--  -->

        <div class="tab-content">
          <div class="tab-pane active" id="home" role="tabpanel">
            <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores quo aut aliquam suscipit facere cupiditate, in facilis labore similique repellat sint blanditiis omnis error soluta iste, eum odio praesentium at!</h3>
          </div>
          <div class="tab-pane" id="profile" role="tabpanel">
            <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur vitae perspiciatis ducimus, laudantium reprehenderit! Libero molestiae nesciunt debitis sapiente quidem, natus, fugiat, tempora adipisci quam eveniet velit odit. Hic, nostrum.</h3>
          </div>
          <div class="tab-pane" id="messages" role="tabpanel">
            <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam repellat nostrum odit reiciendis, omnis autem placeat? Ab, voluptates facere quam dolorum tenetur labore quos ipsam culpa amet, iure voluptatibus nisi!</h3>
          </div>
        </div>
        <!--  -->
      </div>
    </div>
    <!-- End add customers -->

    <!--  Start Customers grid -->
    <div class="_customers-view customers-grid">
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
    <div class="_customers-view customers-list">
      <div class="container">
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
  </div>
