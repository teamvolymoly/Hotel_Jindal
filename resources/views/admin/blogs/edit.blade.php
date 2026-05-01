@extends('admin.layouts.app')

@section('title', 'Edit Blog')

@section('content')
    <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.blogs._form', ['submitLabel' => 'Update Blog'])
    </form>
@endsection
