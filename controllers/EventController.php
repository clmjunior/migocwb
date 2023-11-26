<?php
class Event {

    /**
     * Objeto de conexão com o banco de dados.
     *
     * @var object
     */
    private $conn;

    /**
     * Construtor da classe Event.
     *
     * @param object $conn Objeto de conexão com o banco de dados.
     */
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Insere um evento no banco de dados.
     *
     * @param int $userId ID do usuário que está criando o evento.
     * @throws Exception Em caso de erro na inserção.
     */
    public function postEvent($userId) {
        try {
            require_once(__DIR__ . '/../db/conn.php');
            
            // Check if a file was uploaded
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $tmpImagePath = $_FILES['imagem']['tmp_name'];
    
                // Read the uploaded image file
                $imageData = file_get_contents($tmpImagePath);
    
                // Convert the image data to base64
                $base64Image = base64_encode($imageData);
            } else {
                // No image uploaded
                $base64Image = ""; // Set a default value or handle the case as needed
            }
            
            // Prepare the SQL query
            $sql = "INSERT INTO events (
                            user_id, 
                            titulo, 
                            imagem, 
                            descricao, 
                            flag_promocao, 
                            desc_promocao, 
                            horario, 
                            data, 
                            cep,
                            cidade, 
                            uf, 
                            rua, 
                            numero,
                            bairro
                            ) VALUES (
                                :user_id, 
                                :titulo, 
                                :imagem, 
                                :descricao, 
                                :flag_promocao, 
                                :desc_promocao, 
                                :horario, 
                                :data,
                                :cep,
                                :cidade, 
                                :uf, 
                                :rua, 
                                :numero, 
                                :bairro
                            )";

            $stmt = $this->conn->prepare($sql);
            
            // Bind parameters
            $stmt->bindParam(':user_id',      $userId);
            $stmt->bindParam(':titulo',       $_POST['titulo']);
            $stmt->bindParam(':imagem',       $base64Image);
            $stmt->bindParam(':descricao',    $_POST['descricao']);
            $stmt->bindParam(':flag_promocao',$_POST['flag_promocao']);
            $stmt->bindParam(':desc_promocao',$_POST['desc_promocao']);
            $stmt->bindParam(':horario',      $_POST['horario']);
            $stmt->bindParam(':data',         $_POST['data']);
            $stmt->bindParam(':cep',          $_POST['cep']);
            $stmt->bindParam(':cidade',       $_POST['cidade']);
            $stmt->bindParam(':uf',           $_POST['uf']);
            $stmt->bindParam(':rua',          $_POST['rua']);
            $stmt->bindParam(':numero',       $_POST['numero']);
            $stmt->bindParam(':bairro',       $_POST['bairro']);
            
    
            $stmt->execute();
            
