@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="pull-left">Users</p>
                    <!-- <a href="{{URL::to('roles/create')}}" class="pull-right btn btn-primary">create</a> -->
                </div>

                <div class="card-body">
                @include('backend.errors.errorMessage')
                {!! Form::open(['url' => 'uploadCSV', 'files' => true]) !!}
                    <div class="col-sm-md-12">
                        <div class="form-group">
                                <label for="">Upload CSV File</label>
                            <div class="row">
                                <input type="file" name="uploadCSV" id="">
                            </div>
                        </div>
                    </div>
                    <div class="pull-left">
                    <button type="submit" class="btn brn-primary">Upload</button>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
