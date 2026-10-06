<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    protected const SESSION_KEY = 'cart';

    public function index()
    {
        $items = collect(session()->get(self::SESSION_KEY, []))
            ->map(fn($item, $id) => array_merge(['id' => $id], $item))
            ->values()
            ->all();

        $total = collect($items)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('shop.cart', compact('items', 'total'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'operation' => 'required|in:increment,decrement',
        ]);

        $cart = session()->get(self::SESSION_KEY, []);

        if (! isset($cart[$id])) {
            return redirect()->route('cart.index');
        }

        if ($request->operation === 'increment') {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id]['quantity'] = max(1, $cart[$id]['quantity'] - 1);
        }

        session()->put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index');
    }
}