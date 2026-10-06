@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div>
        <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">Checkout</p>
        <h1 class="mt-2 text-4xl font-bold tracking-tight text-zinc-950">Complete your order</h1>
    </div>

    @if(empty($cart))
        <div class="mt-8 rounded-lg border border-zinc-200 bg-white p-10 text-center shadow-sm">
            <p class="text-xl font-semibold text-zinc-950">No items in cart</p>
            <p class="mt-3 text-sm text-zinc-500">Add products before starting checkout.</p>
            <a href="{{ route('shop.index') }}" class="mt-6 inline-flex rounded-lg bg-teal-600 px-5 py-3 text-sm font-semibold text-white hover:bg-teal-700">Continue shopping</a>
        </div>
    @else
        <div class="mt-8 grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
            <aside class="h-fit rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-zinc-950">Order summary</h2>
                <div class="mt-5 divide-y divide-zinc-100">
                    @foreach($cart as $item)
                        <div class="flex items-start justify-between gap-4 py-4 text-sm">
                            <div>
                                <p class="font-medium text-zinc-950">{{ $item['name'] }}</p>
                                <p class="mt-1 text-zinc-500">Qty {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-semibold text-zinc-950">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 flex items-center justify-between border-t border-zinc-200 pt-5 text-lg font-bold text-zinc-950">
                    <span>Total</span>
                    <span>Rs. {{ number_format($total, 2) }}</span>
                </div>
            </aside>

            <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-zinc-950">Shipping details</h2>
                <form method="POST" action="{{ route('order.place') }}" class="mt-6 space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-zinc-700" for="email">Email</label>
                        <input id="email" type="email" name="email" required value="{{ old('email') }}" class="mt-2 block w-full rounded-lg border border-zinc-300 px-4 py-3 text-sm text-zinc-950 shadow-sm outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-100">
                        @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700" for="address">Address</label>
                        <textarea id="address" name="address" rows="4" required class="mt-2 block w-full rounded-lg border border-zinc-300 px-4 py-3 text-sm text-zinc-950 shadow-sm outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-100">{{ old('address') }}</textarea>
                        @error('address') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <button class="w-full rounded-lg bg-teal-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-700">Place Order</button>
                </form>
            </div>
        </div>
    @endif
</section>
@endsection
