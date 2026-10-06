<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Storefront')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 font-sans text-zinc-950 antialiased">
    <div class="flex min-h-screen flex-col">
        <header class="sticky top-0 z-40 border-b border-zinc-200 bg-white/95 backdrop-blur">
            <nav class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('shop.index') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-teal-600 text-sm font-bold text-white">S</span>
                    <span class="text-lg font-bold tracking-tight">Store</span>
                </a>

                <div class="hidden items-center gap-1 md:flex">
                    <a class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-600 hover:bg-zinc-100 hover:text-zinc-950" href="{{ route('shop.index') }}#products">Products</a>
                    <a class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-600 hover:bg-zinc-100 hover:text-zinc-950" href="{{ route('categories.index') }}">Categories</a>
                    <a class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-600 hover:bg-zinc-100 hover:text-zinc-950" href="{{ route('about') }}">About</a>
                </div>

                <a class="inline-flex items-center justify-center rounded-lg border border-teal-600 px-4 py-2 text-sm font-semibold text-teal-700 transition hover:bg-teal-50" href="{{ route('cart.index') }}">
                    Cart ({{ $cartCount ?? 0 }})
                </a>
            </nav>
        </header>

        <main class="flex-1">
            @yield('content')
        </main>

        <footer class="border-t border-zinc-200 bg-zinc-950 text-white">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 md:grid-cols-3 lg:px-8">
                <div>
                    <h2 class="text-lg font-semibold">Store</h2>
                    <p class="mt-3 max-w-sm text-sm leading-6 text-zinc-400">A simple ecommerce demo with products, categories, cart, and checkout.</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-zinc-300">Quick Links</h2>
                    <div class="mt-3 grid gap-2 text-sm text-zinc-400">
                        <a class="hover:text-white" href="{{ route('shop.index') }}">Home</a>
                        <a class="hover:text-white" href="{{ route('categories.index') }}">Categories</a>
                        <a class="hover:text-white" href="{{ route('about') }}">About</a>
                    </div>
                </div>
                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-zinc-300">Contact</h2>
                    <p class="mt-3 text-sm text-zinc-400">support@example.com</p>
                    <p class="text-sm text-zinc-400">+91 98765 43210</p>
                </div>
            </div>
            <div class="border-t border-zinc-800 px-4 py-4 text-center text-xs text-zinc-500">
                &copy; {{ date('Y') }} Simple Ecommerce. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
