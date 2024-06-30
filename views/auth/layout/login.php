<?php
  include("views/auth/includes/env.php");
  include($path_import."session.php");
  include($path_import."head.php");
?>
<body>
     <div class="container-scroller">
          <div class="container-fluid page-body-wrapper full-page-wrapper">
               <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                         <div class="col-lg-4 mx-auto">
                              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                   <div class="brand-logo">
                                        <img src="<?php echo $base_url;?>/views/content/img/logo.png" alt="logo" />
                                   </div>
                                   <h4><?= $title; ?></h4>
                                   <form class="pt-3" id="frmLogin" name="frmLogin" role="form" method="post" novalidate data-parsley-validate>
                                        <div class="form-group">
                                             <input
                                                  type="text"
                                                  class="form-control"
                                                  placeholder="username"
                                                  autofocus
                                                  id="txtUser"
                                                  name="txtUser"
                                                  value=""
                                                  required
                                                  autocomplete="on"
                                                  data-parsley-trigger="change"
                                                  data-parsley-length="[4, 16]"
                                                  data-parsley-pattern="^[a-zA-Z]+$"
                                                  data-parsley-error-message="Ingresa un nombre de usuario valido."
                                             />
                                        </div>

                                        <div class="form-group">
                                             <input
                                                  type="password"
                                                  class="form-control"
                                                  placeholder="**********"
                                                  autofocus
                                                  id="txtContra"
                                                  name="txtContra"
                                                  value=""
                                                  required
                                                  autocomplete="on"
                                                  data-parsley-trigger="change"
                                                  data-parsley-length="[6, 32]"
                                                  data-parsley-pattern="^[a-zA-Z0-9!@#$%^&*()_+\[\]:;<>,.?\\/~`|-]+$"
                                                  data-parsley-error-message="Ingresa contraseña válida."
                                             />
                                        </div>

                                        <div class="mt-3">
                                             <button class="btn btn-primary d-grid w-100" type="button" id="btnInicioSesion">Iniciar Sesión</button>
                                        </div>

                                        <div class="my-2 d-flex justify-content-between align-items-center">
                                             <a href="#" class="auth-link text-black">¿Deseas reestablecer la contraseña?</a>
                                        </div>

                                        <div class="text-center mt-4 fw-light">¿No tienes cuenta? <a href="register" class="text-primary">Crear Cuenta</a></div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- content-wrapper ends -->
          </div>
          <!-- page-body-wrapper ends -->
     </div>
</body>

<?php
    include($path_import."footer.php");
?>

<script>
	const scriptElement = document.createElement('script');
    scriptElement.src = '../views/auth/resource/key/auth.js';
    scriptElement.onload = function() {
    };
    scriptElement.onerror = function() {
    };
    document.body.appendChild(scriptElement);
</script>
