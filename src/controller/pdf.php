<?php


require __DIR__ . '/../../vendor/autoload.php'; 

use Dompdf\Dompdf;
use Dompdf\Options;



$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);


$usuario = [
    'nome' => $userSession['nome'],
    'email' => $userSession['email'],
    'telefone' => $userSession['telefone'],
];

$pagamento = [
    'metodo' => $_GET['pagamento'],
    'parcelas' => $_GET['parcela'],
    'preco' => (float) str_replace(',', '.', str_replace('.', '', $_GET['valor'])),
    'codigo' => '#'.$_GET['pedido'],
];


$html = '
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Comprovante de Pagamento</title>
    <style>
        body { 
            font-family: "Arial", sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f4f4f4; 
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header { 
            text-align: center; 
            background-color: #007BFF; 
            color: white; 
            padding: 20px; 
            border-radius: 8px 8px 0 0; 
            margin-bottom: 20px; 
        }
        h1 { margin: 0; font-size: 24px; }
        .info { margin-bottom: 20px; }
        .info p { margin: 5px 0; font-size: 16px; }
        .footer { 
            margin-top: 30px; 
            text-align: center; 
            font-size: 12px; 
            color: #777; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Comprovante de Pagamento</h1>
        </div>
        <div class="info">
            <h2>Dados do Usuário</h2>
            <p><strong>Nome:</strong> ' . htmlspecialchars($usuario['nome']) . '</p>
            <p><strong>Email:</strong> ' . htmlspecialchars($usuario['email']) . '</p>
            <p><strong>Telefone:</strong> ' . htmlspecialchars($usuario['telefone']) . '</p>
        </div>
        <div class="info">
            <h2>Detalhes do Pagamento</h2>
            <p><strong>Método de Pagamento:</strong> ' . htmlspecialchars($pagamento['metodo']) . '</p>
            <p><strong>Parcelas:</strong> ' . htmlspecialchars($pagamento['parcelas']) . '</p>
            <p><strong>Preço Total:</strong> R$ ' . number_format($pagamento['preco'], 2, ',', '.') . '</p>
            <p><strong>Código do Boleto:</strong> ' . htmlspecialchars($pagamento['codigo']) . '</p>
        </div>
        <div class="footer">
            <p>Obrigado por escolher nossos serviços!</p>
        </div>
    </div>
</body>
</html>
';


$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream('comprovante-de-pagamento.pdf', ['Attachment' => true]); // 'Attachment' => true força o download
?>
