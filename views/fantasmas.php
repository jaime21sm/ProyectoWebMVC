<h2>Tipos de Fantasmas</h2>
<div class="grid-fantasmas">
    {% each fantasmas %}
    <div class="tarjeta">
        <div class="icono-svg">{{{ item.svg }}}</div>
        <h3>{{ item.nombre }}</h3>
        <p>{{ item.descripcion }}</p>
        <p class="evidencias">Evidencias: {{ item.evidencias }}</p>
    </div>
    {% endeach %}
</div>
