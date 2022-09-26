<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(50);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'price' => 'required'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Proizvod uspješno kreiran');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'price' => 'required'
        ]);
        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Proizvod je uspješno editovan');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Proizvod je obrisan');
    }
    public function buy($id){
        if (Auth::check())
        {
         $user = Auth::id();
         DB::table('purchase')->insert(
            array(
                   'user_id'   =>   $user,
                   'product_id'   =>   $id,
            )
        );
        return redirect()->route('products.index')
            ->with('success', 'Kupovina uspješna'); 
        }
        else return redirect()->route('products.index')
        ->with('fail', 'Korisnik nije prijavljen'); 
    }
    function upitiView()
    {
        return view("products.upiti");
    }
   
}