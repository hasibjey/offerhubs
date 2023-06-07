$(document).ready(function () {
    // navigation section start
    $(".f-nav-link").on("click", function (e) {
        if ($(this).siblings(".f-sub-nav-group").hasClass("f-sub-nav-active")) {
            $(".f-sub-nav-group").removeClass("f-sub-nav-active");
            $(".f-sub-nav-group").slideUp(400);
            $(".f-sub-nav-link").removeClass("f-sub-active");
        } else {
            $(".f-nav-link").removeClass("f-nav-active");
            $(this).addClass("f-nav-active");
            $(".f-nav-link")
                .children(".f-nav-angle")
                .removeClass("f-nav-angle-active");
            $(this).children(".f-nav-angle").addClass("f-nav-angle-active");
            $(".f-sub-nav-group").removeClass("f-sub-nav-active");
            $(this).siblings(".f-sub-nav-group").addClass("f-sub-nav-active");
            $(".f-sub-nav-group").slideUp(400);
            $(this).siblings(".f-sub-nav-group").slideDown(400);
        }
    });
    $(".f-sub-nav-link").on("click", function (e) {
        $(".f-sub-nav-link").removeClass("f-sub-active");
        $(this).addClass("f-sub-active");
    });

    var currentUrl = window.location.href;
    var findUrl = currentUrl.split("/");
    findUrl = findUrl[findUrl.length - 1];
    // findUrl = findUrl.replace("_", " ");
    $(".f-sub-nav-link").each(function (e) {
        if ($(this).attr('id') === findUrl) {
            $(this).addClass("f-sub-active");
            $(this)
                .parent()
                .parent(".f-sub-nav-group")
                .addClass("f-sub-nav-active");
            $(this).parent().parent(".f-sub-nav-group").slideDown(400);
            $(this)
                .parent()
                .parent(".f-sub-nav-group")
                .siblings(".f-nav-link")
                .addClass("f-nav-active");
            $(this)
                .parent()
                .parent(".f-sub-nav-group")
                .siblings(".f-nav-link")
                .children(".f-nav-angle")
                .addClass("f-nav-angle-active");
        }
    });
    var currentUrl = window.location.href;
    var findUrl = currentUrl.split("/");
    findUrl = findUrl[findUrl.length - 1];
    findUrl = findUrl.replace("_", " ");
    $(".f-nav-link").each(function (e) {
        if ($(this).attr('id') === findUrl) {
            $(this).addClass("f-nav-active");
        }
    });
    // navigation section end

    // notificatin section start
    $(".f-top-icon-item > ion-icon").on("click", function (e) {
        if (
            $(this)
                .siblings(".f-notification-container")
                .hasClass("f-notification-active")
        ) {
            $(".f-notification-container").removeClass("f-notification-active");
            $(".f-notification-container").hide(400);
        } else {
            $(".f-notification-container").removeClass("f-notification-active");
            $(this)
                .siblings(".f-notification-container")
                .addClass("f-notification-active");
            $(".f-notification-container").hide(400);
            $(this).siblings(".f-notification-container").show(400);
        }
    });
    // notificatin section end

    // admin navigation section start
    $(".f-admin-img").on("click", function (e) {
        $(".f-admin-nav").toggle(400);
    });
    // admin navigation section end

    // container dynamic height
    let mainHeight = $(window).innerHeight();
    let conHeight = mainHeight - 61;
    $(".f-main-container").css("height", conHeight + "px");

    // pagination section start
    $(".f-page-item").on("click", function (e) {
        $(".f-page-item").removeClass("f-page-active");
        $(this).addClass("f-page-active");
    });
    // pagination section end

    // password match section start
    $("#confirm-password").keyup(function (e) {
        let password = $("#password").val();
        if (password !== e.target.value && e.target.value != "") {
            $("#password-error").show();
            $("#password-submit").attr("disabled", "disabled");
        } else {
            $("#password-error").hide();
            $("#password-submit").removeAttr("disabled");
        }
    });
    // password match section end

    // file upload custom filed start
    $(".f-file-field-open")
        .on("mouseover", function () {
            $(this).parent(".row").addClass("f-file-field-open-focus");
        })
        .mouseleave(function () {
            $(this).parent(".row").removeClass("f-file-field-open-focus");
        });
    $(".f-file-field-open").on("click", function () {
        $(this).siblings("#f-file-form").click();
        $(this)
            .siblings("#f-file-form")
            .change(function (e) {
                let file_name = e.target.value.replace(/.*(\/|\\)/, "");
                $(this).siblings(".f-file-input").html(file_name);
            })
            .blur(function () {
                console.log("no change");
            });
    });
    // file upload custom filed end

    $(document).on("click", function (e) {
        if ($(".f-top-icon-item > ion-icon").is(e.target)) {
        } else {
            $(".f-notification-container").removeClass("f-notification-active");
            $(".f-notification-container").hide(400);
        }
        if (
            $(".f-admin-img").is(e.target) ||
            $(".f-admin-img").children("*").is(e.target)
        ) {
        } else {
            $(".f-admin-nav").hide(400);
        }
    });
});
