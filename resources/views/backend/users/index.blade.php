@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="pull-left">Users</p>
                    <a href="{{URL::to('users/create')}}" class="pull-right btn btn-primary">create</a>
                </div>

                <div class="card-body">
                @include('backend.errors.errorMessage')
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <th>Id</th>
                                <th>name</th>
                                <th>action</th>
                            </tr>
                            @if(isset($agentDetails) and (count($agentDetails) > 0))
                                @foreach($agentDetails as $user)
                                    <tr>
                                        <td>
                                            {{ ucfirst($user->name) }}
                                        </td><td>
                                            {{$user->email}}
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                                               class="btn btn-secondary">Edit
                                            </a>
                                            {{ Form::open(array('url' => 'users/' . $user->id, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                                            {{ Form::close() }}
                                            <!-- <a href="{{ route('users.destroy', ['id' => $user->id]) }}"
                                               class="btn btn-default btn-sm">Delete
                                            </a> -->
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="3" align="center">record not found</td></tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $agentDetails->links() }}
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
