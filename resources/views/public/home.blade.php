@extends('layouts.app')

@section('title', 'Home - Student Project Showcase')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Welcome to Student Project Showcase</h1>
        <p class="text-xl text-gray-600 mb-8">Share and discover amazing student projects</p>
        
        <div class="flex gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                Create Account
            </a>
            <a href="{{ route('login') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                Sign In
            </a>
        </div>
    </div>
</div>
@endsection
