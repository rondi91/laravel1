<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Harga;
use App\Models\Produk;
use GuzzleHttp\Psr7\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data keranjang dari database
    $cartItems = Cart::all(); // Ganti dengan query yang sesuai
    
    // Tampilkan view index keranjang dengan data yang diperlukan
    return view('cart.index', ['cartItems' => $cartItems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        

            $productId = $request->input('product_id');

        // Periksa apakah produk dengan ID yang diberikan ada
        $product = Produk::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        // Buat atau perbarui item keranjang untuk pelanggan saat ini
        $cartItem = Cart::updateOrCreate(
            ['produk_id' => $productId, 'pelanggan_id' => 1],//auth()->user()->id],
            ['price' => 10000,'quantity' => 1]
        );

        if ($cartItem) {
            return response()->json(['success' => true, 'message' => 'Product added to cart successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to add product to cart.']);
        }
    }
        public function updatequantity(StoreCartRequest $request)
        {
            $cartId = $request->input('cart_id');
            $quantity = $request->input('quantity');

            // Validasi input jika diperlukan

            // Cari data keranjang berdasarkan ID
            $cartItem = Cart::find($cartId);

            if ($cartItem) {
                // Update jumlah produk pada keranjang
                $cartItem->quantity = $quantity;
                $cartItem->save();

                // Response sukses
                return response()->json(['message' => 'Quantity updated successfully']);
            } else {
                // Response gagal
                return response()->json(['message' => 'Cart item not found'], 404);
            }

            
        }
    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart, $id)
    {
        // Proses validasi input
    
    // Update jumlah produk dalam keranjang
    $cartItem = Cart::findOrFail($id); // Ganti dengan kode sesuai dengan model dan input yang digunakan
    $cartItem->update($request->all());
    
    // Redirect atau response yang sesuai
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart, $id)
    {
        // Hapus produk dari keranjang
    $cartItem = Cart::findOrFail($id); // Ganti dengan kode sesuai dengan model yang digunakan
    $cartItem->delete();
    
    // Redirect atau response yang sesuai
    }
}