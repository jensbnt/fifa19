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
                        Edit team
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.edit', ['id' => $team->id]) }}">
                        {{ csrf_field() }}

                        <!-- NAME -->
                            <div class="form-row form-group">
                                <label for="inputName" class="col-md-3 col-form-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputName" name="name" class="form-control"
                                           placeholder="Name"
                                           value="{{ old('name') != "" ? old('name') : $team->name }}">
                                </div>
                            </div>

                            <!-- DESCRIPTION -->
                            <div class="form-row form-group">
                                <label for="inputDescription" class="col-md-3 col-form-label">Description</label>
                                <div class="col-md-9">
                                    <textarea id="inputDescription" name="description" class="form-control"
                                              placeholder="Description"
                                              rows="5">{{ old('description') != "" ? old('description') : $team->description }}</textarea>
                                </div>
                            </div>

                            <!-- CLUB IMAGE LINK -->
                            <div class="form-row form-group">
                                <label for="inputClubImage" class="col-md-3 col-form-label">Club Image</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputClubImage" name="clubImage" class="form-control"
                                           placeholder="Club Image"
                                           value="{{ old('clubImage') != "" ? old('clubImage') : $team->club_img_link }}">
                                </div>
                            </div>

                            <!-- BUTTONS -->
                            <div class="form-row form-group">
                                <div class="col-md-4 offset-md-3">
                                    <button type="submit" class="btn btn-dark btn-block">
                                        Save
                                    </button>
                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <a href="{{ route('teams.view', ['id' => $team->id]) }}"
                                       class="btn btn-danger btn-block">Cancel</a>
                                </div>
                            </div>
                        </form>
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