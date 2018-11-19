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
    "processing": true,
    "serverSide": true,
    "ajax": {
      url: "controller/Customers.php",
      type: "POST",
      data: {
        a: "get",
        args: { table: "CLIENT" },
      }
    },
  });
  // end datatables

  // $.ajax({
	// 	url: "controller/Customers.php",
  //   type: "POST",
	// 	// dataType: "json",
  //   data: {
  //     a: "get",
  //     args: { table: "CLIENT" },
  //   }
  // })
  //
  // .done(function(customer) {
  //   console.log("done");
  //   console.log(customer);
	// 	// var tbody = "";
	// 	// for (var i = 0; i < customer.length - 1; i++) {
	// 	// 	tbody += "<tr>" +
	// 	// 				"<td><a href='#'>"+ customer[i].employee_id +"</a></td>"+
	// 	// 				"<td>"+ customer[i].name +"</td>"+
	// 	// 				"<td>"+ customer[i].email +"</td>"+
	// 	// 				"<td>"+ customer[i].telephone +"</td>"+
	// 	// 			 "</tr>";
	// 	// };
  //   //
	// 	// $('.resultTable tbody').html( tbody );
  //   //
	// 	// $('#resultTable').DataTable();
	// })
  //
  // .fail(function(customer) {
  //   console.log("error ");
  // })
  //
  // .always(function() {
  //   console.log("always");
  // });

});
