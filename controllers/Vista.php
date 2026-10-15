<?php
/**
 * Motor de plantillas mínimo. Las vistas son archivos .html sin PHP.
 *
 * Sintaxis:
 *   {{ variable }}        valor escapado (admite rutas: old.nombre, item.color)
 *   {{{ variable }}}      valor sin escapar (solo para HTML/SVG generado por nosotros)
 *   {% if variable %} ... {% else %} ... {% endif %}      ({% if !variable %} para negar)
 *   {% each lista %} ... {{ item.campo }} ... {% endeach %}
 */
class Vista
{
    private array $guardado = [];

    public static function render(string $archivo, array $datos = []): string
    {
        $vista = new self();
        $tpl = file_get_contents($archivo);
        if ($tpl === false) {
            throw new RuntimeException("No se encontró la vista: $archivo");
        }
        return $vista->terminar($vista->procesar($tpl, $datos));
    }

    private function procesar(string $tpl, array $ctx): string
    {
        // 1) Bucles
        $tpl = preg_replace_callback(
            '/\{%\s*each\s+([\w.]+)\s*%\}(.*?)\{%\s*endeach\s*%\}/s',
            function ($m) use ($ctx) {
                $lista = $this->valor($m[1], $ctx);
                $salida = '';
                if (is_array($lista)) {
                    foreach ($lista as $fila) {
                        $salida .= $this->procesar($m[2], ['item' => $fila] + $ctx);
                    }
                }
                return $this->guardar($salida);
            },
            $tpl
        );

        // 2) Condicionales
        $tpl = preg_replace_callback(
            '/\{%\s*if\s+(!?)([\w.]+)\s*%\}(.*?)(?:\{%\s*else\s*%\}(.*?))?\{%\s*endif\s*%\}/s',
            function ($m) use ($ctx) {
                $cierto = (bool)$this->valor($m[2], $ctx);
                if ($m[1] === '!') {
                    $cierto = !$cierto;
                }
                $bloque = $cierto ? $m[3] : ($m[4] ?? '');
                return $this->guardar($this->procesar($bloque, $ctx));
            },
            $tpl
        );

        // 3) Variables sin escapar y escapadas (una sola pasada, la salida no se vuelve a interpretar)
        $tpl = preg_replace_callback(
            '/\{\{\{\s*([\w.]+)\s*\}\}\}|\{\{\s*([\w.]+)\s*\}\}/',
            function ($m) use ($ctx) {
                if (($m[1] ?? '') !== '') {
                    return $this->guardar((string)$this->valor($m[1], $ctx));
                }
                return $this->guardar(htmlspecialchars((string)$this->valor($m[2], $ctx), ENT_QUOTES, 'UTF-8'));
            },
            $tpl
        );

        return $tpl;
    }

    private function valor(string $ruta, array $ctx)
    {
        $actual = $ctx;
        foreach (explode('.', $ruta) as $clave) {
            if (is_array($actual) && array_key_exists($clave, $actual)) {
                $actual = $actual[$clave];
            } else {
                return '';
            }
        }
        return $actual;
    }

    // Guarda la salida ya resuelta y deja un marcador para que no se re-interprete
    private function guardar(string $texto): string
    {
        $this->guardado[] = $texto;
        return "\x01" . (count($this->guardado) - 1) . "\x02";
    }

    private function terminar(string $tpl): string
    {
        // Los marcadores pueden contener otros marcadores (bucles dentro de bucles/ifs)
        while (preg_match('/\x01(\d+)\x02/', $tpl)) {
            $tpl = preg_replace_callback('/\x01(\d+)\x02/', fn($m) => $this->guardado[(int)$m[1]], $tpl);
        }
        return $tpl;
    }
}
