@extends('admin.layouts.app')

@section('title', 'Edit Menu Item')

@section('content')
    <form method="POST" action="{{ route('admin.menu-items.update', $menuItem) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.menu-items._form', ['submitLabel' => 'Update Menu Item'])
    </form>
@endsection
