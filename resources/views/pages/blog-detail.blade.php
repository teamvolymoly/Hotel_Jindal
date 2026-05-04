@extends('layouts.app')

@section('title', $blog->title . ' - Hotel Jindal')
@section('body_class', 'bg-[#111] font-body text-white antialiased')

@section('head')
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          serifDisplay: ["Gilda Display", "serif"],
          body: ["Raleway", "sans-serif"]
        }
      }
    }
  };
</script>
<style>
  @font-face {
    font-family: "Gilda Display";
    src: url("{{ asset('assets/fonts/GildaDisplay-Regular.ttf') }}") format("truetype");
    font-style: normal;
    font-weight: 400;
    font-display: swap;
  }

  @font-face {
    font-family: "Raleway";
    src: url("{{ asset('assets/fonts/Raleway-VariableFont_wght.ttf') }}") format("truetype");
    font-style: normal;
    font-weight: 100 900;
    font-display: swap;
  }

  .hero-overlay {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0.62) 100%);
  }
</style>
@endsection

@php
  $heroImage = $blog->image_url ?: asset('assets/bg/blog-1.jpg');
  $paragraphs = preg_split("/\r\n\r\n|\n\n|\r\r/", trim((string) $blog->content)) ?: [];
  $paragraphs = array_values(array_filter($paragraphs, fn ($paragraph) => trim($paragraph) !== ''));
  if (empty($paragraphs) && filled($blog->excerpt)) {
      $paragraphs = [trim($blog->excerpt)];
  }
@endphp

@section('content')
@include('partials.public-header')

<section class="relative flex min-h-[80vh] items-end">
  <img src="{{ $heroImage }}" alt="{{ $blog->title }}" class="absolute inset-0 h-full w-full object-cover object-center">
  <div class="hero-overlay absolute inset-0"></div>

  <div class="relative z-10 max-w-[1000px] px-5 pb-16 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
    <p class="text-xs uppercase tracking-[0.15em] text-white/70">
      {{ $blog->blog_tag ?: 'Hotel Jindal' }} &nbsp; • &nbsp; {{ optional($blog->published_at)->format('d M Y') ?? $blog->created_at->format('d M Y') }}
    </p>

    <h1 class="mt-4 font-serifDisplay text-3xl leading-[1.1] sm:text-4xl md:text-5xl lg:text-6xl">
      {{ $blog->title }}
    </h1>
  </div>
</section>

<section class="bg-[#f1f1f1] px-5 py-20 text-[#1f1f1f]">
  <div class="mx-auto w-full max-w-[1180px] px-0 md:px-6 lg:px-10">
    @foreach ($paragraphs as $index => $paragraph)
      <p class="{{ $index === 0 ? '' : 'mt-6' }} text-[17px] leading-[1.8] text-[#444]">
        {{ $paragraph }}
      </p>

      @if ($index === 0 && $blog->image_path)
        <div class="mt-12 overflow-hidden">
          <img src="{{ $heroImage }}" alt="{{ $blog->title }}" class="w-full object-cover">
          @if (filled($blog->image_caption))
            <div class="bg-white px-5 py-4 text-[15px] leading-[1.8] text-[#444] md:px-8 md:text-[16px]">
              {{ $blog->image_caption }}
            </div>
          @endif
        </div>
      @endif
    @endforeach

    @if (empty($paragraphs))
      <p class="text-[17px] leading-[1.8] text-[#444]">
        More details for this story will be shared soon.
      </p>
    @endif

    @if (empty($paragraphs) && $blog->image_path)
      <div class="mt-12 overflow-hidden">
        <img src="{{ $heroImage }}" alt="{{ $blog->title }}" class="w-full object-cover">
        @if (filled($blog->image_caption))
          <div class="bg-white px-5 py-4 text-[15px] leading-[1.8] text-[#444] md:px-8 md:text-[16px]">
            {{ $blog->image_caption }}
          </div>
        @endif
      </div>
    @endif
  </div>
</section>

@if ($relatedBlogs->isNotEmpty())
  <section class="bg-[#ece7de] px-5 py-20 text-[#1f1f1f]">
    <div class="mx-auto w-full max-w-[1320px]">
      <h2 class="text-center font-serifDisplay text-3xl leading-none sm:text-5xl lg:text-5xl 2xl:text-6xl">MORE STORIES</h2>

      <div class="mt-10 grid grid-cols-1 gap-5 md:mt-12 md:grid-cols-3 md:gap-7">
        @foreach ($relatedBlogs as $relatedBlog)
          <article class="group relative min-h-[420px] overflow-hidden">
            <img
              src="{{ $relatedBlog->image_url ?: asset('assets/bg/blog-1.jpg') }}"
              alt="{{ $relatedBlog->title }}"
              class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]" />
            <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(245,245,245,0.58)_0%,rgba(245,245,245,0.84)_52%,rgba(245,245,245,0.95)_100%)]"></div>
            <div class="relative z-10 flex min-h-[420px] flex-col justify-end px-6 pb-6">
              <span class="inline-flex w-fit border border-black/40 px-2 py-1 text-[14px] leading-none">
                {{ $relatedBlog->blog_tag }}
              </span>
              <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2] md:text-[34px]">{{ $relatedBlog->title }}</h3>
              <p class="mt-3 text-[14px] leading-[1.4] text-black/78 2xl:text-[16px]">
                {{ \Illuminate\Support\Str::limit($relatedBlog->excerpt, 170) }}
              </p>
              <a href="{{ route('blogs.show', $relatedBlog) }}" class="group mt-5 inline-flex items-center gap-2 text-[18px] leading-none">
                <span>Read More</span>
                <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100" aria-hidden="true">
                  <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)" stroke="black" />
                  </svg>
                </span>
              </a>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>
@endif

<section class="bg-[#e7e7e7] py-20 text-center text-[#1f1f1f]">
  <h2 class="font-serifDisplay text-4xl md:text-5xl">
    PLAN YOUR STAY
  </h2>

  <a href="{{ route('contact') }}"
    class="mt-6 inline-flex bg-[#3c3c3c] px-8 py-4 text-sm uppercase text-white transition hover:bg-black">
    Book Now
  </a>
</section>

@include('partials.public-footer')
@endsection

@section('scripts')
<script>
  @include('partials.public-header-scripts')
  @include('partials.public-footer-scripts')
</script>
@endsection

