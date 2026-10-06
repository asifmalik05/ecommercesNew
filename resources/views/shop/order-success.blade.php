@extends('layouts.app')

@section('title', 'Order Placed')

@section('content')
<section class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-6">
        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Success</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-zinc-950">Order placed successfully</h1>
        <p class="mt-3 text-zinc-600">Order ID: #{{ $order->id }}</p>
    </div>

    <div class="mt-8 rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-zinc-950">Order details</h2>
        <dl class="mt-5 grid gap-4 text-sm sm:grid-cols-2">
            <div>
                <dt class="text-zinc-500">Email</dt>
                <dd class="mt-1 font-medium text-zinc-950">{{ $order->email }}</dd>
            </div>
            <div>
                <dt class="text-zinc-500">Status</dt>
                <dd class="mt-1"><span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">{{ ucfirst($order->status) }}</span></dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-zinc-500">Address</dt>
                <dd class="mt-1 font-medium text-zinc-950">{{ $order->address }}</dd>
            </div>
            <div>
                <dt class="text-zinc-500">Total</dt>
                <dd class="mt-1 text-lg font-bold text-zinc-950">Rs. {{ number_format($order->total, 2) }}</dd>
            </div>
        </dl>

        <h3 class="mt-8 text-lg font-semibold text-zinc-950">Items</h3>
        <div class="mt-4 overflow-hidden rounded-lg border border-zinc-200">
            <table class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50 text-left text-zinc-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Product</th>
                        <th class="px-4 py-3 font-medium">Qty</th>
                        <th class="px-4 py-3 font-medium">Price</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 bg-white">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="px-4 py-3 font-medium text-zinc-950">{{ $item->product->name }}</td>
                            <td class="px-4 py-3 text-zinc-600">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-zinc-600">Rs. {{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('shop.index') }}" class="mt-6 inline-flex rounded-lg bg-teal-600 px-5 py-3 text-sm font-semibold text-white hover:bg-teal-700">Continue Shopping</a>
</section>
@endsection
