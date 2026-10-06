@extends('layouts.app')

@section('title', 'Shop Products')

@section('content')
<section class="bg-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[1.2fr_0.8fr] lg:px-8 lg:py-16">
        <div class="flex flex-col justify-center">
            <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">Everyday essentials</p>
            <h1 class="mt-4 max-w-3xl text-4xl font-bold tracking-tight text-zinc-950 sm:text-5xl">Shop quality products at honest prices</h1>
            <p class="mt-5 max-w-2xl text-base leading-7 text-zinc-600">Browse clothing, accessories, electronics, and home essentials with clear pricing, simple cart actions, and a clean checkout flow.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#products" class="inline-flex items-center justify-center rounded-lg bg-teal-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-700">Shop products</a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-300 px-5 py-3 text-sm font-semibold text-zinc-800 hover:bg-zinc-100">Browse categories</a>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-zinc-200 bg-zinc-100">
            @if($products->first() && $products->first()->image)
                <img src="{{ $products->first()->image }}" alt="{{ $products->first()->name }}" class="h-full min-h-80 w-full object-cover">
            @else
                <div class="flex min-h-80 items-center justify-center text-zinc-500">Featured product</div>
            @endif
        </div>
    </div>
</section>

<section id="products" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">Catalog</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-zinc-950">Products</h2>
        </div>
        <p class="text-sm text-zinc-500">{{ $products->total() }} products available</p>
    </div>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($products as $product)
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
                        <div class="flex items-start justify-between gap-4">
                            <h3 class="text-lg font-semibold text-zinc-950">
                                <a href="{{ route('product.show', $product) }}" class="hover:text-teal-700">{{ $product->name }}</a>
                            </h3>
                            <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-600">{{ $product->category ?? 'General' }}</span>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-zinc-600">{{ \Illuminate\Support\Str::limit($product->description, 95) }}</p>
                        <div class="mt-auto pt-5">
                            <div class="mb-4 flex items-center justify-between">
                                <p class="text-xl font-bold text-zinc-950">Rs. {{ number_format($product->price, 2) }}</p>
                                <p class="text-xs font-medium {{ $product->stock > 0 ? 'text-emerald-700' : 'text-red-600' }}">
                                    {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                                </p>
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
        @endforeach
    </div>

    <div class="mt-10">
        {{ $products->links() }}
    </div>
</section>
@endsection
