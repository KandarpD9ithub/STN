@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="pull-left">Edit</p>
                    <!-- <a href="{{URL::to('users/create')}}" class="pull-right btn btn-primary">create</a> -->
                </div>

                <div class="card-body">
                @include('backend.errors.errorMessage')
                    <div>
                        {!! Form::model($agentDetails, array('route' => array('users.update', $agentDetails->id), 'method' => 'PUT')) !!}
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {!! Form::text('name', null ,['class'=>'form-control', 'placeholder' => 'Name']) !!}
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        {!! Form::email('email', null ,['class'=>'form-control', 'placeholder' => 'Email']) !!}
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        {!! Form::text('company_name', null ,['class'=>'form-control', 'placeholder' => 'Company Name']) !!}
                                        <small class="text-danger">{{ $errors->first('company_name') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('address_1') ? ' has-error' : '' }}">
                                        {!! Form::text('address_1', null ,['class'=>'form-control', 'placeholder' => 'Address 1']) !!}
                                        <small class="text-danger">{{ $errors->first('address_1') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('address_2') ? ' has-error' : '' }}">
                                        {!! Form::text('address_2', null ,['class'=>'form-control', 'placeholder' => 'Address 2']) !!}
                                        <small class="text-danger">{{ $errors->first('address_2') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                        {!! Form::url('website', null ,['class'=>'form-control', 'placeholder' => 'Website']) !!}
                                        <small class="text-danger">{{ $errors->first('website') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        {!! Form::text('city', null ,['class'=>'form-control', 'placeholder' => 'City']) !!}
                                        <small class="text-danger">{{ $errors->first('city') }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        {!! Form::select('state', $states, null, ['class'=>'form-control', 'placeholder' => 'State']) !!}
                                        <small class="text-danger">{{ $errors->first('state') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                                        {!! Form::text('zip', null ,['class'=>'form-control', 'placeholder' => 'Zip']) !!}
                                        <small class="text-danger">{{ $errors->first('zip') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('cst') ? ' has-error' : '' }}">
                                        {!! Form::text('cst', null ,['class'=>'form-control', 'placeholder' => 'CST#']) !!}
                                        <small class="text-danger">{{ $errors->first('cst') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        {!! Form::number('phone', null ,['class'=>'form-control', 'placeholder' => 'Phone']) !!}
                                        <small class="text-danger">{{ $errors->first('phone') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('toll_free_number') ? ' has-error' : '' }}">
                                        {!! Form::number('toll_free_number', null ,['class'=>'form-control', 'placeholder' => 'Toll Free Number']) !!}
                                        <small class="text-danger">{{ $errors->first('toll_free_number') }}</small>
                                    </div>
                                    <!-- <div class="form-group{{ $errors->has('fax_number') ? ' has-error' : '' }}">
                                        {!! Form::text('fax_number', null ,['class'=>'form-control', 'placeholder' => 'Fax Number']) !!}
                                        <small class="text-danger">{{ $errors->first('fax_number') }}</small>
                                    </div> -->
                                    <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                                        {!! Form::select('roles', $roles , null,['class'=>'form-control', 'placeholder' => 'Select Roles']) !!}
                                        <small class="text-danger">{{ $errors->first('roles') }}</small>
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
