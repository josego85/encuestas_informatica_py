<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
    <title>Encuesta sobre inform&aacute;ticos de Paraguay</title>

    <?php $this->load->view('comunes/cabecera');?>

    <script>
        $(document).ready(function(){
            $("#encuesta").submit(function(event){
                // Cancels the form submission.
                event.preventDefault();
                submitForm();
            });
        });

        function submitForm(){
            $.ajax({
                type: "POST",
                url: "Encuesta/enviarDatos",
                data: $('form.encuesta').serialize(),
                dataType: 'json',
                success: function(respuesta){
                    if(respuesta.success){
                        formSuccess();
                    }else{
                         // Muestra el mensaje oculto.
                         // @todo mostrar los errores que vienen del php
                         $("#msgErrores").removeClass( "hidden" );
                    }
                },
                error: function(){
                    alert("failure");
                }
            });
        }

        function formSuccess(){
            // Muestra el mensaje oculto.
            $("#msgSubmit").removeClass( "hidden" );

            // Limpia el formulario.
            $('form').get(0).reset();
        }
    </script>
</head>
<body onLoad="cargarMapa()">
    <header>
       <div class="container">
           <div class="row">
               <div class="col-md-offset-2 col-md-8">
                   <br/>
                   <br/>
                   <div class="panel panel-default">
                       <div class="panel-heading text-center">
                           <h1><a href="inicio">Encuesta sobre inform&aacute;ticos de Paraguay</h1>
                       </div>
                   </div>
               </div>
           </div>
           <?php $this->load->view('comunes/menu');?>
      </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form id="encuesta" class="form-horizontal encuesta" method="post" role="form">
                        <fieldset>
                            <legend class="text-center header">Encuesta</legend>
                            <div id="msgErrores" class="h3 text-center hidden">Errores!!!</div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">T&iacute;tulo universitario</label>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="titulo_universitario" value="si">S&iacute;
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="titulo_universitario" value="no">No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="control-label col-sm-3">G&eacute;nero</label>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="genero" value="f" required>Femenino
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="genero" value="m" required>Masculino
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label for="edad" class="col-sm-3 control-label">Edad</label>
                                <div class="col-sm-9">
                                    <input type="number" name="edad" placeholder="Edad" class="form-control"
                                      min="1" max="99" step="1" data-bind="value:replyNumber"
                                      oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                      maxlength = "2" required>
                                    <span class="help-block">Edad, ej.: 31</span>
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="latitud" name="latitud" type="hidden" placeholder="Latitud" class="form-control">
                                </div>
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="longitud" name="longitud" type="hidden" placeholder="Longitud" class="form-control">
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <div class="text-center"><h3>Donde Trabajas</h3></div>
                                <div class="panel-body text-center">
                                    <div id="mapa" class="text-align:center mapa">
                                    </div>
                                </div>
                            </div>
                            <!-- form-group -->
                        </fieldset>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" id="submit" class="btn btn-primary btn-lg">Enviar</button>
                                <div id="msgSubmit" class="h3 text-center hidden">
                                    Encuesta enviada!!!
                                    <a href="Graficos">Resultados</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container text-center">
                <p class="navbar-text col-md-12 col-sm-12 col-xs-12">
                    <?php $this->load->view('comunes/pie_pagina');?>
                </p>
            </div>
        </nav>
    </footer>
</body>
</html>
