@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Add Animal</h4>
                        {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                        <a href="{{ route('admin.admin_animals.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.admin_animals.update', $animal->id)}}"
                        method="POst" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label for="species">Species</label>
                            <input type="text" class="form-control  @error('species') is-invalid @enderror"
                                name="species" value="{{ $animal->species }}" id="species" placeholder="Species">
                            @error('species')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="breed">Breed</label>
                            <input type="text" class="form-control @error('breed') is-invalid @enderror" name="breed"
                                value="{{  $animal->breed }}" id="breed" placeholder="Breed">
                            @error('breed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                value="{{  $animal->name }}" id="name" placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" value="{{  $animal->date_of_birth }}"
                                class="form-control  @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                                id="date_of_birth" placeholder="Date of Birth">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gender</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="Male" {{ $animal->gender == "Male" ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $animal->gender == "Female" ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" class="form-control  @error('color') is-invalid @enderror" name="color"
                                value="{{ $animal->color }}" id="color" placeholder="Color">
                            @error('color')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Owner</label>
                            <select name="owner" class="form-control @error('owner') is-invalid @enderror">

                                <option value="{{ $animal->owner->id }}" selected>{{ $animal->owner->email }}</option>
                                @foreach ($owner as $item)
                                <option value="{{ $item->id }}">{{ Str::upper($item->email) }}</option>
                                @endforeach
                            </select>
                            @error('owner')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" value="1">
                                Status
                                <i class="input-helper"></i></label>
                        </div> --}}
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('admin.admin_owners.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection