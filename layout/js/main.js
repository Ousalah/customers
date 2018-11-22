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

  // start datatables
  function datatablesInit() {
    $('#table-customers-list').DataTable({
      responsive: true,
      fixedHeader: true,
      paging: false,
      searching: false,
      info: false,
      columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: -1 }
      ],
    });
  }
  // end datatables

  $.ajax({
		url: "controller/Customers.php",
    type: "POST",
		dataType: "json",
    data: {
      a: "get",
      args: { table: "CLIENT" },
    },
    beforeSend : function(){
      $('#table-customers-list thead').html("loading ...");
      $('#table-customers-list tbody').html("loading ...");
      $('.customers-grid').html("loading ...");

    }
  })

  .done(function(data) {
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

    $('.customers-grid').html( customerGrid );
	})

  .fail(function(data) {
    console.log("error ");
  })

  .always(function() {
    console.log("always");
  });

});
