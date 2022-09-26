@extends('layouts.app')

@section('content')
@if(\Auth::check())
<div class="grid grid-cols-4 gap-4 p-4 justify-items-center">
    <div >
        <?php $korisnici = DB::select('select * from users'); ?>
        <h3 style="background:yellow">Upit : - ispis korisnika -</h3>
        <table class="table table-bordered table-responsive-lg" style="background:lightyellow">
        <tr>
            <th>ID</th>
            <th>Ime</th>
            <th>Email</th>
        </tr>
        @foreach($korisnici as $korisnik)
        <tr>
                <td><?php echo $korisnik->id ?></td>
                <td><?php echo $korisnik->name ?></td>
                <td><?php echo $korisnik->email ?></td>
        </tr>
        @endforeach
        </table>
    </div>
    <hr>
    <div>
    <?php $from='2022-01-01 00:00:00';$to='2022-12-31 23:59:59';
    $korisnici2022 =DB::table('users')
    ->whereBetween('created_at', [$from,$to])
    ->orderBy('created_at', 'desc')
    ->get();?>
        <h3 style="background:yellow">Upit: -ispis korisnika registriranih u 2022 godini poredanih po datumu registracije-</h3>
        <table style="background:lightyellow" class="table table-bordered table-responsive-lg">
        <tr>
            <th>ID</th>
            <th>Ime</th>
            <th>Email</th>
            <th>Registracija</th>
        </tr>
        @foreach($korisnici2022 as $korisnik)
        <tr>
                <td><?php echo $korisnik->id ?></td>
                <td><?php echo $korisnik->name ?></td>
                <td><?php echo $korisnik->email ?></td>
                <td><?php echo $korisnik->created_at ?></td>
        </tr>
        @endforeach
        </table>
    </div>
    <hr>
    <div>
        <h3 style="background:green">Upit: -ispis artikala poredanih po cijeni-</h3>
        <?php $artikli = DB::table('products')->orderBy('price', 'desc')
    ->get();?>
        <table style="background:lightgreen" class="table table-bordered table-responsive-lg">
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Tip proizvoda</th>
            <th>Cijena</th>
        </tr>
        @foreach($artikli as $product)
        <tr>
                <td><?php echo $product->id ?></td>
                <td><?php echo $product->name ?></td>
                <td><?php echo $product->description ?></td>
                <td><?php echo $product->type ?></td>
                <td><?php echo $product->price ?></td>
        </tr>
        @endforeach
        </table>
    </div>
    <hr>
    <div>
        <h3 style="background:green">Upit: -ispis broja proizvoda po tipu proizvoda -</h3>
        <?php $artikli = DB::table('products')->select('products.type as tip',DB::raw('count(*) as brojac'))
        ->groupBy('type')->orderBy('brojac', 'asc')->get();?>
       <table style="background:lightgreen" class="table table-bordered table-responsive-lg">
        <tr>
            <th>TIP</th>
            <th>BROJ ARTIKALA</th>
        </tr>
        @foreach($artikli as $product)
        <tr>
                <td><?php echo $product->tip ?></td>   
                <td><?php echo $product->brojac ?></td>
        </tr>
        @endforeach
        </table>
    </div>
    <hr>
    <div >
        <?php $korisnici = DB::table('users')
            ->join('purchase', 'users.id', '=', 'purchase.user_id')
            ->select('users.*')
            ->distinct()
            ->get(); ?>
        <h3 style="background:blue">Upit : - ispis korisnika koji su obavili bar jednu kupovinu -</h3>
        <table class="table table-bordered table-responsive-lg" style="background:lightblue">
        <tr>
            <th>ID</th>
            <th>Ime</th>
            <th>Email</th>
        </tr>
        @foreach($korisnici as $korisnik)
        <tr>
                <td><?php echo $korisnik->id ?></td>
                <td><?php echo $korisnik->name ?></td>
                <td><?php echo $korisnik->email ?></td>
        </tr>
        @endforeach
        </table>
    </div>
    <hr>
    <div>
        <?php $from='2022-09-23 00:00:00';$to='2022-09-23 23:59:59';
    $brkupovina =DB::table('purchase')
    ->whereBetween('purchase_time', [$from,$to])
    ->count();?>
       
    <h3 style="background:blue">Upit : - Broj kupovina na dan 23.09.2022 -</h3>
        <div><?php echo $brkupovina?></div>
    </div>
    <hr>
    <div >
        <?php $proizvodi = DB::table('products')
            ->select('products.type as tip','products.name as ime',DB::raw('count(*) as brojac'))
            ->join('purchase', 'products.id', '=', 'purchase.product_id')
            
            -> groupBy ('type','ime')
            ->orderByRaw ('COUNT(*) DESC ')
            ->get(); ?>
        <h3 style="background:gray">Upit : - Najprodavaniji proizvod -</h3>
        <table style="background:lightgray" class="table table-bordered table-responsive-lg">
        <tr>
            <th>Naziv</th>
            <th>TIP</th>
            <th>BROJ KUPOVINA</th>
        </tr>
        @foreach($proizvodi as $proizvod)
        <tr>
                <td><?php echo $proizvod->ime ?></td>
                <td><?php echo $proizvod->tip ?></td>   
                <td><?php echo $proizvod->brojac ?></td>
        </tr>
        @endforeach
        </table>
    </div>
    <hr>
    <div >
        <?php $from='2022-09-22 00:00:00';$to='2022-09-22 23:59:59';
        $kupovine = DB::table('products')
            ->select('products.type as tip','products.name as ime','purchase.purchase_time',DB::raw('sum(products.price) as brojac'),)
            ->join('purchase', 'products.id', '=', 'purchase.product_id')
            ->whereBetween('purchase_time', [$from,$to])
            ->groupBy ('type','ime','purchase_time')
            ->orderByRaw ('COUNT(*) DESC ')
            ->get();
    $sum=0;
    ?>
        <h3 style="background:gray">Upit : - Ispis ukupnog prometa na dan  22.09.2022-</h3>
        <table style="background:lightgray" class="table table-bordered table-responsive-lg">
        <tr>
            <th>Naziv</th>
            <th>Cijena</th>
            <th>VRIJEME KUPOVINE</th>
        </tr>
        @foreach($kupovine as $kupovina)
        <tr>
        <?php $sum=$sum+$kupovina->brojac ?>
                <td><?php echo $kupovina->ime ?></td>  
                <td><?php echo $kupovina->brojac ?></td>
                <td><?php echo $kupovina->purchase_time ?></td>
        </tr>
        @endforeach
        </table>
        <div>Ukupni promet za dan: <?php echo $sum ?></td></div>
    </div>
    <hr>
    <div >
        <?php $proizvodi = DB::table('products')
            ->select('products.type as tip','products.name as ime',DB::raw('count(*) as brojac'))
            ->join('purchase', 'products.id', '=', 'purchase.product_id')
            -> groupBy ('type','ime')
            ->orderByRaw ('COUNT(*) DESC ')
            ->get();?>
        <h3 style="background:gray">Upit : - Najprodavaniji tip proizvod -</h3>
        <div>Najprodavaniji tip: <?php echo $proizvodi[0]->tip ?> (kupovina: <?php echo $proizvodi[0]->brojac ?>)</div>
    </div>
    <hr>
    <div >
        <?php $kupovine = DB::table('products')
            ->select('products.type as tip','products.name as ime','products.price as cijena','users.name as korisnik')
            ->join('purchase', 'products.id', '=', 'purchase.product_id')
            ->join('users','users.id','=','purchase.user_id')
            ->where('products.price','>=','12')
            ->groupBy ('type','ime','cijena','korisnik')
            ->get();?>
        <h3 style="background:gray">Upit : - Imena kupaca koji su kupili proizvod cijene preko 12 -</h3>
        <table style="background:lightgray" class="table table-bordered table-responsive-lg">
        <tr>
            <th>Naziv proizvoda</th>
            <th>Cijena proizvoda</th>
            <th>Naziv kupca</th>
        </tr>
        @foreach($kupovine as $kupovina)
        <tr>
                <td><?php echo $kupovina->ime ?></td>  
                <td><?php echo $kupovina->cijena ?></td>
                <td><?php echo $kupovina->korisnik ?></td>
        </tr>
        @endforeach
        </table>
    </div>
    <hr>
</div>
@else
    <div>Prijavite se za prikaz</div>
@endif
@endsection