$(document).on("click", "#serra-send-it", function () {
    var a = document.getElementById("serra-chat-input");
    if ("" != a.value) {
        var b = $("#serra-get-number").text(),
            c = document.getElementById("serra-chat-input").value,
            d = "https://web.whatsapp.com/send",
            e = b,
            f = "&text=" + c;
        if (
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            )
        )
            var d = "whatsapp://send";
        var g = d + "?phone=" + phone_number + e + f;
        window.open(g, "_blank");
    }
}),
    $(document).on("click", ".serra-informasi", function () {
        (document.getElementById("serra-get-number").innerHTML = $(this)
            .children(".serra-my-number")
            .text()),
            $(".serra-start-chat,.serra-get-new").addClass("serra-show").removeClass("serra-hide"),
            $(".serra-home-chat,.serra-head-home").addClass("serra-hide").removeClass("serra-show"),
            (document.getElementById("serra-get-nama").innerHTML = $(this)
                .children(".serra-info-chat")
                .children(".serra-chat-nama")
                .text()),
            (document.getElementById("serra-get-label").innerHTML = $(this)
                .children(".serra-info-chat")
                .children(".serra-chat-label")
                .text());
    }),
    $(document).on("click", ".serra-close-chat", function () {
        $("#serra-whatsapp-chat").addClass("serra-hide").removeClass("serra-show");
    }),
    $(document).on("click", ".serra-blantershow-chat", function () {
        $("#serra-whatsapp-chat").addClass("serra-show").removeClass("serra-hide");
    });

// Phone number should be dynamically set from PHP
var phone_number = "<?php echo esc_attr(get_option('serra_whatsapp_phone_number')); ?>";
