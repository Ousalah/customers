$(function () {
  "use strict";

  // start switch between list and grid view
  $(".main-header .navigations .view-mode i").on("click", function() {
    if (!$(this).hasClass("active")) {
      $(this).toggleClass("active").siblings("i").removeClass("active");
      $("." + $(this).data("class")).fadeIn().siblings("._customers-view").hide();
    }
  });
  // end switch between list and grid view

  // start
  var $actionsView = (".zones .actions .actions-view");
  function showMainView() {
    // hide add view and show main view
    $($actionsView).hide().siblings(".main-view").show();
    // show active customers-view
    $("." + $(".main-header .navigations .view-mode i.active").data("class")).show().siblings("._customers-view").hide();
    // hide customers add form
    $(".customers-add").hide();
    // show navigations and form section
    $(".main-header .zones .search-form, .main-header .zones .navigations").show();
    // reset form
    $('.form-add-customers').trigger("reset");
  }

  $($actionsView + " .btn-create").on("click", function () {
    $($actionsView).hide().siblings(".add-view").show();
    $("._customers-view").hide();
    $(".customers-add").show();
    $(".main-header .zones .search-form, .main-header .zones .navigations").hide();
    // start get the next client
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      dataType: "json",
      data: {
        a: "nextid",
        args: { table: "Z_TEST_CLIENT", primaryKey: 'code_clt' },
      },
    })

    .done(function(data) {
      console.log(data);
      $(".form-add-customers input[name='code_clt']").val(data);
      console.log("success msg here");
    })

    .fail(function(data) {
      console.log(data);
      console.log("fail msg here");
    });
    // end get the next client
  });

  $($actionsView + " .btn-discard").on("click", function () {
    showMainView();
  });
  // end

  // start add customer info
  function addCustomers() {
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      data: {
        a: "add",
        t: "Z_TEST_CLIENT",
        customerInfo : $(".form-add-customers").serialize()
      },
      beforeSend : function(){
      }
    })

    .done(function(data) {
      console.log(data);
      $('#table-customers-list').DataTable().destroy();
      getCustomers();
      showMainView();
      console.log("success msg here");
    })

    .fail(function(data) {
      console.log("fail msg here");
    });
  }

  $(".zones .actions .add-view .btn-save").on("click", function () {
    addCustomers();
  });
  // end add customer info

  // start datatables
  function datatablesInit() {
    $('#table-customers-list').DataTable({
      stateSave: true,
      responsive: true,
      fixedHeader: true,
      paging: false,
      searching: false,
      info: false,
      columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 3, targets: 1 },
        { responsivePriority: 4, targets: 2 },
        { responsivePriority: 5, targets: 24 },
        { responsivePriority: 2, targets: -1, orderable: false }
      ],
      aaSorting: [0,'desc']
    });
  }
  // end datatables

  function getCustomers() {
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      dataType: "json",
      data: {
        a: "get",
        args: { table: "Z_TEST_CLIENT", orderBy:'code_clt', orderType: 'DESC' },
      },
      beforeSend : function(){
        $('#table-customers-list thead').html("");
        $('#table-customers-list tbody').html("");
        $('.customers-list').addClass('spinner');
        // $('.customers-grid').html("");
        $('.customers-grid').addClass('spinner');

      }
    })

    .done(function(data) {
      $('.customers-list').removeClass('spinner');
      $('.customers-grid').removeClass('spinner');

      var thead = "<tr>";
      for (var c in data.column) {
        thead += "<th>" + data.column[c] + "</th>";
      }
      thead +="<th>Action</th></tr>";
      $('#table-customers-list thead').html( thead );

      var tbody = "";
      var customerGrid = '<div class="container"><div class="row">';

      for (var i in data.customer) {
        var customer = data.customer[i];
        tbody += "<tr>";

        // check if is not null client name, then set data to 'customerGrid'
        if (customer.CLIENT) {
          customerGrid += '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
          customerGrid += '<div class="customer-grid">';
          customerGrid += '<div class="customer-details text-center">';
          customerGrid += '<h3 class="fullname"><i class="fa fa-user"></i> ' + customer.CLIENT + '</h3>';
          if (customer.TEL) customerGrid += '<p><i class="fa fa-map-marker"></i> ' + customer.TEL + '</p>';
          if (customer.ADRESSE1LIV) customerGrid += '<p><i class="fa fa-phone"></i> ' + customer.ADRESSE1LIV + '</p>';
          customerGrid += '</div></div></div>';
        }

        for (var c in data.column) {
          var column = data.column[c];
          tbody += "<td>" + customer[column] + "</td>";
        }

        tbody += '<td>';
        tbody += '<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></a>';
        tbody += ' <a href="#" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>';
        tbody += ' <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>';
        tbody += '</td></tr>';
      }

      customerGrid += "</div></div>"

      $('#table-customers-list tbody').html( tbody );
      datatablesInit();

      $('.customers-grid > .customers-grid-content').html( customerGrid );
    })

    .fail(function(data) {
      console.log("error ");
      $('.customers-list').removeClass('spinner');
      $('.customers-grid').removeClass('spinner');
      $('.customers-list .retry-btn').show();
      $('.customers-grid .retry-btn').show();
    });
  }

  // onload get customers
  getCustomers();

  // on click retry button get customers
  $(".retry-btn").on("click", function() {
    $('.customers-list .retry-btn').hide();
    $('.customers-grid .retry-btn').hide();
    getCustomers();
  });

});
