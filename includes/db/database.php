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
                    g.id,
                    g.titolo,
                    g.descrizione,
                    g.data_esame,
                    COUNT(p.id_partecipante) AS num_partecipanti,
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
                LEFT JOIN partecipazioni AS p
                    ON g.id = p.id_gruppo
                GROUP BY g.id
            SQL;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGroupsFiltered($courseId = null, $subject = null, $date = null, $showFull = false) {
        $query = <<<SQL
            SELECT
                g.id,
                g.titolo,
                g.descrizione,
                g.data_esame,
                COUNT(p.id_partecipante) AS num_partecipanti,
                g.max_partecipanti,
                cdl.nome AS corso_di_laurea,
                m.nome AS materia,
                u.nome AS nome_creatore,
                u.cognome AS cognome_creatore,
                u.foto_profilo as foto_profilo_creatore
            FROM gruppi AS g
            JOIN materie AS m 
                ON g.nome_materia_studiata = m.nome 
                AND g.id_cdl = m.id_cdl
            JOIN corsi_di_laurea AS cdl 
                ON m.id_cdl = cdl.id
            JOIN utenti AS u 
                ON g.id_creatore = u.id
            LEFT JOIN partecipazioni AS p 
                ON g.id = p.id_gruppo
        SQL;

        $conditions = [];   // Memorizza le eventuali condizioni da verificare nel WHERE
        $params = [];       // Memorizza gli eventuali parametri da bindare
        $types = "";        // Memorizza gli eventuali tipi dei parametri da bindare

        // Se è stato passato un corso aggiunge un filtro su id_cdl
        if ($courseId) {
            $conditions[] = "g.id_cdl = ?";
            $params[] = $courseId;
            $types .= "i";
        }

        // Se è stata passata una materia aggiunge un filtro su nome_materia_studiata
        if ($subject) {
            $conditions[] = "g.nome_materia_studiata = ?";
            $params[] = $subject;
            $types .= "s";
        }

        // Se è stata passata una data aggiunge un filtro su data_esame
        if ($date) {
            $conditions[] = "g.data_esame <= ?";
            $params[] = $date;
            $types .= "s";
        }

        // Se c'erano delle condizioni le aggiunge in fondo alla query.
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        // Aggiunge il GROUP BY che deve essere dopo il WHERE.
        $query .= " GROUP BY g.id";

        // Se vuole vedere solo i gruppi con posti disponibili.
        if ($showFull) {
            $query .= " HAVING COUNT(p.id_partecipante) < g.max_partecipanti";
        }

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Errore nella preparazione della query: " . $this->db->error);
            return [];
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGroupsFilteredPaginated($courseId = null, $subject = null, $date = null, $showFull = false, $limit, $offset) {
        $query = <<<SQL
            SELECT
                g.id,
                g.titolo,
                g.descrizione,
                g.data_esame,
                COUNT(p.id_partecipante) AS num_partecipanti,
                g.max_partecipanti,
                cdl.nome AS corso_di_laurea,
                m.nome AS materia,
                u.nome AS nome_creatore,
                u.cognome AS cognome_creatore,
                u.foto_profilo as foto_profilo_creatore
            FROM gruppi AS g
            JOIN materie AS m 
                ON g.nome_materia_studiata = m.nome 
                AND g.id_cdl = m.id_cdl
            JOIN corsi_di_laurea AS cdl 
                ON m.id_cdl = cdl.id
            JOIN utenti AS u 
                ON g.id_creatore = u.id
            LEFT JOIN partecipazioni AS p 
                ON g.id = p.id_gruppo
        SQL;

        $conditions = [];   // Memorizza le eventuali condizioni da verificare nel WHERE
        $params = [];       // Memorizza gli eventuali parametri da bindare
        $types = "";        // Memorizza gli eventuali tipi dei parametri da bindare

        // Se è stato passato un corso aggiunge un filtro su id_cdl
        if ($courseId) {
            $conditions[] = "g.id_cdl = ?";
            $params[] = $courseId;
            $types .= "i";
        }

        // Se è stata passata una materia aggiunge un filtro su nome_materia_studiata
        if ($subject) {
            $conditions[] = "g.nome_materia_studiata = ?";
            $params[] = $subject;
            $types .= "s";
        }

        // Se è stata passata una data aggiunge un filtro su data_esame
        if ($date) {
            $conditions[] = "g.data_esame <= ?";
            $params[] = $date;
            $types .= "s";
        }

        // Se c'erano delle condizioni le aggiunge in fondo alla query.
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        // Aggiunge il GROUP BY che deve essere dopo il WHERE.
        $query .= " GROUP BY g.id";

        // Se vuole vedere solo i gruppi con posti disponibili.
        if ($showFull) {
            $query .= " HAVING COUNT(p.id_partecipante) < g.max_partecipanti";
        }

        $query .= " LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";

        $stmt = $this->db->prepare($query);

        if (!$stmt) {
            error_log("Errore nella preparazione della query: " . $this->db->error);
            return [];
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countGroupsFiltered(
        $courseId = null,
        $subject = null,
        $date = null,
        $showFull = false
    ) {
        $query = <<<SQL
            SELECT COUNT(DISTINCT g.id) AS total
            FROM gruppi g
            LEFT JOIN partecipazioni p ON g.id = p.id_gruppo
        SQL;

        $conditions = [];
        $params = [];
        $types = "";

        if ($courseId) {
            $conditions[] = "g.id_cdl = ?";
            $params[] = $courseId;
            $types .= "i";
        }

        if ($subject) {
            $conditions[] = "g.nome_materia_studiata = ?";
            $params[] = $subject;
            $types .= "s";
        }

        if ($date) {
            $conditions[] = "g.data_esame <= ?";
            $params[] = $date;
            $types .= "s";
        }

        if ($conditions) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        if ($showFull) {
            $query .= " HAVING COUNT(p.id_partecipante) < g.max_partecipanti";
        }

        $stmt = $this->db->prepare($query);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return (int)$stmt->get_result()->fetch_assoc()['total'];
    }

    function getGroupsCreatedBy($userId)
    {
        $query = <<<SQL
            SELECT
                g.id,
                g.titolo,
                g.descrizione,
                g.data_esame,
                COUNT(p.id_partecipante) AS num_partecipanti,
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
            LEFT JOIN partecipazioni AS p
                ON g.id = p.id_gruppo
            WHERE g.id_creatore = ?
            GROUP BY g.id
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getGroupsWithParticipant($userId)
    {
        $query = <<<SQL
            SELECT
                g.id,
                g.titolo,
                g.descrizione,
                g.data_esame,
                (SELECT COUNT(*) FROM partecipazioni WHERE id_gruppo = g.id) AS num_partecipanti,
                g.max_partecipanti,
                cdl.nome AS corso_di_laurea,
                m.nome AS materia,
                u.nome AS nome_creatore,
                u.cognome AS cognome_creatore,
                u.foto_profilo AS foto_profilo_creatore
            FROM gruppi g
            JOIN materie m 
                ON g.nome_materia_studiata = m.nome 
                AND g.id_cdl = m.id_cdl
            JOIN corsi_di_laurea cdl 
                ON m.id_cdl = cdl.id
            JOIN utenti u ON g.id_creatore = u.id
            WHERE EXISTS (
                SELECT 1 FROM partecipazioni p
                WHERE p.id_gruppo = g.id AND p.id_partecipante = ?
            );
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
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
    function getUserById($id)
    {
        $query = "SELECT id, nome, cognome, email, foto_profilo, is_admin, telegram, id_cdl FROM utenti WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        unset($user['password']);
        return $user;
    }

    function getGroupById($groupId)
    {
        $query = <<<SQL
            SELECT
                g.id,
                g.titolo,
                g.descrizione,
                g.data_esame,
                (SELECT COUNT(*) FROM partecipazioni WHERE id_gruppo = g.id) AS num_partecipanti,
                g.max_partecipanti,
                g.id_cdl,
                cdl.nome AS corso_di_laurea,
                m.nome AS materia,
                u.nome AS nome_creatore,
                u.cognome AS cognome_creatore,
                u.foto_profilo AS foto_profilo_creatore
            FROM gruppi g
            JOIN materie m 
                ON g.nome_materia_studiata = m.nome 
                AND g.id_cdl = m.id_cdl
            JOIN corsi_di_laurea cdl 
                ON m.id_cdl = cdl.id
            JOIN utenti u 
                ON g.id_creatore = u.id
            WHERE g.id = ?;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    function getGroupCreator($groupId)
    {
        $query = <<<SQL
            SELECT 
                u.id, 
                u.nome, 
                u.cognome, 
                u.email, 
                u.foto_profilo, 
                u.telegram, 
                cdl.nome AS corso_di_laurea
            FROM gruppi g
            JOIN utenti u 
                ON g.id_creatore = u.id
            LEFT JOIN corsi_di_laurea cdl 
                ON u.id_cdl = cdl.id
            WHERE g.id = ?;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    function getGroupParticipants($groupId)
    {
        $query = <<<SQL
            SELECT 
                u.id, 
                u.nome, 
                u.cognome, 
                u.email, 
                u.foto_profilo, 
                u.telegram, 
                cdl.nome AS corso_di_laurea
            FROM partecipazioni p
            JOIN utenti u 
                ON p.id_partecipante = u.id
            LEFT JOIN corsi_di_laurea cdl
                ON u.id_cdl = cdl.id
            WHERE p.id_gruppo = ?;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function doesGroupExist($groupId)
    {
        $query = <<<SQL
            SELECT EXISTS(
                SELECT 1 FROM gruppi WHERE id = ?
            ) AS group_exists;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        $result = $stmt->get_result();
        return (bool)$result->fetch_assoc()['group_exists'];
    }

    public function isGroupFull($groupId) {
        $query = <<<SQL
            SELECT ((COUNT(DISTINCT p.id_partecipante) + 1) >= g.max_partecipanti) AS is_full
            FROM gruppi g
            LEFT JOIN partecipazioni p
                ON g.id = p.id_gruppo
            WHERE g.id = ?;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        $result = $stmt->get_result();

        return (bool) $result->fetch_assoc()['is_full'];
    }

    function isUserGroupCreator($userId, $groupId)
    {
        $query = <<<SQL
            SELECT EXISTS(
                SELECT 1 FROM gruppi 
                WHERE id = ? AND id_creatore = ?
            ) AS is_creator;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $groupId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return (bool)$result->fetch_assoc()['is_creator'];
    }

    function isUserGroupParticipant($userId, $groupId)
    {
        $query = <<<SQL
            SELECT EXISTS(
                SELECT 1 FROM partecipazioni 
                WHERE id_gruppo = ? AND id_partecipante = ?
            ) AS is_partecipant;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $groupId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return (bool)$result->fetch_assoc()['is_partecipant'];
    }

    function joinGroup($userId, $groupId)
    {
        $query = <<<SQL
            INSERT INTO partecipazioni(id_gruppo, id_partecipante)
            VALUES (?, ?);
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $groupId, $userId);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    function leaveGroup($userId, $groupId)
    {
        $query = <<<SQL
            DELETE FROM partecipazioni
            WHERE id_gruppo = ? AND id_partecipante = ?;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $groupId, $userId);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    function deleteGroup($groupId)
    {
        $query = <<<SQL
            DELETE FROM gruppi
            WHERE id = ?
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $groupId);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    function insertGroup($title, $description, $examDate, $maxParticipants, $courseId, $subject, $creatorId)
    {
        $query = <<<SQL
            INSERT INTO gruppi(titolo, descrizione, data_esame, max_partecipanti, id_cdl, nome_materia_studiata, id_creatore)
            VALUES (?, ?, ?, ?, ?, ?, ?);
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssiisi", $title, $description, $examDate, $maxParticipants, $courseId, $subject, $creatorId);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    function editGroup($groupId, $title, $description, $examDate, $maxParticipants, $courseId, $subject)
    {
        $query = <<<SQL
            UPDATE gruppi
            SET titolo = ?, descrizione = ?, data_esame = ?, max_partecipanti = ?, id_cdl = ?, nome_materia_studiata = ?
            WHERE id = ?;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssiisi", $title, $description, $examDate, $maxParticipants, $courseId, $subject, $groupId);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    function getCourses()
    {
        $query = <<<SQL
            SELECT * FROM corsi_di_laurea;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubjectsByCourse($courseId)
    {
        $query = <<<SQL
            SELECT * 
            FROM materie 
            WHERE id_cdl = ?;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $courseId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCreatedGroupsCount($userId)
    {
        $query = <<<SQL
            SELECT COUNT(*) AS count
            FROM gruppi
            WHERE id_creatore = ?;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return (int)$result->fetch_assoc()['count'];
    }

    public function getJoinedGroupsCount($userId)
    {
        $query = <<<SQL
            SELECT COUNT(*) AS count
            FROM partecipazioni
            WHERE id_partecipante = ?;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return (int)$result->fetch_assoc()['count'];
    }

    public function updateUser($userId, $nome, $cognome, $email, $fotoProfilo, $telegram, $corso)
    {
        $query = <<<SQL
            UPDATE utenti
            SET nome = ?, cognome = ?, email = ?, foto_profilo = ?, telegram = ?, id_cdl = ?
            WHERE id = ?;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssii", $nome, $cognome, $email, $fotoProfilo, $telegram, $corso, $userId);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function insertCourse($name)
    {
        $query = <<<SQL
            INSERT INTO corsi_di_laurea(nome)
            VALUES (?);
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function editCourse($courseId, $name)
    {
        $query = <<<SQL
            UPDATE corsi_di_laurea
            SET nome = ?
            WHERE id = ?;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $name, $courseId);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function deleteCourse($courseId)
    {
        $query = <<<SQL
            DELETE FROM corsi_di_laurea
            WHERE id = ?;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $courseId);

        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function doesCourseExist($courseId)
    {
        $query = <<<SQL
            SELECT EXISTS(
                SELECT 1 FROM corsi_di_laurea WHERE id = ?
            ) AS course_exists;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $courseId);

        $stmt->execute();
        $result = $stmt->get_result();

        return (bool) $result->fetch_assoc()['course_exists'];
    }

    public function createSubject($courseId, $name)
    {
        $query = <<<SQL
            INSERT INTO materie (id_cdl, nome)
            VALUES (?, ?);
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $courseId, $name);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function deleteSubject($courseId, $name)
    {
        $query = <<<SQL
            DELETE FROM materie
            WHERE id_cdl = ? AND nome = ?;
        SQL;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $courseId, $name);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function doesSubjectExist($courseId, $name)
    {
        $query = <<<SQL
            SELECT EXISTS(
                SELECT 1 
                FROM materie
                WHERE id_cdl = ? AND nome = ?
            ) AS subject_exists;
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $courseId, $name);

        $stmt->execute();
        $result = $stmt->get_result();

        return (bool) $result->fetch_assoc()['subject_exists'];
    }
}
