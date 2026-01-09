<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@auth
  <p>Sveiks, {{ Auth::user()->username}}</p>
<br>
  <p>pilns vārds:  {{ Auth::user()->fullName}}</p>
<br>
  <p>Jūsu loma:  {{ Auth::user()->role}}</p>

<form action="/logout" method="POST">
@csrf

<button>atteikties</button>
</form>

@endauth

@guest
  <p>Sveiks, viesi!</p>
  <a href="/login">login</a>
  <br>
  <br>
  <a href="/register">reģistrēties</a> 
@endguest



</body>
</html>
