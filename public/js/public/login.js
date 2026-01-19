$(function () {

    "use strict";



    $("#refreshCaptcha")
        .click(function (e) {
            e.preventDefault();
            getCaptcha();
        });


    $("#formLogin").submit(function (e) {

        e.preventDefault();


        let form = $(this);

        // if (form.valid() == false) {
        //     return;
        // }

        let datos = form.serializeArray();

        datos.push({ name: "_token", value: crfToken });


        // window.location.href = baseUrl + "/admin/personas";


        // console.log(datos);

        $.post(baseUrl + "/login", datos)
            .done(function (data) {
                if (data.success) {

                    setTimeout(function () {
                        window.location.href = data.url;
                    }, 3000);

                    Swal.fire("Bienvenido...", data.message, "success");

                }

            })
            .fail(function (jqXHR) {
                processError(jqXHR);
                getCaptcha();
            })


    });

    function getCaptcha() {
        $("#captchaImg").attr("src", baseUrl + "/captcha?v=" + Math.random());
        $("#captcha").val("");
    }

})
