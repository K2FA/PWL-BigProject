@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Edit Product</h2>
            <div class="card">
                <form action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <h4>Validasi Edit Data Product</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $product->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" value="{{ $product->price }}">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="picture">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input " id="customFile" name="picture">
                                <label for="customFile" class="custom-file-label">Choose File</label>
                            </div>
                            @error('picture')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descriptions">Description</label>
                            <textarea name="descriptions" id="descriptions" class="form-control" placeholder="Product Description">{{$product->descriptions}}</textarea>
                            @error('descriptions')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('product.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
