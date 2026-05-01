@extends('admin.layouts.app')

@section('title', 'Edit Menu Category')

@section('content')
    <form method="POST" action="{{ route('admin.menu-categories.update', $menuCategory) }}">
        @csrf
        @method('PUT')
        @include('admin.menu-categories._form', ['submitLabel' => 'Update Category'])
    </form>
@endsection
