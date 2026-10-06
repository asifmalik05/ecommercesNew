<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::paginate(9);
        $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));

        return view('shop.index', compact('products', 'cartCount'));
    }

    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        $cart[$product->id] = $cart[$product->id] ?? [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'description' => $product->description,
            'quantity' => 0,
        ];

        $cart[$product->id]['quantity']++;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        $items = collect($cart)
            ->map(fn($item, $id) => array_merge(['id' => $id], $item))
            ->values();
        $total = $items->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('shop.cart', compact('cart', 'items', 'total', 'cartCount'));
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('shop.checkout', compact('cart', 'total', 'cartCount'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Cart is empty');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'email' => $request->email,
            'address' => $request->address,
            'total' => $total,
            'status' => 'completed',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('order.success', $order->id);
    }

    public function orderSuccess($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);

        return view('shop.order-success', compact('order'));
    }

    public function show(Product $product)
    {
        $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity') ?: []);
        return view('shop.show', compact('product', 'cartCount'));
    }

    public function categories()
    {
        $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity') ?: []);
        $categories = Product::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category');

        return view('categories.index', compact('categories', 'cartCount'));
    }

    public function category($category)
    {
        $products = Product::where('category', $category)->paginate(9);
        $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity') ?: []);

        return view('categories.show', compact('category', 'products', 'cartCount'));
    }

    public function updateCart(Request $request, $productId)
    {
        $request->validate([
            'operation' => 'required|in:increment,decrement',
        ]);

        $cart = session()->get('cart', []);

        if (! isset($cart[$productId])) {
            return redirect()->route('cart.index');
        }

        if ($request->operation === 'increment') {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId]['quantity'] = max(1, $cart[$productId]['quantity'] - 1);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }
}
