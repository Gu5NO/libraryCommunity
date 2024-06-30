const register = new class Register {
    constructor() {
        //Botones
        this.btnRegistro = null;
        //Modal
        //Tablas
        //Formularios
        this.frmRegistro = null;
        //Element
        //Inputs
        this.txtUser = null;
        this.txtNombre = null;
        this.txtApaterno = null;
        this.txtAmaterno = null;
        this.txtCorreo = null;
        this.txtCorreoV = null;
        this.txttel = null;
        this.txttelV = null;
        //Variables
        this.token = null;
        this.ipPublica = null;
        this.ipInterna = null;
    }
    init() {
        //Asiganción
        register.btnRegistro = document.getElementById('btnRegistro');
        register.txtUser = document.getElementById('txtUser');
        register.txtNombre = document.getElementById('txtNombre');
        register.txtApaterno = document.getElementById('txtApaterno');
        register.txtAmaterno = document.getElementById('txtAmaterno');
        register.txtCorreo = document.getElementById('txtCorreo');
        register.txtCorreoV = document.getElementById('txtCorreoV');
        register.txtTel = document.getElementById('txtTel');
        register.txtTelV = document.getElementById('txtTelV');
        //Tablas
        //Formulario
        register.frmRegistro = document.getElementById('frmRegistro');
        //Botones
        register.btnRegistro.addEventListener('click', function(event) {
            event.preventDefault();
            registro.validacion();
        });
        //Funciones
        registro.obtIpInterna();
        registro.obtIpPublica();
        setTimeout(function() {
            registro.obtToken();
        }, 1000);
        //Validaciones
    }


    //FUNCIONES PARA OBTENER LA IP
    async obtIpPublica() {
        // Utilizando el servicio ipinfo.io para obtener la dirección IP pública
        fetch('https://ipinfo.io/json')
            .then(response => response.json())
            .then(data => {
                register.ipPublica = data;
            })
            .catch(error => console.error(error));
    }
    async obtIpInterna() {
        // Crear una conexión RTCPeerConnection
        const peerConnection = new RTCPeerConnection();
        // Crear una oferta para obtener información sobre la conexión local
        peerConnection.createOffer()
            .then(offer => peerConnection.setLocalDescription(offer))
            .then(() => {
                // Extraer la dirección IP desde la descripción local
                const localDescription = peerConnection.localDescription.sdp;
                const ipAddress = localDescription.match(/(192[.]168[.]1[.][0-9]{1,3}|localhost|127[.]0[.]0[.]1)/);
                console.log(localDescription);
                console.log(ipAddress);
                // Imprimir la dirección IP
                if (ipAddress) {
                    register.ipInterna = ipAddress;
                } else {
                    console.error('No se pudo obtener la dirección IP');
                }
            })
            .catch(error => console.error(error));
    }

    async obtToken() {
        const url = `register/generarToken`;
        const data = {
            'ipPublica': register.ipPublica,
            'ipInterna': register.ipInterna,
        };
        // Opciones de la solicitud
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Ajusta el tipo de contenido según tus necesidades
                // Puedes incluir otros encabezados si es necesario
            },
            body: JSON.stringify(data), // Convierte los datos a formato JSON
        };
        return new Promise((resolve, reject) => {
            fetch(url, options)
                .then(response => response.json())
                .then(data => {
                    register.token = data.datos;
                    resolve();
                })
                .catch(error => {
                    reject(error);
                });
        });
    }

    validacion() {
        if (register.frmRegistro) {
            // Obtener la instancia de Parsley asociada al formulario
            let parsleyInstance = $(register.frmRegistro).parsley();
            if (parsleyInstance) {
                parsleyInstance.validate();
                if (parsleyInstance.isValid()) {
                    // Remover estilos rojos
                    let formControls = document.querySelectorAll('.form-control');
                    formControls.forEach(function(control) {
                        control.classList.remove('custom-invalid');
                    });
                    let invalidFeedbacks = document.querySelectorAll('.invalid-feedback');
                    invalidFeedbacks.forEach(function(feedback) {
                        feedback.innerHTML = '';
                    });
                    register.registroUsuario();
                } else {
                    // Formulario no válido, aplicar clases de estilo
                    let invalidControls = document.querySelectorAll('.form-control.parsley-error');
                    invalidControls.forEach(function(control) {
                        control.classList.add('custom-invalid');
                    });
                    let invalidFeedbacks = document.querySelectorAll('.invalid-feedback');
                    invalidFeedbacks.forEach(function(feedback) {
                        let id = feedback.getAttribute('data-parsley-id');
                        let errorMessages = parsleyInstance.getErrorsMessages(id).join('<br>');
                        feedback.innerHTML = errorMessages;
                    });
                }
            }
        }
    }

    async iniciarSesion() {
        const data = {
            "user": auth.txtUser.value,
            "contra": auth.txtContra.value,
            "token": auth.token
        };
        const url = `auth/newUsuario`;
        const configuration = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' // Ajusta el tipo de contenido según tus necesidades
            },
            body: JSON.stringify(data) // Convierte los datos a formato JSON
        };
        fetch(url, configuration)
            .then(response => {
                // Verificar si la solicitud fue exitosa (código de estado 200)
                if (response.ok) {
                    return response.json(); // Convertir la respuesta a JSON
                }
                Swal.fire({
                    title: 'Library Community',
                    text: 'Ocurrió un error al dentro del servidor',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    cancelButtonText: 'Cancelar',
                });
                throw new Error('Ocurrió un error al dentro del servidor');
            })
            .then(data => {
                if (data.status === true) {
                    let datos = data.datos;
                    location.replace("../" + datos.url);
                } else {
                    Swal.fire({
                        title: 'Library Community',
                        text: data.msg,
                        icon: data.tipoMsg,
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'Cancelar',
                    }).then(async() => {
                        auth.obtToken();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'DevsCodeTotal',
                    text: "Ocurrió un error al generar la petición al servidor." + error,
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    cancelButtonText: 'Cancelar',
                });
                // Si deseas propagar la excepción después de manejarla, puedes hacerlo con throw
                throw error;
            });
    }
}
register.init();