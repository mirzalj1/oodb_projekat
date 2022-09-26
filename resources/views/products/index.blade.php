@extends('layouts.app')

@section('content')
@if(\Auth::check())
<a class="btn btn-success" href="{{ URL::to('products/create') }}" title="Novi proizvod"> <i class="fas fa-plus-circle"></i>
Dodaj Novi Proizvod </a>
<a class="btn btn-warning" href="{{ URL::to('/upiti') }}" title="Prikazi upite"> <i class="fas fa-square"></i>
Upiti za bazu </a>
@endif
    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Tip proizvoda</th>
            <th>Cijena</th>
            <th>Uređivanje</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td><?php echo $product->id ?></td>
                <td><?php echo $product->name ?></td>
                <td><?php echo $product->description ?></td>
                <td><?php echo $product->type ?></td>
                <td><?php echo $product->price ?></td>
                <td>
                     <!-- Check user is logged in -->
            @if(\Auth::check())
              <!-- Check user is logged in --> 
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <!-- detalji (show method found at GET /products/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('products/' . $product->id) }}">Detalji</a>
                 <!-- kupi (buy method found at GET /products/{id} -->
                <a class="btn btn-small btn-warning" href="{{ URL::to('products/' . $product->id . '/buy') }}">Kupi</a>
<!-- uredi (edit method found at GET /products/{id}/edit -->
<a class="btn btn-small btn-info" href="{{ URL::to('products/' . $product->id . '/edit') }}">Uredi</a>

@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Obriši</button>
            @else
            <div class='dash '>
              <div class='error'> Niste prijavljeni  </div>
              <div> Prijavite se za uređivanje artikala</div>
            </div>
            @endif
           

                </td>
            </tr>
        @endforeach
    </table>

    {!! $products->links() !!}

@endsection