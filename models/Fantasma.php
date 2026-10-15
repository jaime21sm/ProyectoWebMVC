<?php
class Fantasma
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function todos(): array
    {
        return $this->db->query("SELECT * FROM fantasmas ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
    }
}
