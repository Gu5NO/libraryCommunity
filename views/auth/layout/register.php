<?php
  include("views/auth/includes/env.php");
  include($path_import."session.php");
  include($path_import."head.php");
?>
<body>
     <div class="container-scroller">
          <div class="container-fluid page-body-wrapper full-page-wrapper">
               <div class="content-wrapper d-flex auth px-0">
                    <div class="row w-100 mx-0">
                         <div class="col-lg-6 mx-auto">
                              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                   <div class="brand-logo">
                                        <img src="<?php echo $base_url;?>/views/content/img/logo.png" alt="logo" />
                                   </div>
                                   <h4><?= $title; ?></h4>
                                   <form class="pt-3" id="frmRegister" name="frmRegister" role="form" method="post" novalidate data-parsley-validate>
                                        <div class="row">
                                            <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                                <div class="form-group">
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Username"
                                                        autofocus
                                                        id="txtUser"
                                                        name="txtUser"
                                                        value=""
                                                        required
                                                        autocomplete="on"
                                                        data-parsley-trigger="change"
                                                        data-parsley-length="[4, 16]"
                                                        data-parsley-pattern="^[a-zA-Z0-9_-]+$"
                                                        data-parsley-error-message="Ingresa un nombre de usuario valido."
                                                />
                                                </div>
                                            </div>    
                                        </div>      
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="nombre"
                                                        autofocus
                                                        id="txtNombre"
                                                        name="txtNombre"
                                                        value=""
                                                        required
                                                        autocomplete="on"
                                                        data-parsley-trigger="change"
                                                        data-parsley-length="[1, 120]"
                                                        data-parsley-pattern="^[a-zA-Z]+$"
                                                        data-parsley-error-message="Ingresa un nombre valido."
                                                />
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="apellido paterno"
                                                        autofocus
                                                        id="txtApaterno"
                                                        name="txtApaterno"
                                                        value=""
                                                        required
                                                        autocomplete="on"
                                                        data-parsley-trigger="change"
                                                        data-parsley-length="[1, 120]"
                                                        data-parsley-pattern="^[a-zA-Z]+$"
                                                        data-parsley-error-message="Ingresa un apellido valido."
                                                />
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="apellido materno"
                                                        autofocus
                                                        id="txtAmaterno"
                                                        name="txtAmaterno"
                                                        value=""
                                                        required
                                                        autocomplete="on"
                                                        data-parsley-trigger="change"
                                                        data-parsley-length="[1, 120]"
                                                        data-parsley-pattern="^[a-zA-Z]+$"
                                                        data-parsley-error-message="Ingresa un apellido valido."
                                                />
                                                </div>
                                            </div>    
                                        </div> 
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="correo"
                                                        autofocus
                                                        id="txtCorreo"
                                                        name="txtCorreo"
                                                        value=""
                                                        required
                                                        autocomplete="on"
                                                        data-parsley-trigger="change"
                                                        data-parsley-type="email"
                                                        data-parsley-error-message="Ingresa un correo electrónico válido."
                                                />
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Confirme el correo"
                                                        autofocus
                                                        id="txtCorreoV"
                                                        name="txtCorreoV"
                                                        value=""
                                                        required
                                                        autocomplete="on"
                                                        data-parsley-trigger="change"
                                                        data-parsley-type="email"
                                                        data-parsley-error-message="Ingresa un correo electrónico válido."
                                                />
                                                </div>
                                            </div>    
                                        </div> 
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Teléfono"
                                                        autofocus
                                                        id="txtTel"
                                                        name="txtTel"
                                                        value=""
                                                        required
                                                        autocomplete="on"
                                                        data-parsley-trigger="change"
                                                        data-parsley-length="[10, 10]"
                                                        data-parsley-pattern="^[0-9]+$"
                                                        data-parsley-error-message="Ingresa un teléfono válido."
                                                />
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Confirme el teléfono"
                                                        autofocus
                                                        id="txtTelV"
                                                        name="txtTelV"
                                                        value=""
                                                        required
                                                        autocomplete="on"
                                                        data-parsley-trigger="change"
                                                        data-parsley-length="[10, 10]"
                                                        data-parsley-pattern="^[0-9]+$"
                                                        data-parsley-error-message="Ingresa un teléfono válido."
                                                />
                                                </div>
                                            </div>    
                                        </div> 
                                        <div class="form-group">
                                            <label>La contraseña se enviara de forma privada via correo electronico; una vez ingresado, puede cambiar su contraseña.</label> 
                                        </div>
                                        <div class="mt-3">
                                             <button class="btn btn-primary d-grid w-100" type="button" id="btnRegistro">Registrase</button>
                                        </div>
                                        <div class="text-center mt-4 fw-light">¿Ya tienes cuenta? <a href="index" class="text-primary">Inicia Sesión</a></div>
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
    scriptElement.src = '../views/auth/resource/key/register.js';
    scriptElement.onload = function() {
    };
    scriptElement.onerror = function() {
    };
    document.body.appendChild(scriptElement);
</script>
