<?php
// Conectar ao banco de dados
$host = "localhost";
$db = "myf";
$user = "root";
$pass = "";

try {
    // Conectando ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Se o ID foi passado via GET, buscamos o perfil
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM curriculo WHERE idCurriculo = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $curriculo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Exibir o conteúdo do perfil do banco de dados
        if ($curriculo) {
            echo '<div class="container mt-5">';
            echo "<h2 class='mb-4'>Currículo de " . htmlspecialchars($curriculo['nome']) . "</h2>";
            echo "<p><strong>Nome:</strong> " . htmlspecialchars($curriculo['nome']) . "</p>";
            echo "<p><strong>Cursos:</strong> " . htmlspecialchars($curriculo['cursos']) . "</p>";
            echo "<p><strong>Formação:</strong> " . htmlspecialchars($curriculo['formacao']) . "</p>";
            echo "<p><strong>Experiências:</strong> " . htmlspecialchars($curriculo['experiencia']) . "</p>";
            echo "<p><strong>Nacionalidade:</strong> " . htmlspecialchars($curriculo['nacionalidade']) . "</p>";
            echo "<p><strong>Nascimento:</strong> " . htmlspecialchars($curriculo['nascimento']) . "</p>";
            echo "<p><strong>Rua:</strong> " . htmlspecialchars($curriculo['rua']) . "</p>";
            echo "<p><strong>Bairro:</strong> " . htmlspecialchars($curriculo['bairro']) . "</p>";
            echo "<p><strong>Cep:</strong> " . htmlspecialchars($curriculo['cep']) . "</p>";
            echo "<p><strong>Telefone:</strong> " . htmlspecialchars($curriculo['telefone']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($curriculo['email']) . "</p>";
            echo "<p><strong>Objetivo:</strong> " . htmlspecialchars($curriculo['objetivo']) . "</p>";

            // Link para gerar o PDF
            echo '<a href="gerar_pdf.php?nome=' . urlencode($curriculo['nome']) . 
                '&cursos=' . urlencode($curriculo['cursos']) . 
                '&formacao=' . urlencode($curriculo['formacao']) . 
                '&experiencia=' . urlencode($curriculo['experiencia']) . 
                '&nacionalidade=' . urlencode($curriculo['nacionalidade']) . 
                '&nascimento=' . urlencode($curriculo['nascimento']) . 
                '&rua=' . urlencode($curriculo['rua']) . 
                '&bairro=' . urlencode($curriculo['bairro']) . 
                '&cep=' . urlencode($curriculo['cep']) . 
                '&telefone=' . urlencode($curriculo['telefone']) . 
                '&email=' . urlencode($curriculo['email']) . 
                '&objetivo=' . urlencode($curriculo['objetivo']) . 
                '" class="btn btn-success mt-3">Baixar PDF</a>';

            // Botão para voltar
            echo '<a href="index.php" class="btn btn-secondary mt-3 ms-2">Voltar</a>';
            echo '</div>';
        } else {
            echo '<div class="container mt-5"><p>Perfil não encontrado.</p></div>';
        }
    } else {
        echo '<div class="container mt-5"><p>ID não fornecido.</p></div>';
    }
} catch (PDOException $e) {
    echo '<div class="container mt-5"><p>Erro: ' . htmlspecialchars($e->getMessage()) . '</p></div>';
}
?>
