<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
<form action="../controllers/RegisterController.php" method="post">

<h1>Registro de usuario</h1>
<h3>Ingrese sus datos</h3>

<p>
<label>Nombre: </label></br>
<input type="text" name="Name" required>
</p>

<p>
<label>Apellido: </label></br>
<input type="text" name="Surname" required>
</p>

<p>
<label>Email: </label></br>
<input type="text" name="Email" required>
</p>

<p>
<label>Contraseña: </label></br>
<input type="text" name="Password" required>
</p>

<input type="submit" value="Registrar">

</form>
</body>
</html>