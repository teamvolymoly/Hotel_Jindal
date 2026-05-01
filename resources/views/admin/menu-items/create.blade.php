@extends('admin.layouts.app')

@section('title', 'Create Menu Item')

@section('content')
    <form method="POST" action="{{ route('admin.menu-items.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.menu-items._form', ['submitLabel' => 'Create Menu Item'])
    </form>
@endsection
