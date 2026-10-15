<h2>Contacto</h2>
<p>¿Tienes una historia de caza paranormal o quieres recomendarme un fantasma para investigar? Escríbeme:</p>
{% if exito %}
<div class="aviso-exito">{{ exito }}</div>
{% endif %}
{% if error %}
<div class="aviso-error">{{ error }}</div>
{% endif %}
<form action="contacto" method="POST">
    <div><label for="nombre">Tu Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" maxlength="80" required value="{{ old.nombre }}"></div>
    <div><label for="correo">Correo Electrónico:</label><br>
        <input type="email" id="correo" name="correo" maxlength="120" required value="{{ old.correo }}"></div>
    <div><label for="fantasma_favorito">Tu Fantasma Favorito:</label><br>
        <input type="text" id="fantasma_favorito" name="fantasma_favorito" maxlength="80" required value="{{ old.fantasma_favorito }}"></div>
    <div><label for="mensaje">Tu Mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" maxlength="1000" required>{{ old.mensaje }}</textarea></div>
    <button type="submit">Enviar Mensaje</button>
</form>
