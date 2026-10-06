@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="mb-8 flex flex-wrap items-center gap-2 text-sm text-zinc-500">
        <a href="{{ route('shop.index') }}" class="hover:text-teal-700">Home</a>
        <span>/</span>
        <a href="{{ route('categories.index') }}" class="hover:text-teal-700">Categories</a>
        <span>/</span>
        <span class="text-zinc-900">{{ $product->name }}</span>
    </div>

    <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr]">
        <div class="overflow-hidden rounded-lg border border-zinc-200 bg-zinc-100">
            @if($product->image)
                <img src="{{ $product->image }}" class="aspect-square w-full object-cover" alt="{{ $product->name }}">
            @else
                <div class="flex aspect-square items-center justify-center text-zinc-500">No image</div>
            @endif
        </div>

        <div class="flex flex-col justify-center">
            <div class="flex flex-wrap items-center gap-3">
                <span class="rounded-full bg-teal-50 px-3 py-1 text-xs font-semibold text-teal-700">{{ $product->category ?? 'General' }}</span>
                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                    {{ $product->stock > 0 ? 'In stock' : 'Out of stock' }}
                </span>
            </div>
            <h1 class="mt-5 text-4xl font-bold tracking-tight text-zinc-950">{{ $product->name }}</h1>
            <p class="mt-3 text-sm text-zinc-500">SKU: {{ $product->sku ?? 'N/A' }}</p>
            <p class="mt-6 text-3xl font-bold text-zinc-950">Rs. {{ number_format($product->price, 2) }}</p>
            <p class="mt-5 max-w-2xl text-base leading-7 text-zinc-600">{{ \Illuminate\Support\Str::limit($product->description, 260) }}</p>

            <div class="mt-8 flex flex-wrap gap-3">
                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <button class="rounded-lg bg-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-700 disabled:cursor-not-allowed disabled:bg-zinc-300" @if($product->stock < 1) disabled @endif>
                        @if($product->stock < 1) Out of stock @else Add to Cart @endif
                    </button>
                </form>
                <a href="{{ route('checkout') }}" class="rounded-lg border border-zinc-300 px-6 py-3 text-sm font-semibold text-zinc-800 hover:bg-zinc-100">Checkout</a>
            </div>
        </div>
    </div>

    <div class="mt-12 grid gap-6 lg:grid-cols-[1.4fr_0.6fr]">
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <h2 class="text-xl font-semibold text-zinc-950">Description</h2>
            <p class="mt-4 leading-7 text-zinc-600">{{ $product->description }}</p>
        </section>

        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <h2 class="text-xl font-semibold text-zinc-950">Specifications</h2>
            <dl class="mt-4 grid gap-3 text-sm">
                <div class="flex justify-between gap-4 border-b border-zinc-100 pb-3">
                    <dt class="text-zinc-500">Stock</dt>
                    <dd class="font-medium text-zinc-900">{{ $product->stock }}</dd>
                </div>
                <div class="flex justify-between gap-4 border-b border-zinc-100 pb-3">
                    <dt class="text-zinc-500">Weight</dt>
                    <dd class="font-medium text-zinc-900">{{ $product->weight ? $product->weight . ' kg' : 'N/A' }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-zinc-500">Dimensions</dt>
                    <dd class="font-medium text-zinc-900">{{ $product->dimensions ?? 'N/A' }}</dd>
                </div>
            </dl>
        </section>
    </div>
</section>
@endsection
