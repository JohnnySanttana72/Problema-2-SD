<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Título Opcional</title>
 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
 
        <h1>Certificado Empreendimento {{$property->name}}</h1>
     
        <div>
            <p><span>Status:</span> {{$property->status}}</p>
            <p><span>Preço:</span> R$ {{$property->price}}</p>
            <p><span>Ponto de Referência:</span> {{$property->reference_point}}</p>
        </div>
 
    </body>
</html>
