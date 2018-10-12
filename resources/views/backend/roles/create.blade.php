@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="pull-left">Create</p>
                    <!-- <a href="{{URL::to('users/create')}}" class="pull-right btn btn-primary">create</a> -->
                </div>

                <div class="card-body">
                @include('backend.errors.errorMessage')
                    <div>
                        {!! Form::open(['route' => 'roles.store']) !!}
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('role_name') ? ' has-error' : '' }}">
                                        {!! Form::text('role_name', null ,['class'=>'form-control', 'placeholder' => 'Role Name']) !!}
                                        <small class="text-danger">{{ $errors->first('role_name') }}</small>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
