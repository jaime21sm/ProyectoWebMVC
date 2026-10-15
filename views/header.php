<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{ base }}/">
    <title>Ghost Hunter's Den | Fan Zone de Phasmophobia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body class="{% if caja %}pantalla-caja{% endif %}">
{% if !caja %}
<header>
    <div class="lema">&gt; Fan zone dedicada a Phasmophobia &lt;</div>
    <nav>
        {% each menu %}
        <a href="{{ item.ruta }}" class="{{ item.activo }}">{{ item.texto }}</a>
        {% endeach %}
    </nav>
</header>
<div class="contenido">
{% endif %}
 
