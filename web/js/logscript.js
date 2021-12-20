$(document).ready(function () {
    var user = localStorage.getItem('usuario');
    $("input[name=email]").attr('value',user);
    //srink function
    var bandera = 1;
    $(".signup").on("click", function () {
        if (bandera == 1) {
            $(".signup").addClass("shrink");
            $(".signupform").show(250);
            bandera = 0;
            console.log(bandera);
         } else {
            $(".shrink").removeClass("shrink");
            $(".signupform").hide(250);
            bandera = 1;
         }
    });

    //formulario clase activo
    $("input").on("click", function () {
        $(".activo").removeClass("activo");
        $(this).addClass("activo");
    });

    $('#login').on("click", function () {
        if($("input[name=recordar]")){
            var usuario=$("input[name=email]").val();
            localStorage.setItem('usuario', usuario);
        }
    });


});