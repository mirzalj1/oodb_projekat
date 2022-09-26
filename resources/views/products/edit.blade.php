@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Uredi proizvod</h2>
            </div>
            <div class="pull-right">
            <a class="btn btn-primary" href="/products" title="Nazad"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Greška!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST">
    @method('PUT')
    @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Naziv:</strong>
                    <input type="text" name="name" value="<?php echo $product->name ?>" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Opis</strong>
                    <input type="text" name="description" value="<?php echo $product->description ?>" class="form-control" placeholder="Name">
                
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tip proizvoda</strong>
                    <input type="text" name="type" value="<?php echo $product->type ?>" class="form-control" placeholder="Type">
                
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cijena</strong>
                    <input type="number" name="price" class="form-control" placeholder="" value="<?php echo $product->price ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Završeno</button>
            </div>
        </div>

    </form>
@endsection