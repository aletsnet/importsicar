<!DOCTYPE html>
<html>
    <head>
        <title>Ticket</title>
         <meta charset="UTF-8">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="plugins/ionicons-2.0.1/css/ionicons.min.css">
        <style>
        table{
            width: 250px;
        }
        .fecha{
            font: italic bold 10px Georgia, serif;
        }
        .titulo{
            font: normal bold 16px Console;
            text-align: center;
        }
        .lcampo{
            font: normal bold 11px Console;
            text-align: left;
        }
        .rcampo{
            font: normal bold 11px Console;
            text-align: right;
        }
        .lcampos{
            font: normal 11px Console;
            text-align: left;
        }
        .rcampos{
            font: normal 11px Console;
            text-align: right;
        }
        .campo{
            font: normal bold 11px Console;
            text-align: center;
            text-transform: uppercase;
        }
        </style>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body onload="">
        @yield('etiqueta')
        <script>
		//window.print();
		//window.close();
        </script>
    </body>
    </html>