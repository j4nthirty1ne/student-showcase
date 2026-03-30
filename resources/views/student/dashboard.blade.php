@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('student-content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Welcome, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600 mt-2">Manage your projects and profile</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-gray-500 text-sm font-semibold uppercase">Your Projects</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ Auth::user()->projects()->count() }}</p>
            <a href="{{ route('student.projects.index') }}" class="text-blue-500 hover:text-blue-700 text-sm mt-4 inline-block">View Projects →</a>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-gray-500 text-sm font-semibold uppercase">Profile Status</h3>
            <p class="text-lg font-semibold text-green-600 mt-2">✓ Active</p>
            <a href="{{ route('student.profile.show') }}" class="text-blue-500 hover:text-blue-700 text-sm mt-4 inline-block">View Profile →</a>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-gray-500 text-sm font-semibold uppercase">Quick Action</h3>
            <p class="mt-2">
                <a href="{{ route('student.projects.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block">Add New Project</a>
            </p>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Dashboard</h2>
        <p class="text-gray-600">Start by <a href="{{ route('student.profile.edit') }}" class="text-blue-500 hover:text-blue-700">completing your profile</a> or <a href="{{ route('student.projects.create') }}" class="text-blue-500 hover:text-blue-700">creating your first project</a>.</p>
    </div>
</div>
@endsection
