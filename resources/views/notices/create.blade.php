@extends('app')

@section('content')
    <h1 class="pages-heading">Prepare a DMCA notice</h1>

    {!! Form::open(['method' => 'GET', 'action' => 'NoticesController@confirm' ]) !!}
        <!-- provider_id From Input -->
        <div class="form-group">
            {!! Form::label('provider_id', 'Who are we sending this to?:') !!}
            {!! Form::select('provider_id', $providers, null, ['class' => 'form-control']) !!}
        </div>

        <!-- infringing From Input -->
        <div class="form-group">
            {!! Form::label('infringing_title', 'What is the title of the content that is being infringed upon.') !!}
            {!! Form::text('infringing_title', null, ['class' => 'form-control']) !!}
        </div>

        <!-- infringing_link From Input -->
        <div class="form-group">
            {!! Form::label('infringing_link', 'What is the link to where this content is located.') !!}
            {!! Form::text('infringing_link', null, ['class' => 'form-control']) !!}
        </div>

        <!-- orginal_link From Input -->
        <div class="form-group">
            {!! Form::label('original_link', 'To verify that you own the content, we now need to link to the original content on your server:') !!}
            {!! Form::text('original_link', null, ['class' => 'form-control']) !!}
        </div>

        <!-- original_description From Input -->
        <div class="form-group">
            {!! Form::label('original_description', 'And, finally you can give addition information , ') !!}
            {!! Form::textarea('original_description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Preview notice', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop