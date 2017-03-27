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

    <h1>All the Nerds</h1>

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>N</td>
            <td>Distribution</td>

            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($problems as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{($value->n) }}</td>
                <td>{{ json_encode(unserialize($value->distribution)) }}</td>

                <td>
                    <a class="btn btn-small btn-success" href="{{ URL::to('problems/' . $value->id) }}">Show this Problem</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>

