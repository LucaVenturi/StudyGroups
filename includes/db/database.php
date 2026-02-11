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

    public function getGroups()
    {
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

    function checkLogin($email, $password)
    {
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

    /** 
     * Registra un nuovo utente nel database. Restituisce i dati dell'utente registrato o false in caso di errore.
     * @param string $name Il nome dell'utente
     * @param string $surname Il cognome dell'utente
     * @param string $email L'email dell'utente
     * @param string $password La password dell'utente (non hashed, verrà hashata all'interno della funzione)
     * @param int|null $course L'ID del corso di laurea dell'utente (opzionale)
     * @param string|null $telegram Il contatto Telegram dell'utente (opzionale)
     * @return array|false I dati dell'utente registrato o false in caso di errore
     */
    function registerUser($name, $surname, $email, $password, $course = null, $telegram = null)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = <<<SQL
            INSERT INTO utenti(nome, cognome, email, password, is_admin, foto_profilo, telegram, id_cdl)
            VALUES (?, ?, ?, ?, 0, NULL, ?, ?);
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssi", $name, $surname, $email, $hashedPassword, $telegram, $course);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Recupera l'utente appena inserito.
            $userId = $this->db->insert_id;
            return $this->getUserById($userId);
        }

        return false;
    }

    /***
     * Recupera un utente dal database dato il suo ID.
     */
    private function getUserById($id)
    {
        $query = "SELECT id, nome, cognome, email, foto_profilo, is_admin, telegram, id_cdl FROM utenti WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
