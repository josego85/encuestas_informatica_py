<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
    <title>Encuesta sobre inform&aacute;ticos de Paraguay</title>

    <?php $this->load->view('comunes/cabecera');?>
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
                           <h1>Encuesta sobre inform&aacute;ticos de Paraguay</h1>
                       </div>
                   </div>
               </div>
           </div>

           <div class="row">
               <div class="col-md-6">
                  <h3 class="resultados">Resultados</h3>
               </div>
               <div class="col-md-6">
                  <h3 class="contactos">Contactos</h3>
               </div>
           </div>
      </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="well well-sm">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <legend class="text-center header">Encuesta</legend>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Sexo</label>
                                <div class="col-xs-5 selectContainer">
                                    <select class="form-control" name="sexo">
                                        <option value="" hidden>Seleccionar sexo</option>
                                        <option value="m">Masculino (M)</option>
                                        <option value="f">Femenino (F)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="latitud" name="latitud" type="hidden" placeholder="Latitud" class="form-control">
                                </div>
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="longitud" name="longitud" type="hidden" placeholder="Longitud" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <div class="panel panel-default">
                        <div class="text-center header">Donde Trabajas</div>
                        <div class="panel-body text-center">
                            <div id="mapa" class="mapa">
                            </div>
                            <hr />
                            <h4>Info</h4>
                            <div>
                                Encuesta An&oacute;nima<br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container text-center">
                <p class="navbar-text col-md-12 col-sm-12 col-xs-12">
                    <?php $this->load->view('comunes/pie_pagina');?>
                </p>
            </div>
        </nav>
    </footer>
</body>
</html>
