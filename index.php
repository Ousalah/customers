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
      <!-- start container -->
      <div class="container">
        <form class="form-add-customers form-horizontal">
          <!--  start lef form -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="code_clt" class="col-xs-2 control-label">Ref</label>
              <div class="col-xs-4">
                <input type="text" class="form-control" name="code_clt" placeholder="0123456" value="0000210" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="client" class="col-xs-2 control-label">Client</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" name="client" placeholder="Client Name">
              </div>
            </div>
            <div class="form-group">
              <label for="e_mail" class="col-xs-2 control-label">Email</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" name="e_mail" placeholder="name@mail.com">
              </div>
            </div>
          </div>
          <!-- end left form -->

          <!-- start right form -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="tel" class="col-xs-2 control-label">Phone</label>
              <div class="col-xs-9">
                <input type="tel" class="form-control" name="tel" placeholder="0612345678">
              </div>
            </div>
            <div class="form-group">
              <label for="fax" class="col-xs-2 control-label">Fax</label>
              <div class="col-xs-9">
                <input type="tel" class="form-control" name="fax" placeholder="0522000000">
              </div>
            </div>
            <div class="form-group">
              <label for="mobile" class="col-xs-2 control-label">Mobile</label>
              <div class="col-xs-9">
                <input type="tel" class="form-control" name="mobile" placeholder="0612345678">
              </div>
            </div>
          </div>
          <!-- end right form -->

          <!-- start nav tabs -->
          <ul class="nav nav-tabs nav-justifieed" role="tablist" style="margin-top: 30px;">
            <li class="active" role="presentation">
              <a href="#fidelity-management" aria-controls="fidelity-management" role="tab" data-toggle="tab">Gestion Fidélité</a>
            </li>
            <li role="presentation">
              <a href="#commentaire" aria-controls="commentaire" role="tab" data-toggle="tab">Commentaire</a>
            </li>
            <li role="presentation" class="dropdown">
              <a href="#" class="dropdown-toggle" id="myTabDrop1" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="true">
                address <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                <li>
                  <a href="#address-livraison" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">livraison</a>
                </li>
                <li>
                  <a href="#address-facturation" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">facturation</a>
                </li>
              </ul>
            </li>
          </ul>
          <!-- end nav tabs -->

          <!-- start tab content -->
          <div class="tab-content">
            <!-- start fidelity management -->
            <div class="tab-pane active" id="fidelity-management" role="tabpanel" aria-labelledby="fidelity-management-tab">
              <div class="form-group">
                <label for="code_clt" class="col-xs-2 control-label">Code Badge</label>
                <div class="col-xs-4">
                  <input type="text" class="form-control" nameD="code_badge" placeholder="0123456">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="avantage">Avantage</label>
                <div class="col-md-4">
                  <div class="radio">
                    <label for="avantage-0">
                      <input type="radio" nameD="avantage" id="avantage-0" value="1" checked="checked">
                      Aucun (Encours d'étude)
                    </label>
                  </div>
                  <div class="radio">
                    <label for="avantage-1">
                      <input type="radio" nameD="avantage" id="avantage-1" value="2">
                      Client fidéle et peut avoir crédit
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- end fidelity management -->

            <!-- start commentaire -->
            <div class="tab-pane" id="commentaire" role="tabpanel">
              <textarea name="commentaire" rows="8" cols="80" placeholder="Commentaire"></textarea>
            </div>
            <!-- end commentaire -->

            <!-- start shipping address  -->
            <div class="tab-pane" id="address-livraison" role="tabpanel">
              <div class="form-group">
                <label for="client" class="col-xs-2 control-label">Address Livraison</label>
                <div class="col-xs-10">
                  <input type="text" class="form-control" name="adresse1liv" placeholder="Client Name">
                  <input type="text" class="form-control" name="adresse2liv" placeholder="Client Name">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="code_clt" class="col-xs-2 control-label">Code Postale</label>
                  <div class="col-xs-5">
                    <input type="text" class="form-control" name="cpliv" placeholder="0123456">
                  </div>
                </div>
                <div class="col-xs-6">
                  <label for="code_clt" class="col-xs-2 control-label">Ville</label>
                  <div class="col-xs-5">
                    <input type="text" class="form-control" name="villeliv" placeholder="0123456">
                  </div>
                </div>
              </div>
            </div>
            <!-- end shipping address  -->

            <!-- start billing address  -->
            <div class="tab-pane" id="address-facturation" role="tabpanel">
              <div class="form-group">
                <label for="client" class="col-xs-2 control-label">Address Facturation</label>
                <div class="col-xs-10">
                  <input type="text" class="form-control" name="adresse1fact" placeholder="Client Name">
                  <input type="text" class="form-control" name="adresse2fact" placeholder="Client Name">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="code_clt" class="col-xs-2 control-label">Code Postale</label>
                  <div class="col-xs-5">
                    <input type="text" class="form-control" name="cpfact" placeholder="0123456">
                  </div>
                </div>
                <div class="col-xs-6">
                  <label for="code_clt" class="col-xs-2 control-label">Ville</label>
                  <div class="col-xs-5">
                    <input type="text" class="form-control" name="villefact" placeholder="0123456">
                  </div>
                </div>
              </div>
            </div>
            <!-- end billing address  -->
          </div>
          <!-- end tab content -->
        </form>
      </div>
      <!-- end container -->
    </div>
    <!-- End add customers -->

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
  </div>
