<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Encuesta sobre inform&aacute;ticos de Paraguay</title>

    <?php $this->load->view('comunes/cabecera');?>

    <style>
        graficoSexo graficoUbicacion {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>

    <script>
        window.onload = function() {
            getGraficoSexo();
            getUbicacion();
        };

        function getGraficoSexo(){
            $.ajax({
                type: "POST",
                url: "Graficos/getGraficoSexo",
                dataType: 'json',
                success: function(datos){
                    var contexto = document.getElementById("graficoSexo").getContext('2d');
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
                                  datos['cantidad_sexo_masc'],
                                  datos['cantidad_sexo_fem']]
                            }]
                        },
                        options: {
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
        function getUbicacion(){
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
                                text: 'Departamentos de Paraguay'
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
                                        stepSize: 1
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
            <canvas id="graficoSexo"></canvas>
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
