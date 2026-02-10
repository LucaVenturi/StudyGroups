<?php
    class DatabaseHelper
    {
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port)
        {
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }
            $this->db->set_charset("utf8mb4");
        }

        public function getGroups() {
            $query = <<<SQL
                SELECT
                    g.titolo,
                    g.descrizione,
                    g.data_esame,
                    g.max_partecipanti,
                    cdl.nome AS corso_di_laurea,
                    m.nome AS materia,
                    u.nome AS nome_creatore,
                    u.cognome AS cognome_creatore,
                    u.foto_profilo as foto_profilo_creatore
                FROM gruppi AS g
                JOIN materie AS m
                    ON g.nome_materia_studiata = m.nome AND g.id_cdl = m.id_cdl
                JOIN corsi_di_laurea AS cdl
                    ON m.id_cdl = cdl.id
                JOIN utenti AS u
                    ON g.id_creatore = u.id
            SQL;
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        function checkLogin($email, $password) {
            $query = <<<SQL
                SELECT * 
                FROM utenti 
                WHERE email = ?
            SQL;
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                unset($user['password']);
                return $user;
            }

            return false;
        }

    }
?>
