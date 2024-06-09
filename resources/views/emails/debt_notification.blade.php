<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificação: Dívida</title>
</head>
<body>
    <h2>Notificação: Dívida</h2>
    <p>Olá {{ $debt->debtor->name->value }},</p>
    
    <p>Esta é uma notificação para informar que você possui uma dívida pendente de {{ $debt->amount->value }} com vencimento em {{ $debt->dueDate->value }}.</p>
    
    <p>Por favor, efetue o pagamento o mais breve possível.</p>
    
    <p>Obrigado,</p>
    <p>Sua Empresa</p>
</body>
</html>
