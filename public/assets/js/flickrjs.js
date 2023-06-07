pagination = (maxData, totalRows) => {
  var maxData = parseInt($("#maxData").val());
  var totalRows = $(".f-table > #row").length;
  var trNum = 0;
  $(".f-table > #row").each(function () {
    trNum++;
    if (trNum > maxData) {
      $(this).hide();
    }
    if (trNum <= maxData) {
      $(this).show();
    }
  });
  if (maxData <= totalRows) {
    var page = Math.ceil(totalRows / maxData);
  }
  $(".f-pagination").html("");
  for (i = 1; i <= page; i++) {
    $(".f-pagination").append(`<li class="f-page-item">${i}</li>`);
  }
  $(".f-page-item:first-child").addClass("f-page-active");

  $(".f-page-item").on("click", function () {
    $(".f-page-item").removeClass("f-page-active");
    $(this).addClass("f-page-active");
    var pageNum = parseInt($(this).html());
    var trIndex = 0;
    $(".f-table > #row").each(function () {
      trIndex++;
      if (
        trIndex > maxData * pageNum ||
        trIndex <= maxData * pageNum - maxData
      ) {
        $(this).slideUp(400);
      } else {
        $(this).slideDown(400);
      }
    });
  });
};

searching = () => {
  $(".f-search").on("keyup", function () {
    var str = $(this).val().toLowerCase();
    if (str != "") {
      $(".f-table > #row").each(function () {
        condition = "false";
        $(this).each(function () {
          if ($(this).text().toLowerCase().indexOf(str) >= 0) {
            condition = "true";
          }
        });
        $(".f-pagination").html("");
        if (condition == "true") {
          $(this).slideDown(400);
        } else {
          $(this).slideUp(400);
        }
      });
    } else {
      var maxData = parseInt($("#maxData").val());
      var totalRows = $(".f-table > #row").length;
      pagination(maxData, totalRows);
    }
  });
};
