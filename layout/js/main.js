$(function () {
  "use strict";
  var customerTable = "Z_TEST_CLIENT";

  // start switch between list and grid view
  $(".main-header .navigations .view-mode i").on("click", function() {
    if (!$(this).hasClass("active")) {
      $(this).toggleClass("active").siblings("i").removeClass("active");
      $("." + $(this).data("class")).fadeIn().siblings("._customers-view").hide();
    }
  });
  $(".main-header .navigations .view-mode i[data-class='customers-list']").on("click", function () {
    $('#table-customers-list').DataTable().destroy();
    datatablesInit();
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
    // reset nav-tabs and tab-content
    $("ul.nav-tabs li, .tab-content .tab-pane").removeClass("active").eq(0).addClass("active");
    $(".tab-content .tab-pane").removeClass("active").eq(0).addClass("active");
    // reset breadcrumb
    $(".main-header .zones .main-breadcrumb").html('Clients');
  }

  // start get the nextid of client
  function getNextId() {
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      dataType: "json",
      data: {
        a: "nextid",
        args: { table: customerTable, primaryKey: 'code_clt' },
      },
    })

    .done(function(data) {
      var $codeClt    = $(".form-add-customers input[name='code_clt']");
      var $msg        = $codeClt.find('.help-block');
      var $fieldTitle = $codeClt.data("title");
      var $parent     = $codeClt.closest(".form-add-customers .form-group.has-feedback");

      $codeClt.attr('value', data);
      var $codeCltVal = $codeClt.val();

      if ($codeCltVal) {
        var isFound = isExist('code_clt', $codeCltVal);
        if (isFound) {
          resetFormDefaultClass($parent);
          $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
          $msg.html($fieldTitle + " existe déjà.");
        } else {
          resetFormDefaultClass($parent);
          $parent.addClass("has-success").find('span.form-control-feedback').addClass("glyphicon-ok");
          $msg.html("");
        }
      } else {
        resetFormDefaultClass($parent);
        $parent.addClass("has-warning").find('span.form-control-feedback').addClass("glyphicon-warning-sign");
        $msg.html($fieldTitle + " est obligatoire.");
      }

      console.log("success msg here ");
    })

    .fail(function(data) {
      console.log(data);
      console.log("fail msg here");
    });
  }
  // call on onload
  // getNextId();
  // end get the nextid of client

  $($actionsView + " .btn-create").on("click", function () {
    $($actionsView).hide().siblings(".add-view").show();
    $("._customers-view").hide();
    $(".customers-add").show();
    $(".customers-add").attr("data-action", "add");
    $(".main-header .zones .search-form, .main-header .zones .navigations").hide();
    $(".main-header .zones .main-breadcrumb").html('<a href="#" class="main-page">Clients</a> / Nouveau');

    var $codeCltVal = $(".form-add-customers input[name='code_clt']").attr('value');
    // if (!$codeCltVal) {
    // }
    isEmptyRequiredFields();
    getNextId();
    isFormValid();
  });

  $($actionsView + " , .main-header .zones .main-breadcrumb").on("click", ".btn-discard, .main-page", function () {
    showMainView();
    resetFormDefaultClass($(".form-add-customers .form-group.has-feedback"), true);
  });
  // end

  // start search
  // declare searchVal and search as global to use it in pagination buttons
  var searchVal = "";
  var search = "";
  $(".main-header .zones .search-form .search").on("input", function () {
    searchVal = $.trim($(this).val());
    if (searchVal) {
      $(this).siblings("span").removeClass("fa-search").addClass("fa-remove");
      $('#table-customers-list').DataTable().destroy();
      search = [
        {key: '( code_clt', operator: 'LIKE', value: '%' + searchVal + '%', andOrOperator: 'OR'},
        {key: 'client', operator: 'LIKE', value: '%' + searchVal + '%', andOrOperator: 'OR'},
        {key: 'e_mail', operator: 'LIKE', value: '%' + searchVal + '%', andOrOperator: 'OR'},
        {key: 'tel', operator: 'LIKE', value: '%' + searchVal + '%', andOrOperator: 'OR'},
        {key: 'fax', operator: 'LIKE', value: '%' + searchVal + '%', andOrOperator: 'OR'},
        {key: 'mobile', operator: 'LIKE', value: '%' + searchVal + '%', andOrOperator: 'OR'},
        {key: 'codebadge', operator: 'LIKE', value: '%' + searchVal + '%', andOrOperator: ')'}
      ]
      getCustomers(1, 25, search);
    } else {
      $(this).siblings("span").removeClass("fa-remove").addClass("fa-search");
      $('#table-customers-list').DataTable().destroy();
      getCustomers();
    }
    console.log(searchVal);
  });

  $(".main-header .zones .search-form").on("click", ".fa-remove", function () {
    $(this).removeClass("fa-remove").addClass("fa-search").siblings(".search").val("");
    $('#table-customers-list').DataTable().destroy();
    getCustomers();
  });
  // end search

  // start on btn edit clicked
  $("#table-customers-list tbody, .customers-grid").on("click", "td .btn-edit, .customer-grid", function () {
    var codeClt = $.trim($(this).data("code"));
    var clientName = $.trim($(this).data("client"));
    console.log(codeClt);
    $($actionsView).hide().siblings(".edit-view").show();
    $("._customers-view").hide();
    $(".customers-edit").show();
    $(".customers-edit").attr("data-action", "edit");
    $(".main-header .zones .search-form, .main-header .zones .navigations").hide();
    $(".main-header .zones .main-breadcrumb").html('<a href="#" class="main-page">Clients</a> / ' + clientName);


    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      dataType: "json",
      data: {
        a: "edit",
        args: {
          table: customerTable,
          conditions: [{key: 'code_clt', operator: '=', value: codeClt}],
        },
      },
      beforeSend : function(){ }
    })

    .done(function(data) {
      $(".form-add-customers input[name='code_clt']").val(data[0].CODE_CLT);
      $(".form-add-customers input[name='client']").val(data[0].CLIENT);
      $(".form-add-customers input[name='e_mail']").val(data[0].E_MAIL);
      $(".form-add-customers input[name='tel']").val(data[0].TEL);
      $(".form-add-customers input[name='fax']").val(data[0].FAX);
      $(".form-add-customers input[name='mobile']").val(data[0].mobile);
      $(".form-add-customers input[name='codebadge']").val(data[0].codebadge);
      $(".form-add-customers input[name='avantage'][value='" + data[0].Avantage + "']").attr('checked', 'checked');
      $(".form-add-customers textarea[name='commentaire']").val(data[0].COMMENTAIRE);
      $(".form-add-customers input[name='adresse1liv']").val(data[0].ADRESSE1LIV);
      $(".form-add-customers input[name='adresse2liv']").val(data[0].ADRESSE2LIV);
      $(".form-add-customers input[name='cpliv']").val(data[0].CPLIV);
      $(".form-add-customers input[name='villeliv']").val(data[0].VILLELIV);
      $(".form-add-customers input[name='adresse1fact']").val(data[0].ADRESSE1FACT);
      $(".form-add-customers input[name='adresse2fact']").val(data[0].ADRESSE2FACT);
      $(".form-add-customers input[name='cpfact']").val(data[0].CPFACT);
      $(".form-add-customers input[name='villefact']").val(data[0].VILLEFACT);

      // start validate each fields
      $(".form-add-customers .form-group.has-feedback input").each(function () {
        var $field      = $(this);
        var $parent     = $field.closest(".form-add-customers .form-group.has-feedback");
        var $fieldName  = $field.attr('name');
        var $fieldVal   = $.trim($field.val());
        var $msg        = $field.siblings('.help-block');
        var $fieldTitle = $field.data("title");
        validatAllFields($fieldName, $fieldVal, $parent, $msg, $fieldTitle);
      });
      // end validate each fields

    })

    .fail(function(data) {
      console.log("edit fail msg here");
    });
  });
  // end on btn edit clicked

  // start function to check existense
  function isExist(field, value) {
    var output = true;

    // start check if action = add or edit
    var conditions = [{key: field, operator: '=', value: value}];
    var $action = $.trim($(".customers-add.customers-edit").attr("data-action"));
    console.log($action);
    if ($action == "add") {
      conditions = conditions;
    } else if ($action == "edit") {
      var $codeCltVal = $.trim($(".form-add-customers input[name='code_clt']").val());
      conditions = [
        {key: field, operator: '=', value: value, andOrOperator: 'AND'},
        {key: 'code_clt', operator: '!=', value: $codeCltVal}
      ];
    }
    // edit check if action = add or edit

    $.ajax({
      async: false,
      url: "controller/Customers.php",
      type: "POST",
      dataType: 'json',
      data: {
        a: "check",
        args: {
          fields: [field],
          table: customerTable,
          conditions: conditions,
          checkExist: true,
        },
      },
    })
    .done(function(data) { output = data; })
    .fail(function(data) { console.log("check fail msg here"); });

    return output;
  }
  // end function to check existense

  // start reset form class to default
  function resetFormDefaultClass($this, resetAll = false) {
    if (resetAll) {
      $this.each(function () {
        $(this).removeClass("has-warning has-success has-error").find('span.form-control-feedback')
        .removeClass("glyphicon-warning-sign glyphicon-ok glyphicon-remove");
        $this.find('.help-block').html("");
        isEmptyRequiredFields();
      });
    } else {
      $this.removeClass("has-warning has-success has-error").find('span.form-control-feedback')
      .removeClass("glyphicon-warning-sign glyphicon-ok glyphicon-remove");
      $this.find('.help-block').html("");
    }
  }
  // end reset form class to default

  // start check if required fields is empty or not
  function isEmptyRequiredFields($singleField = "") {
    $(".form-add-customers .form-group.has-feedback").each(function () {
      var $this       = $singleField ? $singleField : $(this);
      var $field      = $this.find('input');
      var $msg        = $this.find('.help-block');
      var $fieldTitle = $field.data("title");
      var $fieldName  = $field.attr('name');
      var $fieldVal   = $.trim($field.val());

      // check if has empty value, only ('code_clt', 'client', 'tel')
      if ($.inArray($fieldName, ['code_clt', 'client', 'tel']) !== -1) {
        if (!$fieldVal) {
          resetFormDefaultClass($this);
          $this.addClass("has-warning").find('span.form-control-feedback').addClass("glyphicon-warning-sign");
          $msg.html($fieldTitle + " est obligatoire.");
        } else {
          if (!$this.hasClass("has-success")) {
            resetFormDefaultClass($this);
          }
          $this.removeClass("has-warning").find('span.form-control-feedback').removeClass("glyphicon-warning-sign");
          $msg.html("");
        }
      }
    });
  }
  // end check if required fields is empty or not

  // start check is all fields of the form was valid
  function isFormValid() {
    // loop in each field to check if has errors or warning
    $(".form-add-customers .form-group.has-feedback").each(function () {
      if ($(this).hasClass("has-error") || $(this).hasClass("has-warning")) {
        $(".zones .actions .add-view .btn-save").attr("disabled", true);
        $(".zones .actions .edit-view .btn-update").attr("disabled", true);
        return false;
      } else {
        $(".zones .actions .add-view .btn-save").attr("disabled", false);
        $(".zones .actions .edit-view .btn-update").attr("disabled", false);
        return true;
      }
    });
  }
  // end check is all fields of the form was valid

  // start is email function
  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }
  // end is email function

  // start is clientCode function
  function isClientCode(clientCode) {
    var regex = /^[0-9]{7}$/;
    return regex.test(clientCode);
  }
  // end is clientCode function

  // start is badgeCode function
  function isBadgeCode(badgeCode) {
    var regex = /^[a-zA-Z0-9]{1,10}$/;
    return regex.test(badgeCode);
  }
  // end is badgeCode function

  // start is clientName function
  function isClientName(clientName) {
    var regex = /^[\w\-'_\s]{1,50}$/;
    return regex.test(clientName);
  }
  // end is clientName function

  // start is phoneNumber function
  function isPhoneNumber(phoneNumber) {
    var regex = /^[0-9-. ]+$/;
    if ((phoneNumber.replace(/[^0-9]/g,"").length == 10) && (phoneNumber.replace(/[^ -.]/g,"").length <= 4)) {
      return regex.test(phoneNumber);
    } else {
      return false;
    }
  }
  // end is phoneNumber function

  // start validation of all fields
  function validatAllFields ($fieldName, $fieldVal, $parent, $msg, $fieldTitle) {
    // start isFound function
    function isFound() {
      var isFound     = false;
      isFound = isExist($fieldName, $fieldVal);
      if (isFound) {
        resetFormDefaultClass($parent);
        $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
        $msg.html($fieldTitle + " existe déjà.");
      } else {
        resetFormDefaultClass($parent);
        $parent.addClass("has-success").find('span.form-control-feedback').addClass("glyphicon-ok");
        $msg.html("");
      }
    }
    // end isFound function

    // show warning if required fields was empty
    isEmptyRequiredFields($parent);

    //
    if ($fieldVal) {
      if ($fieldName == 'code_clt') {
        if (isClientCode($fieldVal)) {
          isFound();
        } else {
          resetFormDefaultClass($parent);
          $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
          $msg.html($fieldTitle + " doit avoir 7 chiffres.");
        }
      } else if ($fieldName == 'client') {
        if (!isClientName($fieldVal)) {
          resetFormDefaultClass($parent);
          $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
          $msg.html($fieldTitle + " ne doit avoir que des lettres, des chiffres et des symboles (-_ '). 50 caractères maximum.");
        } else {
          isFound();
        }
      } else if ($fieldName == 'e_mail') {
        if (!isEmail($fieldVal)){
          resetFormDefaultClass($parent);
          $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
          $msg.html($fieldTitle + " doit avoir le format personne@exemple.com.");
        } else {
          isFound();
        }
      } else if (($fieldName == 'tel') || ($fieldName == 'mobile') || $fieldName == 'fax') {
        if ((!isPhoneNumber($fieldVal))) {
          resetFormDefaultClass($parent);
          $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
          $msg.html($fieldTitle + " doit avoir 10 chiffres et il peut être séparé par un espace, . ou -.");
        } else {
          isFound();
        }
      } else if ($fieldName == 'codebadge') {
        if (!isBadgeCode($fieldVal)) {
          resetFormDefaultClass($parent);
          $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
          $msg.html($fieldTitle + " ne doit avoir que des lettres et des chiffres. 10 caractères maximum.");
        } else {
          isFound();
        }
      }
    } else if ($.inArray($fieldName, ['code_clt', 'client', 'tel']) === -1) {
      resetFormDefaultClass($parent);
    }
    //
    isFormValid();
  }
  // end validation of all fields

  // start form validation
  function formValidion() {
    $(".form-add-customers .form-group.has-feedback input").on('input focus blur mouseleave', function (e) {
      var $field      = $(this);
      var $parent     = $field.closest(".form-add-customers .form-group.has-feedback");
      var $fieldName  = $field.attr('name');
      var $fieldVal   = $.trim($field.val());
      var $msg        = $field.siblings('.help-block');
      var $fieldTitle = $field.data("title");

      console.log(e.type + " " + $fieldName);

      if (e.type == "input" || e.type == "blur" || e.type == "mouseleave") {

        validatAllFields($fieldName, $fieldVal, $parent, $msg, $fieldTitle);

      } else if (e.type == "focus") {

        if (!$parent.hasClass("has-success")) {
          resetFormDefaultClass($parent);
        }
        isFormValid();
      }
    });
  }
  formValidion();
  // end form validation

  // start add customer info
  function addCustomers() {
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      data: {
        a: "add",
        t: customerTable,
        customerInfo : $(".form-add-customers").serialize()
      },
      beforeSend : function(){
      }
    })

    .done(function(data) {
      console.log(data);
      $('#table-customers-list').DataTable().destroy();
      getCustomers($(".pagination-current").val());
      showMainView();
      console.log("success msg here");
    })

    .fail(function(data) {
      console.log("fail msg here");
    });
  }

  $(".zones .actions .add-view .btn-save").on("click", function () {
    console.log("save");
    addCustomers();
    resetFormDefaultClass($(".form-add-customers .form-group.has-feedback"), true);
  });
  // end add customer info

  // start update customer info
  function updateCustomers(codeClt) {
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      data: {
        a: "update",
        t: customerTable,
        customerInfo : $(".form-add-customers").serialize(),
        codeClt: codeClt
      },
      beforeSend : function(){
      }
    })

    .done(function(data) {
      console.log(data);
      $('#table-customers-list').DataTable().destroy();
      getCustomers($(".pagination-current").val());
      showMainView();
      console.log("success msg here");
    })

    .fail(function(data) {
      console.log("fail msg here");
    });
  }

  $(".zones .actions .edit-view .btn-update").on("click", function () {
    console.log("save");
    var codeClt = $(".form-add-customers .form-group.has-feedback input[name='code_clt']").val();
    console.log("update : " + codeClt);
    updateCustomers(codeClt);
    resetFormDefaultClass($(".form-add-customers .form-group.has-feedback"), true);
  });
  // end update customer info


  // start datatables
  function datatablesInit() {
    $('#table-customers-list').DataTable({
      destroy: true,
      stateSave: true,
      retrieve: true,
      responsive: true,
      fixedHeader: true,
      paging: false,
      searching: false,
      info: false,
      columnDefs: [
        { responsivePriority: 1, targets: 0, title: 'Code' },
        { responsivePriority: 3, targets: 1, title: 'Client' },
        { responsivePriority: 4, targets: 2, title: 'Telephone' },
        { responsivePriority: 5, targets: 24, title: 'Code Badge' },
        { responsivePriority: 2, targets: -1, orderable: false },
        { targets: 3, title: 'Fax' },
        { targets: 4, title: 'Address Livraison' },
        { targets: 5, title: 'Address Livraison - Suit' },
        { targets: 6, title: 'Address Facturation' },
        { targets: 7, title: 'Address Facturation - Suit' },
        { targets: 8, title: 'Ville Livraison' },
        { targets: 9, title: 'Ville Facturation' },
        { targets: 10, title: 'Pays' },
        { responsivePriority: 6, targets: 11, title: 'Email' },
        { targets: 12, title: 'Bloquer' },
        { targets: 13, title: 'CP Livraison' },
        { targets: 14, title: 'CP Facturation' },
        { targets: 15, title: 'Commentaire' },
        { targets: 22, title: 'Avantage' },
        { targets: 27, title: 'GSM' },
      ],
      aaSorting: [0,'asc']
    });
  }
  // end datatables

  // start get customers
  function getCustomers(page = 1, perPage =  25, search = "") {
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      dataType: "json",
      data: {
        a: "get",
        getColumnsArgs: { table: customerTable },
        countArgs: { fields: ["count(code_clt)"], table: customerTable, conditions: search },
        page: {currentPage: page, perPage: perPage},
        search: search
      },
      beforeSend : function(){
        $('.customers-list').addClass('spinner');
        $('.customers-grid').addClass('spinner');
      }
    })

    .done(function(data) {
      $('.customers-list').removeClass('spinner');
      $('.customers-grid').removeClass('spinner');

      // start show count info
      $('.main-header .zones .navigations .customers-count-min').html(data.pagination.min);
      $('.main-header .zones .navigations .customers-count-max').html(data.pagination.max);
      $('.main-header .zones .navigations .customers-count-total').html(data.pagination.count);

      $('.main-header .zones .navigations .pagination-first').attr("data-page", data.pagination.first);
      $('.main-header .zones .navigations .pagination-prev').attr("data-page", data.pagination.prev);
      $('.main-header .zones .navigations .pagination-current').val(data.pagination.current).attr("data-page", data.pagination.next);
      $('.main-header .zones .navigations .pagination-next').attr("data-page", data.pagination.next);
      $('.main-header .zones .navigations .pagination-last').attr("data-page", data.pagination.last);
      // end show count info

      // start prevent click on pagination buttons
      $(".paginations").each(function () {
        if ($(this).attr("data-page") == $(".pagination-current").val()) {
          $(this).addClass("btn-prevent-click");
        } else {
          $(this).removeClass("btn-prevent-click");
        }
      });
      // end prevent click on pagination buttons

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
          customerGrid += '<div class="customer-grid" data-code="' + customer.CODE_CLT + '" data-client="' + customer.CLIENT + '">';
          customerGrid += '<div class="customer-details text-center">';
          customerGrid += '<h3 class="fullname"><i class="fa fa-user"></i> ' + customer.CLIENT + '</h3>';
          if (customer.E_MAIL) customerGrid += '<p><i class="fa fa-envelope"></i> ' + customer.E_MAIL + '</p>';
          if (customer.TEL) customerGrid += '<p><i class="fa fa-phone"></i> ' + customer.TEL + '</p>';
          customerGrid += '</div></div></div>';
        }

        for (var c in data.column) {
          var column = data.column[c];
          tbody += "<td>" + customer[column] + "</td>";
        }

        tbody += '<td>';
        tbody += ' <span class="btn btn-primary btn-xs btn-edit" data-code="' + customer.CODE_CLT + '" data-client="' + customer.CLIENT + '"><i class="fa fa-edit"></i></span>';
        tbody += ' <span class="btn btn-danger btn-xs btn-delete" data-code="' + customer.CODE_CLT + '"><i class="fa fa-remove"></i></span>';
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
  // end get customers

  // start delete customer function
  function deleteCustomer(code) {
    var codeClt = $.trim(code);
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      data: {
        a: "delete",
        t: customerTable,
        args : {idKey: 'CODE_CLT', idValue: codeClt}
      },
      beforeSend : function(){
      }
    })

    .done(function(data) {
      console.log(data);
      $('#table-customers-list').DataTable().destroy();
      getCustomers($(".pagination-current").val());
      showMainView();
      console.log("success msg here");
    })

    .fail(function(data) {
      console.log("fail msg here");
    });
  }
  // end delete customer function

  // start on btn delete clicked
  $("#table-customers-list tbody").on("click", "td .btn-delete", function () {
    deleteCustomer($(this).data("code"));
  });
  // end on btn delete clicked

  // on click in pagination buttons
  $(".paginations").on("click", function () {
    if (! $(this).hasClass("btn-prevent-click")) {
      $('#table-customers-list').DataTable().destroy();
      getCustomers($(this).attr("data-page"), 25, search);
    }
  });

  // go to page
  $(".pagination-current").on("change", function () {
    $('#table-customers-list').DataTable().destroy();
    getCustomers($(this).val(), 25, search);
  });


  // on click retry button get customers
  $(".retry-btn").on("click", function() {
    $('.customers-list .retry-btn').hide();
    $('.customers-grid .retry-btn').hide();
    getCustomers($(".pagination-current").val());
  });

});
