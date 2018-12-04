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
            <form class="zones form-horizontal" action="index.php" method="get">
              <div class="search-form">
                <input type="text" class="search form-control" placeholder="Search.." name="s">
                <button type="submit"><i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
          <div class="col-sm-6">
            <div class="zones">
              <div class="actions">
                <div class="actions-view main-view">
                  <button class="btn btn-success btn-create">Create</button>
                  <button class="btn btn-transparent btn-transparent-success btn-import">Import</button>
                </div>
                <div class="actions-view add-view">
                  <button class="btn btn-success btn-save">Save</button>
                  <button class="btn btn-transparent btn-transparent-success btn-discard">Discard</button></div>
                <div class="actions-view edit-view"></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="zones">
              <div class="navigations">
                <span class="pull-left">
                  <span class="customers-count-min">0</span>-<span class="customers-count-max">0</span> /
                  <span class="customers-count-total">0</span>
                </span>
                <span class="paginations-buttons">
                  <i class="fa fa-backward paginations pagination-first" data-page="1" aria-hidden="true"></i>
                  <i class="fa fa-chevron-left paginations pagination-prev" data-page="1" aria-hidden="true"></i>
                  <input type="text" class="btn-xs pagination-current" data-page="1" value="1">
                  <i class="fa fa-chevron-right paginations pagination-next" data-page="1" aria-hidden="true"></i>
                  <i class="fa fa-forward paginations pagination-last" data-page="1" aria-hidden="true"></i>
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
          <!-- start main form -->
          <div class="main-form">
            <!--  start lef form -->
            <div class="col-md-6">
              <div class="left-form">
                <div class="form-group has-feedback">
                  <label class="col-xs-2 control-label">Ref</label>
                  <div class="col-xs-4">
                    <input type="text" class="form-control" name="code_clt" placeholder="0123456" value="0000210" readonly>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label for="client" class="col-xs-2 control-label">Client</label>
                  <div class="col-xs-9">
                    <input type="text" class="form-control" id="client" name="client" placeholder="Client Name">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label for="e_mail" class="col-xs-2 control-label">Email</label>
                  <div class="col-xs-9">
                    <input type="text" class="form-control" id="e_mail" name="e_mail" placeholder="name@mail.com">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- end left form -->

            <!-- start right form -->
            <div class="col-md-6">
              <div class="right-form">
                <div class="form-group has-feedback">
                  <label for="tel" class="col-xs-2 control-label">Phone</label>
                  <div class="col-xs-9">
                    <input type="tel" class="form-control" id="tel" name="tel" placeholder="0612345678">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label for="fax" class="col-xs-2 control-label">Fax</label>
                  <div class="col-xs-9">
                    <input type="tel" class="form-control" id="fax" name="fax" placeholder="0522000000">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label for="mobile" class="col-xs-2 control-label">Mobile</label>
                  <div class="col-xs-9">
                    <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="0612345678">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- end right form -->
          </div>
          <!-- end main form -->

          <!-- start nav tabs -->
          <div class="nav-tab-container">
            <ul class="nav nav-tabs" role="tablist">
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
                    <a href="#address-livraison" aria-controls="address-livraison" role="tab" data-toggle="tab">livraison</a>
                  </li>
                  <li>
                    <a href="#address-facturation" aria-controls="address-facturation" role="tab" data-toggle="tab">facturation</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <!-- end nav tabs -->

          <!-- start tab content -->
          <div class="tab-content">
            <!-- start fidelity management -->
            <div class="tab-pane active" id="fidelity-management" role="tabpanel">
              <div class="form-group has-feedback">
                <label for="codebadge" class="col-xs-2 control-label">Code Badge</label>
                <div class="col-xs-4">
                  <input type="text" class="form-control" id="codebadge" name="codebadge" placeholder="Code Badge">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-2 control-label">Avantage</label>
                <div class="col-xs-6">
                  <div class="radio">
                    <label for="avantage-0">
                      <input type="radio" name="avantage" id="avantage-0" value="1" checked="checked">
                      Aucun (Encours d'étude)
                    </label>
                  </div>
                  <div class="radio">
                    <label for="avantage-1">
                      <input type="radio" name="avantage" id="avantage-1" value="2">
                      Client fidéle et peut avoir crédit
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- end fidelity management -->

            <!-- start commentaire -->
            <div class="tab-pane" id="commentaire" role="tabpanel">
              <textarea class="form-control" name="commentaire" rows="4" cols="80" placeholder="Commentaire"></textarea>
            </div>
            <!-- end commentaire -->

            <!-- start shipping address  -->
            <div class="tab-pane" id="address-livraison" role="tabpanel">
              <div class="form-group">
                <label for="adresse1liv" class="col-xs-2 control-label">Address Livraison</label>
                <div class="col-xs-10">
                  <input type="text" class="form-control" id="adresse1liv" name="adresse1liv" placeholder="Address Livraison 1">
                  <input type="text" class="form-control" name="adresse2liv" placeholder="Address Livraison 2">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-5 col-xs-offset-2">
                  <input type="text" class="form-control" name="cpliv" placeholder="Code Postale">
                </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control" name="villeliv" placeholder="Ville">
                </div>
              </div>
            </div>
            <!-- end shipping address  -->

            <!-- start billing address  -->
            <div class="tab-pane" id="address-facturation" role="tabpanel">
              <div class="form-group">
                <label for="adresse1fact" class="col-xs-2 control-label">Address Facturation</label>
                <div class="col-xs-10">
                  <input type="text" class="form-control" id="adresse1fact" name="adresse1fact" placeholder="Address Facturation 1">
                  <input type="text" class="form-control" name="adresse2fact" placeholder="Address Facturation 2">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-5 col-xs-offset-2">
                  <input type="text" class="form-control" name="cpfact" placeholder="Code Postale">
                </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control" name="villefact" placeholder="Ville">
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
      <div class="retry-btn">
        <div class="container">
          <button class="btn btn-dark btn-sm">retry</button>
        </div>
      </div>
      <!-- end retry button -->
      <div class="customers-grid-content"></div>
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
              <thead></thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--  End customers list-->

    <?php include $tpl . "footer.php"; ?>
