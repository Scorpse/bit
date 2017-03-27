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
<h1>Create a Problem</h1>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

{!! Form::open(
  array(
    'route' => 'problems.store',
    'class' => 'form')
  ) !!}

@if (count($errors) > 0)
    <div class="alert alert-danger">
        There were some problems adding the problem.<br />
        <ul>
            @foreach ($errors->all() as $error)
                <li></li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    {!! Form::label('n') !!}
    {!! Form::text('n', null,
      array(
        'class'=>'form-control',
        'placeholder'=>'Number of colors'
      )) !!}
</div>
<a href="#" class="js-create-new-add-color-box">Add another color</a>

<div class="form-group">
    {!! Form::submit('Create Problem!',
      array('class'=>'btn btn-primary'
    )) !!}
</div>
{!! Form::close() !!}
</div>
</body>
</html>
<script>

    $(document).ready(function(){

        $('.js-create-new-add-color-box').click(function(){
            var inp = $('#box');
            var i = $('input').size() + 1;
            $('<div class="form-group"><label>Color id</label><input type="text" class="form-control" name="color[id][]"><label>Count</label><input type="text" class="form-control" name="color[cnt][]"></div>').appendTo($(".form"));
            i++;
        });
        $('body').on('click','#remove',function(){
            $(this).parent('div').remove();
        });
    });

</script>