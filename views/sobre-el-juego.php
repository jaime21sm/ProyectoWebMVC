<h2>Sobre Phasmophobia</h2>
<p>Phasmophobia es un juego de terror psicológico cooperativo desarrollado por Kinetic Games. Hasta cuatro jugadores forman un equipo de investigación paranormal.</p>
<h2 class="separado">Equipo de Caza</h2>
<div class="grid-equipo">
    {% each equipo %}
    <div class="equipo-item">
        <div class="icono-svg">{{{ item.svg }}}</div>
        <p>{{ item.nombre }}</p>
    </div>
    {% endeach %}
</div>

