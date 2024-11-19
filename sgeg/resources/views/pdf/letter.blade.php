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
   <h2>  Invitación: {{ $name }} </h2>
   <p>
      {!! html_entity_decode( $description) !!}
   </p>
   
  
   <div class="page-break"></div> 
   {{ $uri }} 
    
</body>
</html>