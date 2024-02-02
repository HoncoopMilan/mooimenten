<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klantcode</title>
</head>
<body>
    <p>Beste klant,</p>
    <p>De vragenlijst is zojuist ingevuld door ons. U kunt op {{ $expireDateTime}} na {{$expireTime}} uur op deze 
        <a href="{{ route('answers.show', ['customercode' => $customerCode]) }}">link</a> klikken om de antwoorden van alle mensen in te zien. Als u 
        op deze linkt hebt geklikt wordt er gevraagd om een klant code. 
        Deze code vindt u hieronder. <br><br><strong>{{ $customerCode }}</strong>.</p>
    <p>Met vriendelijke groet,<br>Mooimenten in samenwerking met</p>
</body>
</html>