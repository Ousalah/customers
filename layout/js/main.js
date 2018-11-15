$(function () {
  "use strict";

  $(".main-header .navigations .view-mode i").on("click", function() {
    if (!$(this).hasClass("active")) {
      $(this).toggleClass("active").siblings("i").removeClass("active");
      $("." + $(this).data("class")).fadeIn().siblings("._customers-view").hide();
    }
  });

  $('#table-customers-list').DataTable({
    paging: false,
    searching: false,
  });
});
