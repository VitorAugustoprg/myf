<?php 

// CONEXÃO COM O BANCO DE DADOS
$host = "Localhost";
$db = "myf";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // RECEBER DADOS DO FORMULÁRIO
    $nome = $_POST["nome"]; 
    $cursos = implode("#", $_POST['cursos']);
    $formacao = implode("#", $_POST['formacao']);
    $experiencia = implode("#", $_POST['experiencia']);
    $nacionalidade = $_POST["nacionalidade"]; 
    $nascimento = $_POST["nascimento"]; 
    $rua = $_POST["rua"]; 
    $bairro = $_POST["bairro"]; 
    $cep = $_POST["cep"]; 
    $telefone = $_POST["telefone"]; 
    $email = $_POST["email"]; 
    $objetivo  = $_POST["objetivo"]; 



    // INSERIR NO BANCO DE DADOS
    $sql = "INSERT INTO curriculo (nome, cursos, formacao, experiencia, nacionalidade, nascimento, rua, bairro, cep, telefone, email, objetivo) VALUES (:nome, :cursos, :formacao, :experiencia, :nacionalidade, :nascimento, :rua, :bairro, :cep, :telefone, :email, :objetivo)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cursos', $cursos);
    $stmt->bindParam(':formacao', $formacao);
    $stmt->bindParam(':experiencia', $experiencia);
    $stmt->bindParam(':nacionalidade', $nacionalidade);
    $stmt->bindParam(':nascimento', $nascimento);
    $stmt->bindParam(':rua', $rua);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':objetivo', $objetivo);

    $stmt->execute();

    // ENCAMINHAR PARA O PREVIEW
    header('Location: preview.php?id='. $pdo->lastInsertId());
    exit(); 
} catch (PDOException $e) {
    echo "Erro ". $e->getMessage();
}
?>