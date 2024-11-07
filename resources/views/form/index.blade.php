<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <!-- Enlace al CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/form.js"></script>
    <script src="js/api.js"></script>



</head>
<body>

   <div class="container ">
    <div class="card text-center align-items-center col-md-12 " >
        <div class="card-header col-md-12 bg-transparent">
            <div class="col" style="margin-bottom: -40px; z-index: 2;">
                <h4 class="card-title">
                    <span style="color: rgb(151, 111, 35); font-weight: bold">LIBRO DE</span> <br>
                    <span style="color: rgb(36, 33, 18); font-weight: bold">RECLAMACIONES</span>
                </h4>
            </div>
            <div class="col align-self-start  " style="border-bottom: 2px solid rgb(36, 24, 2);" id="div-image">
                <img src="{{ asset('images/libro-abierto1.png') }}" class="card-img-top rounded" alt="..." style="width: 200px; height: 160px;">
            </div>
        </div>

        <div class="card-body col-md-12 y">
            <form action="/submit_form" method="post">
                @csrf
                <div class=" row    mb-3 d-flex  ">
                    <div class="col-md-3 text-left">
                        <label for="fecha_registro">Fecha de registro:</label>
                    </div>

                    <div class="col-md-5   ">
                        <input type="date" id="fecha_registro" name="fecha_registro" class="form-control">
                    </div>

                </div>


                <div class="row mb-3">
                    <div class="col-md-3 text-left">
                        <label class="form-label fw-semibold">Tipo de Persona:</label>
                    </div>
                    <div class="col-md-9 ">
                        <div class="row">
                            <div class="col-md-6  ">
                                <div class="form-check  text-left">
                                    <input class="form-check-input " type="radio" id="natural" name="tipo_persona" value="natural">
                                    <label class="form-check-label ml-2" for="natural">Natural</label>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-check text-left">
                                    <input class="form-check-input" type="radio" id="juridica" name="tipo_persona" value="juridica">
                                    <label class="form-check-label ml-2" for="juridica">Jurídica</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="campos-juridica text-left" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ruc">RUC:</label>
                            <input type="text" id="ruc" name="ruc" pattern="[0-9]{11}" minlength="11" maxlength="11" class="form-control" data-token="{{ $token }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" ><br>
                        </div>
                        <div class="col-md-6">
                            <label for="razon_social">Razón Social:</label>
                            <input type="text" id="razon_social" name="razon_social" class="form-control" maxlength="100"><br>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" maxlength="100"><br>
                        </div>
                        <div class="col-md-6">
                            <label for="fono_empresa">Teléfono:</label><br>
                            <input type="tel" id="fono_empresa" name="fono_empresa" pattern="[0-9]{9,14}" maxlength="9" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" minlength="9"><br>
                        </div>

                    </div>

                </div >


                <div class="campos-natural text-left" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" pattern="[0-9]{8}" maxlength="8" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);" minlength="8" ><br>
                        </div>
                        <div class="col-md-6">
                            <label for="nombres_apellidos">Nombres y Apellidos:</label>
                            <input type="text" id="nombres_apellidos" name="nombres_apellidos" class="form-control" maxlength="80"><br>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="fono_persona">Teléfono:</label><br>
                            <input type="tel" id="fono_persona" name="fono_persona" pattern="[0-9]{9,14}" minlength="9" maxlength="9" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);" ><br>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Correo:</label>
                            <input type="email" id="email" name="email" class="form-control"><br>
                        </div>
                    </div>


                </div>



                <div class="row mb-3 campos-menor" style="display: none;" >
                    <div class="col-md-3 text-left">
                        <label class="form-label fw-semibold">¿Es menor de edad?</label>
                    </div>
                    <div class="col-md-9 ">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-check  text-left">
                                    <input class="form-check-input " type="radio" name="menor_edad" value="si" id="menorSi">
                                    <label class="form-check-label ml-2" for="menorSi">Sí</label>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-check text-left">
                                    <input class="form-check-input" type="radio" name="menor_edad" value="no" id="menorNo">
                                    <label class="form-check-label ml-2" for="menorNo">No</label>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>


                <div class="campos-apoderado text-left" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="dni_apoderado">DNI del Apoderado:</label>
                            <input type="text" id="dni_apoderado" minlength="8" maxlength="8" name="dni_apoderado" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);" ><br>
                        </div>
                        <div class="col-md-6">
                            <label for="nombres_apellidos_apoderado">Nombres Apellidos del Padre o Tutor:</label>
                            <input type="text" id="nombres_apellidos_apoderado" name="nombres_apellidos_apoderado" class="form-control" maxlength="100"><br>
                        </div>

                    </div>
                    <div class="">
                        <label for="direccion_apoderado">Dirección del Apoderado:</label>
                        <input type="text" id="direccion_apoderado" name="direccion_apoderado" class="form-control" maxlength="100"><br>
                    </div>
                </div>

                <div class=" text-left">

                    <label class="form-label fw-semibold">Manifiesto del Consumidor Reclamante</label>

                </div>

                <div class="row mt-3">

                    <div class="col-md-3 text-left">
                        <label class="form-label fw-semibold">Tipo:</label>
                    </div>
                    <div class="col-md-9 ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check text-left">
                                    <input class="form-check-input" type="radio" id="reclamo" name="tipo_reclamo" value="reclamo">
                                    <label class="form-check-label fw-semibold ml-2" for="reclamo">
                                        Reclamo
                                    </label>
                                    <p class="text-muted ms-2 mb-0 ml-2">Relacionado directamente con el producto o servicio contratado</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check text-left">
                                    <input class="form-check-input" type="radio" id="queja" name="tipo_reclamo" value="queja">
                                    <label class="form-check-label fw-semibold ml-2" for="queja">
                                        Queja
                                    </label>
                                    <p class="text-muted ms-2 mb-0 ml-2">Relacionado con la atención recibida por personal de atención al cliente.</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-3 text-left">
                        <label class="form-label fw-semibold">Bien Contratado:</label>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check text-left">
                                    <input class="form-check-input" type="radio" name="bien_contratado" value="producto" id="producto">
                                    <label class="form-check-label fw-semibold ml-2" for="producto">
                                        Producto
                                    </label>
                                    <p class="text-muted ms-2 mb-0 ml-2">Sepulturas / Nichos</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check  text-left">
                                    <input class="form-check-input" type="radio" name="bien_contratado" value="servicio" id="servicio">
                                    <label class="form-check-label fw-semibold ml-2" for="servicio">
                                        Servicio
                                    </label>
                                    <p class="text-muted ms-2 mb-0 ml-2">Servicios funerarios o Velatorio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cuadroReclamo mt-3 text-left" id="cuadroReclamo" style="display: none;">
                    <label for="textoReclamo">Detalle del reclamo:</label>
                    <textarea id="textoReclamo" name="texto_reclamo" rows="4" cols="50" class="form-control"></textarea>
                </div>

                <div class="cuadroQueja mt-3 text-left" id="cuadroQueja" style="display: none;">
                    <label for="textoQueja">Detalle de la queja:</label>
                    <textarea id="textoQueja" name="texto_queja" rows="4" cols="50" class="form-control"></textarea>
                </div>

                <div class="form-group mt-3 text-left">
                    <label for="detalle_reclamacion">Pedido del Consumidor:</label><br>
                    <textarea id="detalle_reclamacion" name="detalle_reclamacion" rows="4" class="form-control"></textarea><br>
                </div>




                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-1 col-2 d-flex align-items-center justify-content-end">
                            <input type="checkbox" id="leido_aceptado" name="leido_aceptado" class="form-check-input" required>
                        </div>
                        <div class="col-md-11 col-10 text-left">
                            <label class="form-check-label" for="leido_aceptado">
                                He leído y estoy de acuerdo con la <a href="#">Política de Privacidad</a> y <a href="#">Términos y Condiciones</a>.
                                O comunícate a nuestra Central Administrativa llamando al <a href="tel:+5117303030">(044) 230777</a>.
                            </label>
                        </div>
                    </div>
                </div>





                <div class="col-md-12  d-flex align-items-center justify-content-center mt-3">
                    <input type="submit" value="Enviar" class="btn btn-lg ">
                </div>



            </form>

            <script>

            </script>







        </div>

    </div>


   </div>


    <!-- Enlace a los scripts de Bootstrap (jQuery requerido) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1xZqSNZ7ldy8CNYtpkldZj/o0RNsmZdF3h6gHhXes9Jxm8rw/q5IzW2vG8pQVqb3" crossorigin="anonymous"></script>
</body>
</html>
