<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monace</title>
</head>
<body>


    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    
</body>
</html>