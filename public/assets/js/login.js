$(document).ready(function () {
  $(".f-login-group > input")
    .on("focus", function () {
      $(this).siblings("label").addClass("f-login-label-move");
    })
    .blur(function () {
      if ($(this).val() == "") {
        $(this).siblings("label").removeClass("f-login-label-move");
      }
    });
    if($(".f-login-group > input").val() != '') {
      $(".f-login-group > input").siblings("label").addClass("f-login-label-move");
    }
});
