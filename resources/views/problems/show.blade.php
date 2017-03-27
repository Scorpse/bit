<!DOCTYPE html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('problems') }}">Problem Alert</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('problems') }}">View All Problems</a></li>
            <li><a href="{{ URL::to('problems/create') }}">Create a Problem</a>
        </ul>
    </nav>

    <h1>Showing {{ $problem->n }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $problem->n }}</h2>
        <p>
            <strong>N:</strong> {{ $problem->n }}<br>
            <strong>Distribution:</strong> {{ json_encode(unserialize($problem->distribution)) }}<br>
            <strong>Solutions:</strong> {{ json_encode(unserialize($problem->solutions)) }}
        </p>
    </div>

</div>
</body>
</html>

