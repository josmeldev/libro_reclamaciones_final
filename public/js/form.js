window.addEventListener('DOMContentLoaded', (event) => {
    // Funciones para el primer conjunto de elementos
    const naturalRadio = document.getElementById('natural');
    const juridicaRadio = document.getElementById('juridica');

    const camposNatural = document.querySelectorAll('.campos-natural');
    const camposJuridica = document.querySelectorAll('.campos-juridica');

    function limpiarCampos(campos) {
        campos.forEach(campo => {
            campo.value = ''; // Establecer el valor en vacío
        });
    }
    function mostrarCampos(campos) {
        campos.forEach(campo => campo.style.display = 'block');
    }

    function ocultarCampos(campos) {
        campos.forEach(campo => campo.style.display = 'none');
    }

    naturalRadio.addEventListener('change', () => {
        if (naturalRadio.checked) {
            mostrarCampos(camposNatural);
            ocultarCampos(camposJuridica);
            limpiarCampos(document.querySelectorAll('.campos-natural input'));
            mostrarCampos(document.querySelectorAll('.campos-menor'));
        }
    });

    juridicaRadio.addEventListener('change', () => {
        if (juridicaRadio.checked) {
            mostrarCampos(camposJuridica);
            ocultarCampos(camposNatural);
            limpiarCampos(document.querySelectorAll('.campos-juridica input'));
            ocultarCampos(document.querySelectorAll('.campos-menor, .campos-apoderado'));
        }
    });

    // Funciones para el segundo conjunto de elementos
    const menorSiRadio = document.getElementById('menorSi');
    const menorNoRadio = document.getElementById('menorNo');
    const camposApoderado = document.querySelector('.campos-apoderado');

    function mostrarCamposApoderado() {
        camposApoderado.style.display = menorSiRadio.checked ? 'block' : 'none';
        if (!menorSiRadio.checked) {
            limpiarCampos(document.querySelectorAll('.campos-apoderado input'));
        }
    }

    menorSiRadio.addEventListener('change', mostrarCamposApoderado);
    menorNoRadio.addEventListener('change', mostrarCamposApoderado);

    // Llamamos a la función una vez al inicio para asegurarnos de que esté en el estado correcto al cargar la página
    mostrarCamposApoderado();

    // Funciones para el tercer conjunto de elementos
    const reclamoRadio = document.getElementById('reclamo');
    const quejaRadio = document.getElementById('queja');
    const cuadroReclamo = document.getElementById('cuadroReclamo');
    const cuadroQueja = document.getElementById('cuadroQueja');

    function mostrarCuadroReclamo() {
        cuadroReclamo.style.display = 'block';
        cuadroQueja.style.display = 'none'; // Ocultamos el cuadro de queja si está visible
    }

    function mostrarCuadroQueja() {
        cuadroQueja.style.display = 'block';
        cuadroReclamo.style.display = 'none'; // Ocultamos el cuadro de reclamo si está visible
    }

    reclamoRadio.addEventListener('change', () => {
        if (reclamoRadio.checked) {
            mostrarCuadroReclamo();
            limpiarCampos(document.querySelectorAll('.cuadroReclamo textarea'));
        }
    });

    quejaRadio.addEventListener('change', () => {
        if (quejaRadio.checked) {
            mostrarCuadroQueja();
            limpiarCampos(document.querySelectorAll('.cuadroQueja textarea'));
        }
    });


    // Obtener el input de la fecha
    var fechaInput = document.getElementById('fecha_registro');

    // Añadir un event listener para el cambio en la fecha
    fechaInput.addEventListener('change', function() {
        // Obtener la fecha actual en formato YYYY-MM-DD
        var fechaActual = new Date().toISOString().split('T')[0];

        // Obtener el valor del input de fecha
        var fechaIngresada = fechaInput.value;

        // Comparar las fechas
        if (fechaIngresada > fechaActual) {
            // Mostrar un mensaje de alerta
            var confirmacion = confirm("¿Seguro que quiere ingresar una fecha superior a la actual?");

            // Si el usuario elige "Aceptar", no hacemos nada
            // Si el usuario elige "Cancelar", reseteamos el valor del input
            if (!confirmacion) {
                fechaInput.value = ''; // Resetear el valor del input
            }
        }
    });



});

