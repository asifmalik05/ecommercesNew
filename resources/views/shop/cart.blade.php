@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">Cart</p>
            <h1 class="mt-2 text-4xl font-bold tracking-tight text-zinc-950">Shopping cart</h1>
        </div>
        <a href="{{ route('shop.index') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-800 hover:bg-zinc-100">Continue shopping</a>
    </div>

    @if(session('success'))
        <div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @if($items->isEmpty())
        <div class="mt-8 rounded-lg border border-zinc-200 bg-white p-10 text-center shadow-sm">
            <p class="text-xl font-semibold text-zinc-950">Your cart is empty</p>
            <p class="mt-3 text-sm text-zinc-500">Add products to your cart and they will appear here.</p>
            <a href="{{ route('shop.index') }}" class="mt-6 inline-flex rounded-lg bg-teal-600 px-5 py-3 text-sm font-semibold text-white hover:bg-teal-700">Shop products</a>
        </div>
    @else
        <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_360px]">
            <div class="space-y-4">
                @foreach($items as $item)
                    <article class="grid gap-5 rounded-lg border border-zinc-200 bg-white p-5 shadow-sm sm:grid-cols-[120px_1fr_auto]">
                        <div class="overflow-hidden rounded-lg bg-zinc-100">
                            @if(!empty($item['image'] ?? null))
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-32 w-full object-cover sm:h-full">
                            @else
                                <div class="flex h-32 items-center justify-center text-sm text-zinc-500">No image</div>
                            @endif
                        </div>

                        <div>
                            <a href="{{ route('product.show', $item['id']) }}" class="text-lg font-semibold text-zinc-950 hover:text-teal-700">{{ $item['name'] }}</a>
                            <p class="mt-2 text-sm leading-6 text-zinc-600">{{ \Illuminate\Support\Str::limit($item['description'] ?? '', 110) }}</p>
                            <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="mt-4 inline-flex items-center rounded-lg border border-zinc-200">
                                @csrf
                                <button type="submit" name="operation" value="decrement" class="h-10 w-10 text-lg font-semibold text-zinc-700 hover:bg-zinc-100">-</button>
                                <span class="flex h-10 min-w-12 items-center justify-center border-x border-zinc-200 px-3 text-sm font-semibold">{{ $item['quantity'] }}</span>
                                <button type="submit" name="operation" value="increment" class="h-10 w-10 text-lg font-semibold text-zinc-700 hover:bg-zinc-100">+</button>
                            </form>
                        </div>

                        <div class="flex flex-col justify-between gap-4 sm:text-right">
                            <div>
                                <p class="text-lg font-bold text-zinc-950">Rs. {{ number_format($item['price'], 2) }}</p>
                                <p class="mt-1 text-sm text-zinc-500">Subtotal Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </div>
                            <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                @csrf
                                <button type="submit" class="rounded-lg border border-red-200 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-50">Remove</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>

            <aside class="h-fit rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-zinc-950">Order summary</h2>
                <div class="mt-6 space-y-4 text-sm">
                    <div class="flex items-center justify-between text-zinc-600">
                        <span>Items</span>
                        <span>{{ $items->sum('quantity') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-zinc-600">
                        <span>Shipping</span>
                        <span>Calculated at checkout</span>
                    </div>
                    <div class="border-t border-zinc-200 pt-4">
                        <div class="flex items-center justify-between text-lg font-bold text-zinc-950">
                            <span>Total</span>
                            <span>Rs. {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('checkout') }}" class="mt-6 inline-flex w-full items-center justify-center rounded-lg bg-teal-600 px-5 py-3 text-sm font-semibold text-white hover:bg-teal-700">Checkout</a>
            </aside>
        </div>
    @endif
</section>
@endsection
