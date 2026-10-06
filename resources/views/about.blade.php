@extends('layouts.app')

@section('title', 'About Store')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">About Us</p>
            <h1 class="mt-3 max-w-3xl text-4xl font-bold tracking-tight text-zinc-950 sm:text-5xl">We make online shopping easy, reliable, and fast.</h1>
            <p class="mt-5 max-w-2xl text-base leading-7 text-zinc-600">
                Our ecommerce store is built for everyday customers who want quality products, transparent pricing, and a smooth checkout experience.
            </p>

            <div class="mt-8 grid gap-4">
                <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="font-semibold text-zinc-950">Fast delivery</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">Quick order handling and shipping across India.</p>
                </div>
                <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="font-semibold text-zinc-950">Secure checkout</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">Your order and payment data are protected in every step.</p>
                </div>
                <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="font-semibold text-zinc-950">Easy returns</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">Hassle-free returns if a product does not meet expectations.</p>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
            <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop" class="h-80 w-full object-cover" alt="Store products">
            <div class="grid grid-cols-3 divide-x divide-zinc-200 border-t border-zinc-200 text-center">
                <div class="p-5">
                    <p class="text-2xl font-bold text-zinc-950">120+</p>
                    <p class="mt-1 text-xs text-zinc-500">Products</p>
                </div>
                <div class="p-5">
                    <p class="text-2xl font-bold text-zinc-950">4.9</p>
                    <p class="mt-1 text-xs text-zinc-500">Rating</p>
                </div>
                <div class="p-5">
                    <p class="text-2xl font-bold text-zinc-950">24h</p>
                    <p class="mt-1 text-xs text-zinc-500">Support</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 grid gap-6 md:grid-cols-3">
        <article class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-zinc-950">Our Mission</h2>
            <p class="mt-3 text-sm leading-6 text-zinc-600">To create a trusted online shopping destination where customers can find well-chosen products for daily life.</p>
        </article>
        <article class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-zinc-950">Our Promise</h2>
            <p class="mt-3 text-sm leading-6 text-zinc-600">Fast order processing, careful packing, and responsive customer care so every purchase feels effortless.</p>
        </article>
        <article class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-zinc-950">Customer Focus</h2>
            <p class="mt-3 text-sm leading-6 text-zinc-600">We keep product details clear and resolve issues quickly so you can shop with confidence.</p>
        </article>
    </div>
</section>
@endsection
