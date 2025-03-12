<!DOCTYPE html>
<html>
    <head>
        <title>Confirmación de Inscripción</title>
    </head>
    <body>
        <h1>Hola, {{ $registration->user->name }}</h1>
        <p>Tu inscripción al curso <strong>{{ $registration->course->name }}</strong> ha sido confirmada.</p>
        <p>Fecha de inicio: {{ now() }}</p>
        <p>¡Gracias por unirte!</p>
    </body>
</html>
