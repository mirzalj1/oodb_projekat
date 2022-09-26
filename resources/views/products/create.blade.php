@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Unos novog proizvoda</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="/products" title="Nazad"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Greška! Polja nisu ispravno popunjena</strong> 
            <ul>
                @foreach ($errors->all() as $error)
                    <li></li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/products" method="POST" >
    @method('POST')
    @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ime proizvoda:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Naziv proizvoda">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Opis proizvoda:</strong>
                    <textarea class="form-control" style="height:50px" name="description"
                        placeholder="Opis proizvoda"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tip proizvoda:</strong>
                    <textarea class="form-control" style="height:50px" name="description"
                        placeholder="Tip proizvoda"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cijena proizvoda:</strong>
                    <input type="number" name="price" class="form-control" placeholder="Cijena proizvoda">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Gotovo</button>
            </div>
        </div>

    </form>
@endsection