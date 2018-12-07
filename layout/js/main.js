$(function () {
  "use strict";

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
  }

  // start get the next client
  function getNextId() {
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
      var $codeClt = $(".form-add-customers input[name='code_clt']");
      var $parent  = $codeClt.closest(".form-add-customers .form-group.has-feedback");

      $codeClt.attr('value', data);
      var $codeCltVal = $codeClt.val();

      if ($codeCltVal) {
        var isFound = isExist('code_clt', $codeCltVal);
        if (isFound) {
          resetFormDefaultClass($parent);
          $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
        } else {
          resetFormDefaultClass($parent);
          $parent.addClass("has-success").find('span.form-control-feedback').addClass("glyphicon-ok");
        }
      } else {
        resetFormDefaultClass($parent);
        $parent.addClass("has-warning").find('span.form-control-feedback').addClass("glyphicon-warning-sign");
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
  // end get the next client

  $($actionsView + " .btn-create").on("click", function () {
    $($actionsView).hide().siblings(".add-view").show();
    $("._customers-view").hide();
    $(".customers-add").show();
    $(".main-header .zones .search-form, .main-header .zones .navigations").hide();

    var $codeCltVal = $(".form-add-customers input[name='code_clt']").attr('value');
    // if (!$codeCltVal) {
    // }
    isEmptyRequiredFields();
    getNextId();
    isFormValid();
  });

  $($actionsView + " .btn-discard").on("click", function () {
    showMainView();
    resetFormDefaultClass($(".form-add-customers .form-group.has-feedback"), true);
  });
  // end

  // start function to check existense
  function isExist(field, value) {
    var output = true;
    $.ajax({
      async: false,
      url: "controller/Customers.php",
      type: "POST",
      dataType: 'json',
      data: {
        a: "check",
        args: {
          fields: [field],
          table: "Z_TEST_CLIENT",
          conditions: [{key: field, operator: '=', value: value}],
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
        isEmptyRequiredFields();
      });
    } else {
      $this.removeClass("has-warning has-success has-error").find('span.form-control-feedback')
      .removeClass("glyphicon-warning-sign glyphicon-ok glyphicon-remove");
    }
  }
  // end reset form class to default

  // start check if required fields is empty or not
  function isEmptyRequiredFields($singleField = "") {
    $(".form-add-customers .form-group.has-feedback").each(function () {
      var $this      = $singleField ? $singleField : $(this);
      var $field     = $this.find('input');
      var $fieldName = $field.attr('name');
      var $fieldVal  = $.trim($field.val());

      // check if has empty value, only ('code_clt', 'client', 'tel')
      if ($.inArray($fieldName, ['code_clt', 'client', 'tel']) !== -1) {
        if (!$fieldVal) {
          resetFormDefaultClass($this);
          $this.addClass("has-warning").find('span.form-control-feedback').addClass("glyphicon-warning-sign");
        } else {
          if (!$this.hasClass("has-success")) {
            resetFormDefaultClass($this);
          }
          $this.removeClass("has-warning").find('span.form-control-feedback').removeClass("glyphicon-warning-sign");
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
        return false;
      } else {
        $(".zones .actions .add-view .btn-save").attr("disabled", false);
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

  // start form validation
  function formValidion() {
    $(".form-add-customers .form-group.has-feedback input").on('input focus blur', function (e) {
      var $field     = $(this);
      var $parent    = $field.closest(".form-add-customers .form-group.has-feedback");
      var $fieldName = $field.attr('name');
      var $fieldVal  = $.trim($field.val());
      var isFound    = false;
      console.log(e.type + " " + $fieldName);

      if (e.type == "input" || e.type == "blur") {

        // show warning if required fields was empty
        isEmptyRequiredFields($parent);

        //
        if ($fieldVal) {
          // start isFound function
          function isFound() {
            isFound = isExist($fieldName, $fieldVal);
            if (isFound) {
              resetFormDefaultClass($parent);
              $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
            } else {
              resetFormDefaultClass($parent);
              $parent.addClass("has-success").find('span.form-control-feedback').addClass("glyphicon-ok");
            }
          }
          // end isFound function

          if ($fieldName == 'code_clt') {
            if (isClientCode($fieldVal)) {
              isFound();
            } else {
              resetFormDefaultClass($parent);
              $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
            }
          } else if ($fieldName == 'client') {
            if (!isClientName($fieldVal)) {
              resetFormDefaultClass($parent);
              $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
            } else {
              isFound();
            }
          } else if ($fieldName == 'e_mail') {
            if (!isEmail($fieldVal)){
              resetFormDefaultClass($parent);
              $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
            } else {
              isFound();
            }
          } else if (($fieldName == 'tel') || ($fieldName == 'mobile') || $fieldName == 'fax') {
            if ((!isPhoneNumber($fieldVal))) {
              resetFormDefaultClass($parent);
              $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
            } else {
              isFound();
            }
          } else if ($fieldName == 'codebadge') {
            if (!isBadgeCode($fieldVal)) {
              resetFormDefaultClass($parent);
              $parent.addClass("has-error").find('span.form-control-feedback').addClass("glyphicon-remove");
            } else {
              isFound();
            }
          }
          // isFound();
        } else if ($.inArray($fieldName, ['code_clt', 'client', 'tel']) === -1) {
          resetFormDefaultClass($parent);
        }
        //
        isFormValid();
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
        t: "Z_TEST_CLIENT",
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

  // start get customers
  function getCustomers(page = 1, perPage =  25) {
    $.ajax({
      url: "controller/Customers.php",
      type: "POST",
      dataType: "json",
      data: {
        a: "get",
        getColumnsArgs: { table: "Z_TEST_CLIENT" },
        countArgs: { fields: ["count(code_clt)"], table: "Z_TEST_CLIENT" },
        page: {currentPage: page, perPage: perPage},
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
  // end get customers

  // on click in pagination buttons
  $(".paginations").on("click", function () {
    if (! $(this).hasClass("btn-prevent-click")) {
      $('#table-customers-list').DataTable().destroy();
      getCustomers($(this).attr("data-page"));
    }
  });

  // go to page
  $(".pagination-current").on("change", function () {
    $('#table-customers-list').DataTable().destroy();
    getCustomers($(this).val());
  });


  // on click retry button get customers
  $(".retry-btn").on("click", function() {
    $('.customers-list .retry-btn').hide();
    $('.customers-grid .retry-btn').hide();
    getCustomers($(".pagination-current").val());
  });

});
