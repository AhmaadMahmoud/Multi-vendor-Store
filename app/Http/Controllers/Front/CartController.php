<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repository\Cart\CartModelRepository;
use App\Repository\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CartRepository $cart)
    {
        return view('front.cart',['cart' => $cart]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show(){

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required','int','exists:products,id'],
            'quantity' => ['nullable','int','min:1']
        ]);
        $products = Product::findOrFail($request->post('product_id'));
        $cart->add($products,$request->post('quantity'));
        if($request->expectsJson()){
            return response()->json([
                'Message'=>'Item Added To Cart'
            ],201);
        }
        return redirect()->route('cart.index')->with('success','Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required','int','min:1']
        ]);
        $this->cart->update($id,$request->post('quantity'));

        $total = $this->cart->total();

    // إرجاع التوتال الجديد في استجابة JSON
    return response()->json([
        'success' => true,
        'total' => number_format($total,2)
    ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cart->delete($id);
        $total = $this->cart->total();
        return response()->json([
        'success' => true,
        'total' => number_format($total, 2) // تنسيق التوتال ليكون برقمين بعد العلامة
    ]);
    }
}
