<?php
require_once __DIR__ . '/../models/Fantasma.php';
require_once __DIR__ . '/../models/Mensaje.php';
require_once __DIR__ . '/svg.php';
require_once __DIR__ . '/Vista.php';

class SiteController
{
    private PDO $db;
    private Fantasma $fantasmaModel;
    private Mensaje $mensajeModel;

    private array $vistas = ['entrada', 'bienvenida', 'inicio', 'sobre-el-juego', 'fantasmas', 'galeria', 'contacto'];

    public function __construct(PDO $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = $db;
        $this->fantasmaModel = new Fantasma($db);
        $this->mensajeModel = new Mensaje($db);
    }

    public function manejarPeticion(): void
    {
        $url = trim($_GET['url'] ?? '', '/');
        if ($url === '') {
            $url = isset($_SESSION['investigador']) ? 'inicio' : 'entrada';
        }

        if (!in_array($url, $this->vistas, true)) {
            http_response_code(404);
            $this->render('404', ['vista' => '404', 'caja' => false]);
            return;
        }

        // Las secciones internas requieren haber entrado con un nombre
        if (!in_array($url, ['entrada'], true) && !isset($_SESSION['investigador'])) {
            $this->redirigir('entrada');
        }

        switch ($url) {
            case 'entrada':        $this->entrada(); break;
            case 'bienvenida':     $this->render('bienvenida', ['vista' => $url, 'caja' => true]); break;
            case 'inicio':         $this->render('inicio', ['vista' => $url, 'caja' => false, 'svg_casa' => svgCasaEmbrujada()]); break;
            case 'sobre-el-juego': $this->sobreElJuego(); break;
            case 'fantasmas':      $this->fantasmas(); break;
            case 'galeria':        $this->render('galeria', ['vista' => $url, 'caja' => false, 'svg_habitacion' => svgHabitacion()]); break;
            case 'contacto':       $this->contacto(); break;
        }
    }

    private function entrada(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['investigador'] ?? '');
            if ($nombre !== '') {
                $_SESSION['investigador'] = $nombre;
                $this->redirigir('bienvenida');
            }
        }
        $this->render('entrada', ['vista' => 'entrada', 'caja' => true]);
    }

    private function sobreElJuego(): void
    {
        $equipo = [
            ['nombre' => 'Detector EMF',         'svg' => svgEquipo('emf')],
            ['nombre' => 'Cámara de espíritus',  'svg' => svgEquipo('camara')],
            ['nombre' => 'Linterna UV',          'svg' => svgEquipo('linterna')],
            ['nombre' => 'Termómetro',           'svg' => svgEquipo('termometro')],
        ];
        $this->render('sobre-el-juego', ['vista' => 'sobre-el-juego', 'caja' => false, 'equipo' => $equipo]);
    }

    private function fantasmas(): void
    {
        $lista = $this->fantasmaModel->todos();
        foreach ($lista as &$f) {
            $f['svg'] = svgFantasma($f['color']);
        }
        unset($f);
        $this->render('fantasmas', ['vista' => 'fantasmas', 'caja' => false, 'fantasmas' => $lista]);
    }

    private function contacto(): void
    {
        $error = '';
        $exito = '';
        $old = ['nombre' => '', 'correo' => '', 'fantasma_favorito' => '', 'mensaje' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($old as $campo => $_) {
                $old[$campo] = trim($_POST[$campo] ?? '');
            }

            if (in_array('', $old, true)) {
                $error = 'Todos los campos son obligatorios.';
            } elseif (!filter_var($old['correo'], FILTER_VALIDATE_EMAIL)) {
                $error = 'Por favor, introduce un correo electrónico válido.';
            } else {
                try {
                    $this->mensajeModel->guardar($old['nombre'], $old['correo'], $old['fantasma_favorito'], $old['mensaje']);
                    $_SESSION['flash'] = "¡Gracias, " . $old['nombre'] . "! Tu mensaje fue recibido y guardado.";
                    $this->redirigir('contacto');
                } catch (PDOException $e) {
                    $error = 'Error al guardar el mensaje. Intenta de nuevo.';
                }
            }
        }

        if (isset($_SESSION['flash'])) {
            $exito = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        $this->render('contacto', [
            'vista'      => 'contacto',
            'caja'       => false,
            'error'      => $error,
            'exito'      => $exito,
            'old'        => $old,
        ]);
    }

    private function baseUrl(): string
    {
        return rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    }

    private function redirigir(string $ruta): void
    {
        header('Location: ' . $this->baseUrl() . '/' . $ruta);
        exit;
    }

    private function render(string $archivo, array $datos = []): void
    {
        $datos['base'] = $this->baseUrl();
        $datos['anio'] = date('Y');
        $datos['investigador'] = $_SESSION['investigador'] ?? '';
        $datos['menu'] = $this->menu($datos['vista'] ?? '');

        $dir = __DIR__ . '/../views/';

        $rutaArchivo = $dir . $archivo . '.php';

        if (!file_exists($rutaArchivo)) {
            http_response_code(500);
            echo "Error: La vista '" . htmlspecialchars($archivo) . "' no existe en la carpeta views.";
            exit;
        }

        // Página completa = header + vista + footer
        echo Vista::render($dir . 'header.php', $datos);
        echo Vista::render($rutaArchivo, $datos);
        echo Vista::render($dir . 'footer.php', $datos);
    }

    private function menu(string $actual): array
    {
        $items = [
            'inicio'         => 'Inicio',
            'sobre-el-juego' => 'Sobre el Juego',
            'fantasmas'      => 'Tipos de Fantasmas',
            'galeria'        => 'Galería',
            'contacto'       => 'Contacto',
        ];
        $menu = [];
        foreach ($items as $ruta => $texto) {
            $menu[] = ['ruta' => $ruta, 'texto' => $texto, 'activo' => $ruta === $actual ? 'activo' : ''];
        }
        return $menu;
    }
}