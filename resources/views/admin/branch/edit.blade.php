@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Add Branches</h4>
                        <a href="{{ route('admin.admin_branchs.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.admin_branchs.update', $branch->id)}}"
                        method="POst" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control  @error('address') is-invalid @enderror"
                                name="address" value="{{ $branch->address }}" id="address" placeholder="address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitude</label>
                            <input type="number" class="form-control @error('lat') is-invalid @enderror" name="lat"
                                value="{{ $branch->lat }}" id="lat" placeholder="lat">
                            @error('lat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="long">Longitude</label>
                            <input type="number" class="form-control  @error('long') is-invalid @enderror" name="long"
                                value="{{ $branch->long }}" id="long" placeholder="long">
                            @error('long')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <hr>
                            <h4>Services</h4>
                            <hr>
                            {{-- {{ dd($selectedItems) }} --}}
                            @php
                            $selectedItems = array();

                            $selectedItems = explode(',', $branch->content);
                            @endphp

                            <div class="row">
                                @foreach ($services as $key => $item)

                                <div class="col-md-3 py-2">
                                    <label for="" class="float-start">{{ $item->name }}</label>
                                </div>
                                <div class="col-md-1">
                                    <input type="checkbox"
                                        class="form-check pl-2  @error('service') is-invalid @enderror" name="service[]"
                                        value="{{ $item->name }}" id="service" {{ in_array($item->name,$selectedItems)
                                    ? 'checked' : '' }}>
                                </div>
                                @endforeach
                            </div>

                            @error('service')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" name="status" value="1" class="form-check-input" {{
                                    $branch->status ==
                                1 ? 'checked' : '' }} value="1">
                                Status
                                <i class="input-helper"></i></label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('admin.admin_branchs.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection