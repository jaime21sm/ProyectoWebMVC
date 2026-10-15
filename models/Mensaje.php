<?php
class Mensaje
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function guardar(string $nombre, string $correo, string $fantasma, string $mensaje): bool
    {
        $sql = "INSERT INTO mensajes (nombre, correo, fantasma_favorito, mensaje, fecha_envio)
                VALUES (:nombre, :correo, :fantasma, :mensaje, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre'   => $nombre,
            ':correo'   => $correo,
            ':fantasma' => $fantasma,
            ':mensaje'  => $mensaje,
        ]);
    }
}
