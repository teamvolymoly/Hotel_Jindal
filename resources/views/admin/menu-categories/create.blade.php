@extends('admin.layouts.app')

@section('title', 'Create Menu Category')

@section('content')
    <form method="POST" action="{{ route('admin.menu-categories.store') }}">
        @csrf
        @include('admin.menu-categories._form', ['submitLabel' => 'Create Category'])
    </form>
@endsection
