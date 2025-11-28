
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Navegador: <?= $_SERVER['HTTP_USER_AGENT'] ?></p>
    <p>IP do usuário: <?= $_SERVER['REMOTE_ADDR'] ?></p>
    <p>Idioma de preferência: <?= $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?></p>
</body>
</html>
