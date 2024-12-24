<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation</title>
</head>
<body>
<h1>Configuration de la Base de Données</h1>

    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif


    <form action="/install" method="POST">
        @csrf
        <label for="db_connection">Type de Base de Données :</label>
        <select name="db_connection" required>
            <option value="sqlsrv">SQL Server</option>
            <option value="mysql">MySQL</option>
        </select><br>

        <label for="db_host">Hôte :</label>
        <input type="text" name="db_host" required><br>

        <label for="db_port">Port :</label>
        <input type="text" name="db_port" value="3306" required><br>

        <label for="db_database">Nom de la Base de Données :</label>
        <input type="text" name="db_database" required><br>

        <label for="db_username">Nom d'utilisateur :</label>
        <input type="text" name="db_username" required><br>

        <label for="db_password">Mot de passe :</label>
        <input type="password" name="db_password"><br>

        <button type="submit">Configurer</button>
    </form>

</body>
</html>