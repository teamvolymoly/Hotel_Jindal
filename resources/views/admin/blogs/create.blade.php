@extends('admin.layouts.app')

@section('title', 'Create Blog')

@section('content')
    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.blogs._form', ['submitLabel' => 'Create Blog'])
    </form>
@endsection
