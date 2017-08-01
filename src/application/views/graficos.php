<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Encuesta sobre inform&aacute;ticos de Paraguay</title>

    <?php $this->load->view('comunes/cabecera');?>

    <style>
        graficoTituloUniversitario graficoGenero getGraficoEdad getGraficoActividades graficoUbicacion{
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>

    <script>
        window.onload = function() {
            getGraficoTituloUniversitario();
            getGraficoGenero();
            getGraficoEdad();
            getGraficoActividades();
            getGraficoUbicacion();
        };

        function getGraficoTituloUniversitario(){
            $.ajax({
                type: "POST",
                url: "Graficos/getTituloUniversitario",
                dataType: 'json',
                success: function(p_datos){
                    var contexto = document.getElementById("graficoTituloUniversitario").getContext('2d');
                    var myChart = new Chart(contexto, {
                        type: 'pie',
                        data: {
                            labels: ["Si","No"],
                            datasets: [{
                                backgroundColor: [
                                    "#704ED5",
                                    "#24A04A"
                              ],
                              data: [
                                  p_datos['cantidad_titulo_universitario_si'],
                                  p_datos['cantidad_titulo_universitario_no']]
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'T\u00EDtulo universitario',
                                fontSize: 20
                            },
                            pieceLabel: {
                                // mode 'label', 'value' or 'percentage', default is 'percentage'
                                mode: 'value',

                                // precision for percentage, default is 0
                                precision: 0,

                                //identifies whether or not labels of value 0 are displayed, default is false
                                showZero: true,

                                // font size, default is defaultFontSize
                                fontSize: 14,

                                // font color, default is '#fff'
                                fontColor: '#fff',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // position to draw label, available value is 'default', 'border' and 'outside'
                                // default is 'default'
                                position: 'default',

                                // format text, work when mode is 'value'
                                format: function (value) {
                                    return value;
                                }
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                                        var tooltipLabel = data.labels[tooltipItem.index];
                                        var tooltipData = allData[tooltipItem.index];
                                        var total = 0;
                                        for (var i in allData) {
                                            total += allData[i] * 1;
                                        }
                                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                                        return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(){
                    alert("failure");
                }
            });
        }

        function getGraficoGenero(){
            $.ajax({
                type: "POST",
                url: "Graficos/getGraficoGenero",
                dataType: 'json',
                success: function(p_datos){
                    var contexto = document.getElementById("graficoGenero").getContext('2d');
                    var myChart = new Chart(contexto, {
                        type: 'pie',
                        data: {
                            labels: ["Masculino","Femenino"],
                            datasets: [{
                                backgroundColor: [
                                    "#3498db",
                                    "#e74c3c"
                              ],
                              data: [
                                  p_datos['cantidad_genero_masc'],
                                  p_datos['cantidad_genero_fem']]
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'G\u00E9nero',
                                fontSize: 20
                            },
                            pieceLabel: {
                                // mode 'label', 'value' or 'percentage', default is 'percentage'
                                mode: 'value',

                                // precision for percentage, default is 0
                                precision: 0,

                                //identifies whether or not labels of value 0 are displayed, default is false
                                showZero: true,

                                // font size, default is defaultFontSize
                                fontSize: 14,

                                // font color, default is '#fff'
                                fontColor: '#fff',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // position to draw label, available value is 'default', 'border' and 'outside'
                                // default is 'default'
                                position: 'default',

                                // format text, work when mode is 'value'
                                format: function (value) {
                                    return value;
                                }
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                                        var tooltipLabel = data.labels[tooltipItem.index];
                                        var tooltipData = allData[tooltipItem.index];
                                        var total = 0;
                                        for (var i in allData) {
                                            total += allData[i] * 1;
                                        }
                                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                                        return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(){
                    alert("failure");
                }
            });
        }

        function getGraficoEdad(){
            $.ajax({
                type: "POST",
                url: "Graficos/getGraficoEdad",
                dataType: 'json',
                success: function(p_datos){
                    var contexto = document.getElementById("graficoEdad").getContext('2d');
                    var myChart = new Chart(contexto, {
                        type: 'pie',
                        data: {
                            labels: ["18-25","26-30","31-35","36-40",">41"],
                            datasets: [{
                                backgroundColor: [
                                    "#E11111",
                                    "#198BD6",
                                    "#067B1B",
                                    "#D6B619",
                                    "#D61978"
                              ],
                              data: [
                                  p_datos['Edad18a25'],
                                  p_datos['Edad26a30'],
                                  p_datos['Edad31a35'],
                                  p_datos['Edad36a40'],
                                  p_datos['Edad41']
                              ]
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Edades',
                                fontSize: 20
                            },
                            pieceLabel: {
                                // mode 'label', 'value' or 'percentage', default is 'percentage'
                                mode: 'value',

                                // precision for percentage, default is 0
                                precision: 0,

                                //identifies whether or not labels of value 0 are displayed, default is false
                                showZero: true,

                                // font size, default is defaultFontSize
                                fontSize: 14,

                                // font color, default is '#fff'
                                fontColor: '#fff',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // position to draw label, available value is 'default', 'border' and 'outside'
                                // default is 'default'
                                position: 'default',

                                // format text, work when mode is 'value'
                                format: function (value) {
                                    return value;
                                }
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                                        var tooltipLabel = data.labels[tooltipItem.index];
                                        var tooltipData = allData[tooltipItem.index];
                                        var total = 0;
                                        for (var i in allData) {
                                            total += allData[i] * 1;
                                        }
                                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                                        return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(){
                    alert("failure");
                }
            });
        }

        function getGraficoActividades(){
            $.ajax({
                type: "POST",
                url: "Graficos/getGraficoActividades",
                dataType: 'json',
                success: function(p_datos){
                    var contexto = document.getElementById("graficoActividades").getContext('2d');
                    var myChart = new Chart(contexto, {
                        type: 'pie',
                        data: {
                            labels: ["Organizar Proyectos","Analizar","Programar","Testear","Infraestructura","Soporte Usuarios","Soporte Técnico"],
                            datasets: [{
                                backgroundColor: [
                                    "#23157E",
                                    "#801F1A",
                                    "#A93906",
                                    "#AAAB0A",
                                    "#AB0A84",
                                    "#1F4522",
                                    "#00BD94"
                              ],
                              data: [
                                  p_datos['OrganizarProyectos'],
                                  p_datos['Analizar'],
                                  p_datos['Programar'],
                                  p_datos['Testear'],
                                  p_datos['Infraestructura'],
                                  p_datos['SoporteUsuarios'],
                                  p_datos['SoporteTecnico']
                              ]
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Actividades',
                                fontSize: 20
                            },
                            pieceLabel: {
                                // mode 'label', 'value' or 'percentage', default is 'percentage'
                                mode: 'value',

                                // precision for percentage, default is 0
                                precision: 0,

                                //identifies whether or not labels of value 0 are displayed, default is false
                                showZero: true,

                                // font size, default is defaultFontSize
                                fontSize: 14,

                                // font color, default is '#fff'
                                fontColor: '#fff',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // position to draw label, available value is 'default', 'border' and 'outside'
                                // default is 'default'
                                position: 'default',

                                // format text, work when mode is 'value'
                                format: function (value) {
                                    return value;
                                }
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                                        var tooltipLabel = data.labels[tooltipItem.index];
                                        var tooltipData = allData[tooltipItem.index];
                                        var total = 0;
                                        for (var i in allData) {
                                            total += allData[i] * 1;
                                        }
                                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                                        return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(){
                    alert("failure");
                }
            });
        }

        // function
        function getGraficoUbicacion(){
            $.ajax({
                type: "POST",
                url: "Graficos/getUbicacion",
                dataType: 'json',
                success: function(p_datos){
                    var contexto = document.getElementById("graficoUbicacion").getContext('2d');
                    var v_array_departamentos = Array();
            		var v_array_cantidad = Array();
            		for(var v_departamento_id in p_datos){
            			v_array_departamentos.push(p_datos[v_departamento_id].nombre);
            			v_array_cantidad.push(p_datos[v_departamento_id].cantidad);
            		}

                    var barData = {
                        labels: v_array_departamentos,
                        datasets: [{
                            label: 'Departamentos',
                            backgroundColor: 'rgba(128,164,237, 0.8)',
                            borderColor: 'rgba(128,164,237, 1)',
                            borderWidth: 1,
                            data: v_array_cantidad
                        }]
                    };

                    var myChart = new Chart(contexto, {
                        type: 'bar',
                        data: barData,
                        options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Lugares de trabajo por departamento',
                                fontSize: 20
                            },
                            scales: {
                                xAxes: [{
                                    gridLines : {
                                        display : false
                                    }
                                }],
                                yAxes: [{
                                    gridLines : {
                                        display : false
                                    },
                                    ticks: {
                                        stepSize: 5,
                                        min: 0
                                    }
                                }]
                            }
                        }
                    });
                },
                error: function(){
                    alert("failure");
                }
            });
        }
    </script>

</head>
<body>
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

    <div class="container" style="width: 75%;">
        <div class="row">
            <canvas id="graficoTituloUniversitario"></canvas>
        </div>
    </div>
    </br>
    </br>
    <div class="container" style="width: 75%;">
        <div class="row">
            <canvas id="graficoGenero"></canvas>
        </div>
    </div>
    </br>
    </br>
    <div class="container" style="width: 75%;">
        <div class="row">
            <canvas id="graficoEdad"></canvas>
        </div>
    </div>
    </br>
    </br>
    <div class="container" style="width: 75%;">
        <div class="row">
            <canvas id="graficoActividades"></canvas>
        </div>
    </div>
    </br>
    </br>
    <div class="container" style="width: 75%;">
        <div class="row">
            <canvas id="graficoUbicacion"></canvas>
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