            $message = 'Registro inserido com sucesso!';
            header('Location: ../resources/views/content/index.php?success-message=' . urlencode($message));
        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir o registro: " . $e->getMessage());
        }
    }

    /**
     * Atualiza um evento no banco de dados.
     *
     * @param int $eventId ID do evento a ser atualizado.
     * @throws Exception Em caso de erro na atualização.
     */
    public function putEvent($eventId) {
        
        try {
            
            require_once(__DIR__ . '/../db/conn.php');

            // Check if a file was uploaded
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $tmpImagePath = $_FILES['imagem']['tmp_name'];
    
                // Read the uploaded image file
                $imageData = file_get_contents($tmpImagePath);
    
                // Convert the image data to base64
                $base64Image = base64_encode($imageData);
            } else {
                // No image uploaded
                $base64Image = ""; // Set a default value or handle the case as needed
            }

            // Prepare a consulta SQL com parâmetros
            $sql = "UPDATE events SET
                        titulo        = :titulo,
                        descricao     = :descricao,
                        flag_promocao = :flag_promocao,
                        desc_promocao = :desc_promocao,
                        horario       = :horario,
                        data          = :data,
                        cep           = :cep,
                        cidade        = :cidade,
                        uf            = :uf,
                        rua           = :rua,
                        numero        = :numero,
                        bairro        = :bairro";
            
            if ($base64Image !== "") {
                $sql .= ", imagem = :imagem";
            }

            $sql .= " WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':titulo',       $_POST['titulo']);
            $stmt->bindParam(':descricao',    $_POST['descricao']);
            $stmt->bindParam(':flag_promocao',$_POST['flag_promocao']);
            $stmt->bindParam(':desc_promocao',$_POST['desc_promocao']);
            $stmt->bindParam(':horario',      $_POST['horario']);
            $stmt->bindParam(':data',         $_POST['data']);
            $stmt->bindParam(':cep',          $_POST['cep']);
            $stmt->bindParam(':cidade',       $_POST['cidade']);
            $stmt->bindParam(':uf',           $_POST['uf']);
            $stmt->bindParam(':rua',          $_POST['rua']);
            $stmt->bindParam(':numero',       $_POST['numero']);
            $stmt->bindParam(':bairro',       $_POST['bairro']);
            
            if ($base64Image !== "") {
                $stmt->bindParam(':imagem', $base64Image);
            }

            $stmt->bindParam(':id', $eventId);

            $stmt->execute();
            
            $message = 'Registro atualizado com sucesso!';
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success-message=' . urlencode($message));

        } catch(PDOException $e) {

            throw new Exception("Erro ao atualizar o registro:" . $e->getMessage());
        }
    }

    /**
     * Confirma a presença de um usuário em um evento.
     *
     * @param int $userId ID do usuário que está confirmado presença.
     * @param int $eventId ID do evento em que a presença é confirmada.
     * @throws Exception Em caso de erro na confirmação de presença.
     */
    public function confirmPresence($userId, $eventId) {
        
        try {
            require_once(__DIR__ . '/../db/conn.php');
            
            // Prepare the SQL query
            $sql = "SELECT * 
                        FROM event_attendees 
                        WHERE
                        event_id = :event_id
                        AND user_id = :user_id";

            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':event_id',$eventId);
            $stmt->bindParam(':user_id', $userId);
           
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // The user has already confirmed attendance
                $message = 'Presença já confirmada!';
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error-message=' . urlencode($message));
            } else {

                $sql = "INSERT INTO event_attendees (
                                event_id,
                                user_id
                                ) VALUES (
                                    :event_id,
                                    :user_id
                                )";

                $stmt = $this->conn->prepare($sql);

                // Bind parameters
                $stmt->bindParam(':event_id',$eventId);
                $stmt->bindParam(':user_id', $userId);
                
                $stmt->execute();
                
                $message = 'Presença confirmada!';
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success-message=' . urlencode($message));
            }

        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir o registro: " . $e->getMessage());
        }
    }

    /**
     * Inativa um evento.
     *
     * @param int $eventId ID do evento a ser inativado.
     * @throws Exception Em caso de erro na inativação.
     */
    public function inactiveEvent($eventId) {
        
        try {
            require_once(__DIR__ . '/../db/conn.php');
            
            $presences = $this->getConfirmedPresences($eventId);

            
            if(!empty($presences)) {

                $message = 'Não foi possível inativar o evento pois o mesmo possui presenças confirmadas.!';
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error-message=' . urlencode($message));

            } else {
                
                $sql = "UPDATE events SET
                        flag_ativo      = :flag_ativo
                        WHERE id  = :event_id";

                $isActive = "N";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':event_id',   $eventId);
                $stmt->bindParam(':flag_ativo', $isActive);
                        
                $stmt->execute();


                $message = 'Evento inativado!';
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success-message=' . urlencode($message));
            }

        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir o registro: " . $e->getMessage());
        }
    }

    /**
     * Ativa um evento.
     *
     * @param int $eventId ID do evento a ser ativado.
     * @throws Exception Em caso de erro na ativação.
     */
    public function activeEvent($eventId) {
        
        try {
            require_once(__DIR__ . '/../db/conn.php');
            
            
            $sql = "UPDATE events SET
                    flag_ativo      = :flag_ativo
                    WHERE id  = :event_id";

            $isActive = "S";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':event_id',   $eventId);
            $stmt->bindParam(':flag_ativo', $isActive);
                    
            $stmt->execute();


            $message = 'Evento reativado!';
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success-message=' . urlencode($message));

        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir o registro: " . $e->getMessage());
        }
    }

    /**
     * Obtém o número de presenças confirmadas em um evento.
     *
     * @param int $eventId ID do evento.
     * @return int O número de presenças confirmadas.
     */
    public function getConfirmedPresences($eventId) {
        
        $sql = 'SELECT COUNT(*) FROM event_attendees
                WHERE event_id = :event_id';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':event_id', $eventId);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();
        
        return $count;
    }

    /**
     * Verifica se um usuário está participando de um evento.
     *
     * @param int $eventId ID do evento.
     * @param int $userId ID do usuário.
     * @return int 1 se o usuário está participando, 0 caso contrário.
     */
    public function isParticipating($eventId, $userId) {
        $sql = 'SELECT COUNT(*) FROM event_attendees
                WHERE event_id  = :event_id
                AND user_id     = :user_id';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':event_id', $eventId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();
        
        return $count;
    }
    
    /**
     * Obtém todos os eventos ativos.
     *
     * @return array Um array contendo informações dos eventos ativos.
     */
    public function getEvents() {
        
        $sql = 'SELECT * FROM events
                WHERE flag_ativo = :flag_ativo';
    
        $isActive = "S";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':flag_ativo', $isActive);
        $stmt->execute();
    
        $events = array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }
    
        return $events;
    }

    /**
     * Obtém todos os eventos criados por um usuário.
     *
     * @param int $userId ID do usuário.
     * @return array Um array contendo informações dos eventos do usuário.
     */
    public function getMyEvents($userId) {
        
        $sql = 'SELECT * FROM events
                WHERE user_id = :user_id';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    
        $events = array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }
    
        return $events;
    }
}

