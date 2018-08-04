@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3">
                    <div class="card-header text-center text-muted">
                        Create player
                    </div>
                    <div class="card-body">
                    {{ Form::open(array('url' => route('players.file'), 'files' => true)) }}
                    {{ csrf_field() }}

                    <!-- FILE -->
                        <div class="form-row form-group">
                            <label class="col-md-3 col-form-label">.csv-file</label>
                            <div class="col-md-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" required>
                                    <label class="custom-file-label">Choose file...</label>
                                </div>
                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="form-row form-group">
                            <div class="col-md-4 offset-md-3">
                                <button type="submit" class="btn btn-dark btn-block">
                                    Save all
                                </button>
                            </div>
                            <div class="col-md-4 offset-md-1">
                                <a href="{{ route('create.index') }}"
                                   class="btn btn-danger btn-block">Cancel</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="col-md-6 offset-md-3 mb-3">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection