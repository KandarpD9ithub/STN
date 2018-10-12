@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="pull-left">Users</p>
                    <a href="{{URL::to('roles/create')}}" class="pull-right btn btn-primary">create</a>
                </div>

                <div class="card-body">
                @include('backend.errors.errorMessage')
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <th>Id</th>
                                <th>Role Name</th>
                                <th>action</th>
                            </tr>
                            @if(isset($rolesDetails) and (count($rolesDetails) > 0))
                                @foreach($rolesDetails as $role)
                                    <tr>
                                        <td>
                                        {{ $role->id }}    
                                        </td><td>
                                        {{ ucfirst($role->role_name) }}
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                               class="btn btn-secondary">Edit
                                            </a>
                                            {{ Form::open(array('url' => 'roles/' . $role->id, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                                            {{ Form::close() }}
                                            <!-- <a href="{{ route('roles.destroy', ['id' => $role->id]) }}"
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
                        @if(count($rolesDetails) > 0)
                            {{ $rolesDetails->links() }}
                        @endif
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
