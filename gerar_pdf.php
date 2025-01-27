<?php
// Incluir a biblioteca FPDF
require('fpdf/fpdf.php');

// Verifique se os parâmetros foram passados via GET ou POST
if (isset($_GET['nome']) && isset($_GET['cursos']) && isset($_GET['nacionalidade']) && isset($_GET['formacao']) && isset($_GET['experiencia']) && isset($_GET['nascimento']) && isset($_GET['rua']) && isset($_GET['bairro']) && isset($_GET['cep']) && isset($_GET['telefone']) && isset($_GET['email']) && isset($_GET['objetivo'])) {
    // Capturar os dados
    $nome = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['nome']);
    $cursos = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['cursos']);
    $nacionalidade = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['nacionalidade']);
    $formacao = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['formacao']);
    $experiencia = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['experiencia']);
    $nascimento = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['nascimento']);
    $rua = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['rua']);
    $bairro = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['bairro']);
    $cep = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['cep']);
    $telefone = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['telefone']);
    $email = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['email']);
    $objetivo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_GET['objetivo']);
    
} else {
    die('Dados ausentes. Certifique-se de que todas as informações foram enviadas.');
}

// Classe personalizada para adicionar cabeçalho
class PDF extends FPDF {
 
}

// Criar o PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Adicionar o nome
$pdf->SetFont('Arial', 'B', 28);
$pdf->Cell(0, 10, "$nome", 0, 1, 'C');
$pdf->Ln(5);

// Nacionalidade e nascimento
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, "Dados pessoais", 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(2);

// Linha divisória
$pdf->SetDrawColor(0, 0, 0); // Cor preto
$pdf->SetLineWidth(0.2); // Espessura da linha
$pdf->Line(10, $pdf->GetY(), 180, $pdf->GetY()); // aqui defino a largura da linha
$pdf->Ln(2); // Espaçamento logo abaixo da linha

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 10, "Nacionalidade: $nacionalidade | Nascimento: $nascimento", 0, 1);
$pdf->Cell(0, 10, "Endereco: $rua, $bairro, CEP: $cep", 0, 1);
$pdf->Cell(0, 10, "Telefone: $telefone | Email: $email", 0, 1);

// Objetivo
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, "Objetivo", 0, 1);
$pdf->SetFont('Arial', '', 12);

// Linha horizontal (largura total)
$pdf->SetDrawColor(0, 0, 0); // Cor da linha (preto)
$pdf->SetLineWidth(0.2); // Espessura da linha
$pdf->Line(10, $pdf->GetY(), 180, $pdf->GetY()); // Desenha a linha de 10 a 180 na horizontal
$pdf->Ln(5); // Espaçamento abaixo da linha

$pdf->MultiCell(0, 10, $objetivo);
$pdf->Ln(2);


// Formação
$pdf->SetFont('Arial', 'B', 14);
$formacao_titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Formação");
$pdf->Cell(0, 10, "$formacao_titulo", 0, 1);
$pdf->SetFont('Arial', '', 12);

// Linha horizontal
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->Line(10, $pdf->GetY(), 180, $pdf->GetY());
$pdf->Ln(5);

// Formatação da lista de formação
$formacao_array =  explode("#", $formacao);
foreach ($formacao_array as $itemF) {
$pdf->Cell(5, 10, chr(149), 0, 0); // Adiciona o ponto (bullet)
$pdf->Multicell(0, 10,$itemF,0, 1);
}
$pdf->Ln(3);

// Experiência
$pdf->SetFont('Arial', 'B', 14);
$experiencia_titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Experiência");
$pdf->Cell(0, 10, "$experiencia_titulo", 0, 1);
$pdf->SetFont('Arial', '', 12);

// Linha horizontal
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->Line(10, $pdf->GetY(), 180, $pdf->GetY());
$pdf->Ln(5);

// Formatação da lista de experiência
$experiencia_array =  explode("#", $experiencia);
foreach ($experiencia_array as $item) {
$pdf->Cell(5, 10, chr(149), 0, 0); // Adiciona o ponto (bullet)
$pdf->Multicell(0, 10,$item,0, 1);
}



$pdf->Ln(3);

// Cursos
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, "Cursos Extracurriculares", 0, 1);

// Linha horizontal (largura total)
$pdf->SetDrawColor(0, 0, 0); // Cor da linha (preto)
$pdf->SetLineWidth(0.2); // Espessura da linha
$pdf->Line(10, $pdf->GetY(), 180, $pdf->GetY()); // Desenha a linha de 10 a 180 na horizontal
$pdf->Ln(5); // Espaçamento abaixo da linha

$pdf->SetFont('Arial', '', 12);
// Formatação da lista de experiência
$curso_array =  explode("#", $cursos);
foreach ($curso_array as $itemC) {
$pdf->Cell(5, 10, chr(149), 0, 0); // Adiciona o ponto (bullet)
$pdf->Multicell(0, 10,$itemC,0, 1);
}
$pdf->Ln(3);



// Gerar PDF
$pdf->Output('D', "cv_$nome.pdf");
?>
    <script src="assets/js/script.js"></script>

