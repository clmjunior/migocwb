<?php

class User {
    
    private static $conn;

    public static function setConnection($conn) {
        self::$conn = $conn;
    }

    public static function authenticate() {
        
        try {
            session_start();

            if(!$_POST['Email'] || !$_POST['Password']) {
                $message = 'Preencha o Email e a Senha';
                header('Location: ../resources/views/auth/login.php?message=' . urlencode($message));
                exit;
            }

            $email = filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL);
            $password = md5($_POST['Password']);
            $sql = 'SELECT * FROM users 
                        WHERE 
                        email=:email';

            $stmt = self::$conn->prepare($sql);
            $stmt->execute(['email' => $email]);

            $userExists = $stmt->fetch();

            if ($userExists) {

                $sql = 'SELECT * FROM users 
                        WHERE 
                        email=:email 
                        AND 
                        senha=:senha';
                $stmt = self::$conn->prepare($sql);
                $stmt->execute(['email' => $email, 'senha' => $password]);
    
                $user = $stmt->fetch();

                if ($user) {

                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    header('Location: ../resources/views/content/index.php');
                    exit;
                } else {
                    $message = 'Senha incorreta';
                    header('Location: ../resources/views/auth/login.php?error=' . urlencode($message));
                    exit;
                }
            } else {
                $error = 'Usuário inexistente';
                header('Location: ../resources/views/auth/login.php?message=' . urlencode($error));
                exit;
            }
        } catch (PDOException $e) {

            error_log("Database Error: " . $e->getMessage());

            throw new Exception("Ocorreu um erro durante o processamendo de sua requisição. Tente novamente mais tarde." . $e->getMessage());
        }
    }

    public static function postUser() {
        
        try {

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

            $sql = 'SELECT * FROM users 
                        WHERE 
                        email=:email';

            $stmt = self::$conn->prepare($sql);
            $stmt->execute(['email' => $_POST['email']]);

            $emailExists = $stmt->fetch();
            
            if($emailExists) {
                $message = 'Email já cadastrado';
                header('Location: ../resources/views/auth/login.php?message=' . urlencode($message));
                exit;
            }

            if($_POST['senha'] !== $_POST['confirmar_senha']) {
                $message = 'As senhas não correspondem';
                header('Location: ../resources/views/auth/login.php?message=' . urlencode($message));
                exit;
            }
            
            // Prepare a consulta SQL com parâmetros
            $sql = "INSERT INTO users (
                                        nome, 
                                        sobrenome, 
                                        imagem, 
                                        email, 
                                        senha, 
                                        cep, 
                                        cidade,
                                        uf, 
                                        rua, 
                                        numero, 
                                        bairro
                                        ) VALUES (
                                            :nome, 
                                            :sobrenome, 
                                            :imagem, 
                                            :email, 
                                            :senha, 
                                            :cep, 
                                            :cidade, 
                                            :uf, 
                                            :rua, 
                                            :numero, 
                                            :bairro
                                        )";

            $stmt = self::$conn->prepare($sql);

            // Criptografa a senha usando MD5
            $hashedPassword = md5($_POST['senha']);
        
            $stmt->bindParam(':nome',      $_POST['Name']);
            $stmt->bindParam(':sobrenome', $_POST['LastName']);
            $stmt->bindParam(':imagem',    $base64Image);
            $stmt->bindParam(':email',     $_POST['Email']);
            $stmt->bindParam(':senha',     $hashedPassword);
            $stmt->bindParam(':cep',       $_POST['CEP']);
            $stmt->bindParam(':cidade',    $_POST['City']);
            $stmt->bindParam(':uf',        $_POST['UF']);
            $stmt->bindParam(':rua',       $_POST['Street']);
            $stmt->bindParam(':numero',    $_POST['Number']);
            $stmt->bindParam(':bairro',    $_POST['Neighborhood']);
        
            $stmt->execute();
        
            $message = 'Registro inserido com sucesso!';
            header('Location: ../resources/views/auth/login.php?success-message=' . urlencode($message)); 

        } catch(PDOException $e) {

            throw new Exception("Erro ao inserir o registro:" . $e->getMessage());
        }

    }

    public static function putUser($userId) {
        
        try {

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
            
            $sql = 'SELECT * FROM users 
                        WHERE 
                        email = :email
                        AND id != :id';

            $stmt = self::$conn->prepare($sql);
            $stmt->execute(['email' => $_POST['email'],'id' => $userId ]);

            $emailExists = $stmt->fetch();
            
            if($emailExists) {
                $message = 'Email já cadastrado';
                header('Location: ../resources/views/content/index.php?message=' . urlencode($message));
                exit;
            }

            if($_POST['senha'] !== $_POST['confirmar_senha']) {
                $message = 'As senhas não correspondem';
                header('Location: ../resources/views/content/index.php?message=' . urlencode($message));
                exit;
            }
            
            // Prepare a consulta SQL com parâmetros
            $sql = "UPDATE users SET
                        nome        = :nome,
                        sobrenome   = :sobrenome,
                        imagem      = :imagem,
                        email       = :email,
                        senha       = :senha,
                        cep         = :cep,
                        cidade      = :cidade,
                        uf          = :uf,
                        rua         = :rua,
                        numero      = :numero,
                        bairro      = :bairro
                        WHERE id    = :id";

            $stmt = self::$conn->prepare($sql);

            // Criptografa a senha usando MD5
            $hashedPassword  = md5($_POST['senha']);
        
            $stmt->bindParam(':nome',      $_POST['nome']);
            $stmt->bindParam(':sobrenome', $_POST['sobrenome']);
            $stmt->bindParam(':imagem',    $base64Image);
            $stmt->bindParam(':email',     $_POST['email']);
            $stmt->bindParam(':senha',     $hashedPassword);
            $stmt->bindParam(':cep',       $_POST['cep']);
            $stmt->bindParam(':cidade',    $_POST['cidade']);
            $stmt->bindParam(':uf',        $_POST['uf']);
            $stmt->bindParam(':rua',       $_POST['rua']);
            $stmt->bindParam(':numero',    $_POST['numero']);
            $stmt->bindParam(':bairro',    $_POST['bairro']);
            $stmt->bindParam(':id',        $userId);
        
            $stmt->execute();
        
            $message = 'Registro atualizado com sucesso!';
            header('Location: ../resources/views/content/index.php?success-message=' . urlencode($message)); 

        } catch(PDOException $e) {

            throw new Exception("Erro ao atualizar o registro:" . $e->getMessage());
        }

    }

    public static function getUser($id) {
        
        $sql = 'SELECT * FROM users 
                    WHERE 
                    id=:id';

        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $user = $stmt->fetch();

        return $user;

    }

    public static function logout() {
        
        session_start();
        session_destroy();
        header('Location: ../resources/views/auth/login.php');
    }
}

