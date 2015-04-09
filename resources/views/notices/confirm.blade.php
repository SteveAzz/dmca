@extends('app')

@section('content')
    <h1 class="page_heading">Prepare DMCA Notice</h1>

    {!! Form::open(['action' => 'NoticesController@store']) !!}
        <!-- template From Input -->
        <div class="form-group">
            {!! Form::textarea('template', $template, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
           {!! Form::submit('Submit DMCA', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
@stop