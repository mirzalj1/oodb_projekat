@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Pregled proizvoda </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="/products" title="Nazad"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID:</strong>
                <?php echo $product->id ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NAZIV:</strong>
                <?php echo $product->name ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>OPIS</strong>
                <?php echo $product->description ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>TIP PROIZVODA</strong>
                <?php echo $product->type ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>CIJENA</strong>
                <?php echo $product->price ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Datum kreiranja</strong>
                <?php echo $product->created_at ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Datum uređivanja</strong>
                <?php echo $product->updated_at ?>
            </div>
        </div>
    </div>
@endsection