//Validacion del formulario
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        var fechaRegistro = document.getElementById("fecha_registro").value.trim();
        var tipoPersona = document.querySelector('input[name="tipo_persona"]:checked');
        var tipoReclamo = document.querySelector('input[name="tipo_reclamo"]:checked');
        var bienContratado = document.querySelector('input[name="bien_contratado"]:checked');
        var menorEdad = document.querySelector('input[name="menor_edad"]:checked');
        var detalleReclamacion = document.getElementById("detalle_reclamacion").value.trim();
        var dniApoderado = document.querySelector('input[name="dni_apoderado"]').value.trim();
        var nombresApellidosApoderado = document.querySelector('input[name="nombres_apellidos_apoderado"]').value.trim();
        var direccionApoderado = document.querySelector('input[name="direccion_apoderado"]').value.trim();

        // Definimos una variable para almacenar si hay errores
        var hayErrores = false;

        // Validación de la fecha de registro
        if (fechaRegistro === "") {
            alert("Por favor, ingrese la fecha de registro.");
            event.preventDefault();
            hayErrores = true;
        }

        // Verifica que se haya seleccionado una opción para cada campo
        if (!tipoPersona || !tipoReclamo || !bienContratado) {
            alert("Por favor, seleccione una opción para cada campo.");
            event.preventDefault();
            hayErrores = true;
        } else {
            tipoPersona = tipoPersona.value;
            tipoReclamo = tipoReclamo.value;
            bienContratado = bienContratado.value;

            // Si el tipo de persona es "natural", verifica también el radio "menorEdad"
            if (tipoPersona === "natural" && !menorEdad) {
                alert("Por favor, seleccione una opción para el campo de menor de edad.");
                event.preventDefault();
                hayErrores = true;
            } else if (tipoPersona === "natural") {
                menorEdad = menorEdad.value;
                if (direccionApoderado === "" && menorEdad === "si") {
                    alert("Por favor, ingrese la dirección del apoderado.");
                    event.preventDefault();
                    hayErrores = true;
                }
            
                if (nombresApellidosApoderado === "" && menorEdad === "si") {
                    alert("Por favor, ingrese los nombres y apellidos del apoderado.");
                    event.preventDefault();
                    hayErrores = true;
                }
            
                if ((dniApoderado.length != 8 || dniApoderado === "") && menorEdad === "si") {
                    alert("Por favor, ingrese el DNI. Debe tener 8 dígitos.");
                    event.preventDefault();
                    hayErrores = true;
                }
            }

            // Validación específica para personas naturales
            if (tipoPersona === "natural") {
                if (!document.getElementById("dni").value.trim() ||
                    !document.getElementById("nombres_apellidos").value.trim() ||
                    !document.getElementById("fono_persona").value.trim() ||
                    !document.getElementById("email").value.trim()) {
                    alert("Por favor, complete todos los campos para personas naturales.");
                    event.preventDefault();
                    hayErrores = true;
                }
            }

            // Validación específica para personas jurídicas
            else if (tipoPersona === "juridica") {
                if (!document.getElementById("ruc").value.trim() ||
                    !document.getElementById("razon_social").value.trim() ||
                    !document.getElementById("direccion").value.trim() ||
                    !document.getElementById("fono_empresa").value.trim()) {
                    alert("Por favor, complete todos los campos para personas jurídicas.");
                    event.preventDefault();
                    hayErrores = true;
                }
            }

            // Validación del detalle de reclamo o queja
            if (tipoReclamo === "reclamo" || tipoReclamo === "queja") {
                var detalle = tipoReclamo === "reclamo" ? document.getElementById("textoReclamo") : document.getElementById("textoQueja");
                if (!detalle.value.trim()) {
                    alert("Por favor, ingrese el detalle del " + tipoReclamo + ".");
                    event.preventDefault();
                    hayErrores = true;
                }
            }
        }

        // Validación del detalle de reclamación
        if (detalleReclamacion === "") {
            alert("Por favor, ingrese el Pedido del Consumidor.");
            event.preventDefault();
            hayErrores = true;
        }

        // Si no hay errores, mostramos el mensaje de éxito
        if (!hayErrores) {
            mostrarExito();
        }
    });
});

// Función para mostrar mensaje de éxito con SweetAlert2
function mostrarExito() {
    Swal.fire({
        title: '¡Éxito!',
        text: 'El formulario se ha enviado correctamente.',
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

