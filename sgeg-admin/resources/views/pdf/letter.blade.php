<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
           border: 1px solid aqua;
        }
        .page-break {
           page-break-after: always;
        }
   </style>

</head>
<body>
   <h2> hola {{ $name  }} que tal!!! </h2>
   <p>
    Estas invitado a tu graduación
   </p>
   <div class="page-break"></div> 
   <p>inserta un salto de pagina para controlar los parrafos y tamaño del documento</p>
</body>
</html>