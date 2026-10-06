@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">Collections</p>
        <h1 class="mt-2 text-4xl font-bold tracking-tight text-zinc-950">Shop by category</h1>
        <p class="mt-4 text-base leading-7 text-zinc-600">Jump directly into a product group and find what you need faster.</p>
    </div>

    @if($categories->isEmpty())
        <div class="mt-8 rounded-lg border border-zinc-200 bg-white p-8 text-zinc-600">No categories found.</div>
    @else
        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($categories as $cat)
                <a href="{{ route('category.show', $cat) }}" class="group rounded-lg border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-teal-300 hover:shadow-md">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-lg font-semibold text-zinc-950 group-hover:text-teal-700">{{ $cat }}</p>
                            <p class="mt-2 text-sm text-zinc-500">View products</p>
                        </div>
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-teal-50 text-teal-700">></span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>
@endsection
