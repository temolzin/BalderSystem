<!DOCTYPE html>
<html lang="es">
<head>
  <title>Balder System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="../../dist/img/icons/favicon.png"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../../vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../../vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../../vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../../vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../../dist/css/util.css">
  <link rel="stylesheet" type="text/css" href="../../dist/css/main.css">
  <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
  <div class="container-login100" id="principal" name="principal">
    <div class="wrap-login100">
      <div class="login100-pic js-tilt" data-tilt>
        <img src="../../dist/img/img-01.png" alt="IMG">
      </div>

      <form class="login100-form validate-form" id="formLogin" name="formLogin">
					<span class="login100-form-title">
						Inicia sesión
					</span>

        <div class="wrap-input100">
          <input class="input100" type="text" name="username" id="username" placeholder="Usuario">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100">
          <input class="input100" type="password" name="password" id="password" placeholder="Contraseña">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
        </div>

        <div class="container-login100-form-btn">
          <button class="login100-form-btn">
            Aceptar
          </button>
        </div>

        <div class="text-center p-t-136">
          <a class="txt2" href="#">

          </a>
        </div>
      </form>
    </div>
  </div>
</div>




<!--===============================================================================================-->
<script src="../../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../../vendor/bootstrap/js/popper.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="../../vendor/tilt/tilt.jquery.min.js"></script>
<script >
  $('.js-tilt').tilt({
    scale: 1.1
  })
</script>
<!--===============================================================================================-->
<script src="../../dist/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

    var images = Array("linear-gradient(to right, #6a11cb 0%, #2575fc 100%)",
      "linear-gradient(to right, #b8cbb8 0%, #b8cbb8 0%, #b465da 0%, #cf6cc9 33%, #ee609c 66%, #ee609c 100%)",
      "linear-gradient(to top, #37ecba 0%, #72afd3 100%)",
      "linear-gradient(to right, #eea2a2 0%, #bbc1bf 19%, #57c6e1 42%, #b49fda 79%, #7ac5d8 100%)",
      "linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%)",
      "linear-gradient(to top, #00c6fb 0%, #005bea 100%)",
      "linear-gradient(15deg, #13547a 0%, #80d0c7 100%)");
    var currimg = 0;

    function loadimg(){
      $('#principal').animate({ opacity: 1 }, 500,function(){
        //finished animating, minifade out and fade new back in
        $('#principal').animate({ opacity: 0.7 }, 100,function(){

          currimg++;
          if(currimg > images.length-1){
            currimg=0;
          }

          var newimage = images[currimg];
          //swap out bg src
          $('#principal').css("background-image", newimage);
          //animate fully back in
          $('#principal').animate({ opacity: 1 }, 400,function(){
            //set timer for next
            setTimeout(loadimg,4000);
          });
        });
      });
    }
    setTimeout(loadimg,4000);
  });
</script>

<script type="text/javascript">
    $("#formLogin").validate({
      rules: {
        username: {
          required: true
        },
        password: {
          required: true,
        }
      },
      messages: {
        username: {
          required: "Debes ingresar un nombre de usuario"
        },
        password: {
          required: "Debes ingresar una Contraseña"
        }
      },
      errorElement: "span",
      errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      },
      submitHandler: function(){
        var form_data = new FormData();
        var username = document.getElementById('username');
        var password = document.getElementById('password');

        form_data.append('username', username.value);
        form_data.append('accion', 'login');
        form_data.append('password', password.value);
        $.ajax({
          type: "POST",
          url: "../process/usuarioajax.php",
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          success: function(data){
            if(data == 'ok') {
                window.location = "dashboardview.php";
            } else {
              Swal.fire(
                "¡Error!",
                  "Usuario y contraseña incorrectos",
                "error"
              );
            }
          },
        });
      }
    });
</script>

</body>
</html>
