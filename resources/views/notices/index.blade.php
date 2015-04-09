@extends('app')

@section('content')

    @include('flash::message')

    <h1 class="pages-heading">Your notices</h1>

    <table class="table table-striped table-bordered">
        <thead>
            <th>This content:</th>
            <th>Accessible Here:</th>
            <th>Is infringing Upon my work Here:</th>
            <th>Notice Sent:</th>
            <th>Content Remoced:</th>
        </thead>

        <tbody>
            @foreach($notices->where('content_removed', 0, false) as $notice)
                <tr>
                    <td> {{ $notice->infringing_title }} </td>
                    <td> {!! link_to($notice->infringing_link) !!} </td>
                    <td> {!! link_to($notice->original_link) !!} </td>
                    <td> {{ $notice->created_at->diffForHumans() }} </td>
                    <td>
                        {!! Form::open(['data-remote', 'method' => 'PATCH', 'action' => ['NoticesController@update', $notice->id]] ) !!}
                            <div class="form-group">
                                {!! Form::checkbox('content_removed', $notice->content_removed, $notice->content_removed, ['data-click-submit-form']) !!}
                            </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Archived Notices</h3>
    @foreach($notices->where('content_removed', 1, false) as $notice)
        <li>
            {{ $notice->infringing_title }}
        </li>
    @endforeach

    @unless(count($notices))
        <p class="text-center">You haven't sent and DMCA notices yet!</p>
    @endunless
@stop

