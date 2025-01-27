<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Gerar curriculo</title>
</head>
<body>

    <div class="container mt-5 m-auto">

    <h1>Gerador de curriculos</h1>


        <!-- FORMULÁRIO -->
         <form action="process_form.php" method="POST" id="resumeForm" class="mt-4 container">
            <div class="mb-3 d-flex flex-column">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" name="nome" id="nome" class="inputs" placeholder="Digite seu nome" required>
            </div>

          


            <div class="mb-3 d-flex flex-column">
                <label for="nacionalidade" class="form-label">Nacionalidade</label>
                <input type="text" name="nacionalidade" id="nacionalidade" class="inputs" placeholder="Digite sua nacionalidade" required>
            </div>

            <div class="mb-3 d-flex flex-column">
                <label for="nascimento" class="form-label">Data de nascimento</label>
                <input type="text" name="nascimento" id="nascimento" class="inputs" placeholder="00/00/0000" required>
            </div>

            <div class="mb-3 d-flex flex-column">
                <label for="rua" class="form-label">Rua</label>
                <input type="text" name="rua" id="rua" class="inputs" placeholder="Nome da sua rua" required>
            </div>

            <div class="mb-3 d-flex flex-column">
                <label for="rua" class="form-label">Bairro</label>
                <input type="text" name="bairro" id="bairro" class="inputs" placeholder="Nome do seu bairro" required>
            </div>

            <div class="mb-3 d-flex flex-column">
                <label for="cep" class="form-label">Cep</label>
                <input type="text" name="cep" id="cep" class="inputs" placeholder="Nome do seu bairro" required>
            </div>

            <div class="mb-3 d-flex flex-column">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="inputs" placeholder="(00) 000000000" required>
            </div>

            <div class="mb-3 d-flex flex-column">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="inputs" placeholder="email@gmail.com" >
            </div>

              <div class="d-flex flex-column">

            <div class="mb-3 m-0 d-flex flex-column" id="cursos">
                <label for="cursos" class="form-label">Cursos</label>
                <input type="text" name="cursos[]"  class="inputs mb-2" placeholder="Digite um curso" required>
            </div>

            <button type="button" id="adicionarCurso" class="btn btn-secondary mb-2 mt-0 ms-0">+</button>
            </div>

            <div class="d-flex flex-column">
            <div class="mb-3 m-0 d-flex flex-column" id="formacao">
                <label for="formacao" class="form-label">Formação</label>
                <input type="text" name="formacao[]"  class="inputs mb-2" placeholder="Digite uma formacao" required>
            </div>

            <button type="button" id="adicionarFormacao" class="btn btn-secondary ms-0 mt-0 mb-2">+</button>
            </div>

            <div class="d-flex flex-column">
            <div class="mb-3 m-0 d-flex flex-column" id="experiencia">
                <label for="experiencia" class="form-label">Experiências</label>
                <input type="text" name="experiencia[]"  class="inputs mb-2" id="experiencia-input" placeholder="Digite uma experiencia" required >
            </div>

            <button type="button" id="adicionarExperiencia" class="btn btn-secondary mb-2 mt-0 ms-0">+</button>
            </div>

            <div class="mb-3 d-flex flex-column">
                <label for="objetivo" class="form-label">Objetivo</label>
                <input type="text" name="objetivo" id="objetivo" class="inputs" placeholder="cargo desejado" >
            </div>


            <button type="submit" class="btn btn-success w-100">Salvar e visualizar</button>
         </form>
         <!-- FIM DO FORMULÁRIO -->

      <!-- PREVIEW DO CURRICULO -->
<div class="mt-5 d-none" id="preview">
    <h2>Visualização do curriculo</h2>
    <div id="previewContent" class="border p-3"></div>

    <!-- Formulário para gerar o PDF -->
    <form action="gerar_pdf.php" method="GET">
    <input type="hidden" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
    <input type="hidden" name="cursos" value="<?php echo htmlspecialchars($cursos); ?>">
    <input type="hidden" name="formacao" value="<?php echo htmlspecialchars($formacao); ?>">
    <input type="hidden" name="experiencia" value="<?php echo htmlspecialchars($experiencia); ?>">
    <input type="hidden" name="nacionalidade" value="<?php echo htmlspecialchars($nacionalidade); ?>">
    <input type="hidden" name="nascimento" value="<?php echo htmlspecialchars($nascimento); ?>">
    <input type="hidden" name="rua" value="<?php echo htmlspecialchars($rua); ?>">
    <input type="hidden" name="bairro" value="<?php echo htmlspecialchars($bairro); ?>">
    <input type="hidden" name="cep" value="<?php echo htmlspecialchars($cep); ?>">
    <input type="hidden" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <input type="hidden" name="objetivo" value="<?php echo htmlspecialchars($objetivo); ?>">


    <button type="submit">Gerar PDF</button>
    </form>
</div>
<!-- FIM DA PREVIEW -->

    
    </div>

    <?php
// Conexão com o banco de dados
$host = "localhost";
$db = "myf";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Exibir dados apenas se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $nome = trim($_POST['nome']);

    // Buscar o último perfil cadastrado
    $stmt = $conn->prepare("SELECT nome, cursos FROM curriculo ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $stmt->bind_result($nome_usuario, $cursos);
    $stmt->fetch();
    $stmt->close();

    echo "<h2>Preview</h2>";
    echo "<p><strong>Nome:</strong> " . htmlspecialchars($nome_usuario) . "</p>";
    echo "<p><strong>Cursos:</strong></p>";

    


     
   

}

$conn->close();
?>

<script>
    // Função para preencher os campos ocultos com os dados do formulário
    function preencherCamposOcultos() {
        const nome = document.getElementById("nomeInput").value; // Valor do input nome
        const cursos = document.getElementById("cursosInput").value; // Valor do input cursos
        const formacoes = document.getElementById("formacaoInput").value; // Valor do input cursos
        const experiencias = document.getElementById("experienciaInput").value; // Valor do input cursos
        

        // Preenche os campos ocultos
        document.getElementById("nome").value = nome;
        document.getElementById("cursos").value = cursos;
        document.getElementById("formacao").value = formacoes;
        document.getElementById("experiencia").value = formacoes;
        document.getElementById("nacionalidade").value = nacionalidade;


    }

    // Atribui a função ao botão para gerar o PDF
    document.getElementById("btnGerarPdf").addEventListener("click", preencherCamposOcultos);




    
</script>



<script>
 





</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>