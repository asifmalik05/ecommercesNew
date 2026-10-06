@extends('layouts.app')

@section('title', $category)

@section('content')
<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="mb-8 flex flex-wrap items-center gap-2 text-sm text-zinc-500">
        <a href="{{ route('shop.index') }}" class="hover:text-teal-700">Home</a>
        <span>/</span>
        <a href="{{ route('categories.index') }}" class="hover:text-teal-700">Categories</a>
        <span>/</span>
        <span class="text-zinc-900">{{ $category }}</span>
    </div>

    <div class="flex flex-col gap-4 rounded-lg border border-zinc-200 bg-white p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">Category</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-zinc-950">{{ $category }}</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('shop.index') }}" class="rounded-lg border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-800 hover:bg-zinc-100">All Products</a>
            <a href="{{ route('cart.index') }}" class="rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-700">Cart ({{ $cartCount ?? 0 }})</a>
        </div>
    </div>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($products as $product)
            <article class="flex overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="flex w-full flex-col">
                    <a href="{{ route('product.show', $product) }}" class="block aspect-[4/3] overflow-hidden bg-zinc-100">
                        @if($product->image)
                            <img src="{{ $product->image }}" class="h-full w-full object-cover transition duration-300 hover:scale-105" alt="{{ $product->name }}">
                        @else
                            <div class="flex h-full items-center justify-center text-sm text-zinc-500">No image</div>
                        @endif
                    </a>
                    <div class="flex flex-1 flex-col p-5">
                        <h2 class="text-lg font-semibold text-zinc-950">
                            <a href="{{ route('product.show', $product) }}" class="hover:text-teal-700">{{ $product->name }}</a>
                        </h2>
                        <p class="mt-3 text-sm leading-6 text-zinc-600">{{ \Illuminate\Support\Str::limit($product->description, 95) }}</p>
                        <div class="mt-auto pt-5">
                            <div class="mb-4 flex items-center justify-between">
                                <p class="text-xl font-bold text-zinc-950">Rs. {{ number_format($product->price, 2) }}</p>
                                <p class="text-xs font-medium {{ $product->stock > 0 ? 'text-emerald-700' : 'text-red-600' }}">{{ $product->stock > 0 ? 'In stock' : 'Out of stock' }}</p>
                            </div>
                            <form method="POST" action="{{ route('cart.add', $product) }}">
                                @csrf
                                <button class="w-full rounded-lg bg-teal-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-teal-700 disabled:cursor-not-allowed disabled:bg-zinc-300" @if($product->stock < 1) disabled @endif>
                                    @if($product->stock < 1) Out of stock @else Add to Cart @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-lg border border-zinc-200 bg-white p-8 text-zinc-600 sm:col-span-2 lg:col-span-3">No products found in this category.</div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $products->links() }}
    </div>
</section>
@endsection
