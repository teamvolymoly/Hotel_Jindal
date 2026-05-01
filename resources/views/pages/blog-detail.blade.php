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
  $heroImage = $blog->image_path ? asset('storage/' . $blog->image_path) : asset('assets/bg/blog-1.jpg');
  $paragraphs = preg_split("/\r\n\r\n|\n\n|\r\r/", trim((string) $blog->content)) ?: [];
  $paragraphs = array_values(array_filter($paragraphs, fn ($paragraph) => trim($paragraph) !== ''));
  if (empty($paragraphs) && filled($blog->excerpt)) {
      $paragraphs = [trim($blog->excerpt)];
  }
@endphp

@section('content')
<header class="absolute inset-x-0 top-0 z-30">
  <div id="navBg" class="transition-colors duration-200">
    <div id="navShell"
      class="mx-auto flex w-full items-center justify-between px-5 py-6 text-white transition-colors duration-200 md:px-10 lg:px-16 xl:px-20 2xl:px-24 md:py-7">
      <button id="menuButton"
        class="inline-flex items-center justify-center rounded border border-white/40 px-2 py-1 text-xs uppercase tracking-[0.15em] md:hidden">
        Menu
      </button>

      <nav class="hidden flex-1 items-start gap-8 pt-1 md:flex lg:gap-12 2xl:gap-16">
        <button id="roomsToggle" type="button"
          class="group -mb-4 inline-flex flex-col items-center pb-4 leading-none text-left" aria-label="Rooms menu"
          aria-expanded="false">
          <span
            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Rooms
            <span class="ml-1 inline-flex align-middle" aria-hidden="true">
              <svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.0942 0.625L6.35962 6.35962L0.625 0.625" stroke="currentColor" stroke-width="1.25"
                  stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
          </span>
          <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
        </button>
        <a href="{{ route('eatdrink') }}" class="group inline-flex flex-col items-center leading-none">
          <span
            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Eat
            &amp; Drink</span>
          <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
        </a>
        <a href="{{ route('experiences') }}" class="group inline-flex flex-col items-center leading-none">
          <span
            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Experiences</span>
          <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
        </a>
      </nav>

      <a href="{{ route('home') }}"
        class="shrink-0 px-2 text-center font-serifDisplay text-[31px] leading-[1] tracking-[0.03em] md:px-6 md:text-[32px] 2xl:text-[40px]">
        <span class="block">HOTEL</span>
        <span class="block">JINDAL</span>
      </a>

      <nav class="hidden flex-1 items-start justify-end gap-8 pt-1 md:flex lg:gap-10">
        <a href="{{ route('gallery') }}" class="group inline-flex flex-col items-center leading-none">
          <span
            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Gallery</span>
          <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
        </a>
        <a href="{{ route('about') }}" class="group inline-flex flex-col items-center leading-none">
          <span
            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">About</span>
        </a>
        <a href="{{ route('contact') }}" class="group inline-flex flex-col items-center leading-none">
          <span
            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Contact</span>
          <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
        </a>
      </nav>

      <div class="w-[56px] md:hidden"></div>
    </div>
  </div>

  <div id="mobileMenu" class="hidden border-t border-white/20 bg-black/55 backdrop-blur-sm md:hidden">
    <div class="mx-auto flex w-full flex-col gap-4 px-5 py-5 text-center md:px-10 lg:px-16 xl:px-20 2xl:px-24">
      <a href="{{ route('rooms') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Rooms</a>
      <a href="{{ route('eatdrink') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Eat &amp; Drink</a>
      <a href="{{ route('experiences') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Experiences</a>
      <a href="{{ route('gallery') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Gallery</a>
      <a href="{{ route('about') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">About</a>
      <a href="{{ route('contact') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Contact</a>
    </div>
  </div>

  <div id="roomsMenu" class="hidden bg-[#f1f1f1] text-[#1f1f1f]">
    <div class="mx-auto w-full px-5 py-10 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
      <div class="grid grid-cols-3 gap-4">
        <a href="{{ route('rooms') }}" class="group block">
          <img src="{{ asset('assets/rooms/deluxe.png') }}" alt="Deluxe Room" class="h-[200px] w-full object-cover" />
          <span class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
            <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100" aria-hidden="true">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)" stroke="black" />
                </svg>
            </span>
            <span class="uppercase">Deluxe</span>
            <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100" aria-hidden="true">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)" stroke="black" />
                </svg>
            </span>
          </span>
        </a>
        <a href="{{ route('rooms') }}" class="group block">
          <img src="{{ asset('assets/rooms/family.png') }}" alt="Family Room" class="h-[200px] w-full object-cover" />
          <span class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
            <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100" aria-hidden="true">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)" stroke="black" />
                </svg>
            </span>
            <span class="uppercase">Family</span>
            <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100" aria-hidden="true">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)" stroke="black" />
                </svg>
            </span>
          </span>
        </a>
        <a href="{{ route('rooms') }}" class="group block">
          <img src="{{ asset('assets/rooms/executive.png') }}" alt="Executive Room" class="h-[200px] w-full object-cover" />
          <span class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
            <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100" aria-hidden="true">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)" stroke="black" />
                </svg>
            </span>
            <span class="uppercase">Executive</span>
            <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100" aria-hidden="true">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)" stroke="black" />
              </svg>
            </span>
          </span>
        </a>
      </div>
    </div>
  </div>
</header>

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
              src="{{ $relatedBlog->image_path ? asset('storage/' . $relatedBlog->image_path) : asset('assets/bg/blog-1.jpg') }}"
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

<footer class="bg-black py-8 text-white md:py-10">
  <div class="mx-auto w-full px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
    <div class="flex flex-col items-center gap-5 text-center md:flex-row md:justify-between md:text-left">
      <img src="{{ asset('assets/logo/Logo-2.png') }}" alt="Hotel Jindal Logo" class="h-12 w-auto md:h-14" />
      <div class="font-serifDisplay text-2xl leading-none md:text-[34px]">HOTEL JINDAL</div>

      <div class="flex items-center gap-6">
        <a href="#" aria-label="Instagram" class="opacity-95 transition hover:opacity-70">
          <img src="{{ asset('assets/svg/instagram.svg') }}" alt="" class="h-6 w-6" />
        </a>
        <a href="#" aria-label="Facebook" class="opacity-95 transition hover:opacity-70">
          <img src="{{ asset('assets/svg/facebook.svg') }}" alt="" class="h-6 w-6" />
        </a>
        <a href="#" aria-label="LinkedIn" class="opacity-95 transition hover:opacity-70">
          <img src="{{ asset('assets/svg/linkedin.svg') }}" alt="" class="h-6 w-6" />
        </a>
      </div>
    </div>

    <div class="mt-6 border-t border-white/20"></div>

    <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-[1.2fr_0.6fr_1.4fr]">
      <div>
        <p class="mt-4 text-sm text-white/90 md:text-[16px]">Fawwara Chowk, Neemuch (M.P.)</p>
        <p class="mt-3 text-sm text-white/90 md:text-[16px]">
          <a href="tel:9111684157">Tel. +91 91116 84157</a>
        </p>
        <p class="mt-1 text-sm text-white/90 md:text-[16px]">
          <a href="mailto:info@hoteljindal.com">info@hoteljindal.com</a>
        </p>
      </div>

      <div class="space-y-2 text-sm md:text-[15px]">
        <a href="{{ route('rooms') }}" class="group flex items-center gap-4 transition hover:opacity-75">
          <span class="transition-transform duration-300 group-hover:translate-x-1">Rooms</span>
        </a>
        <a href="{{ route('eatdrink') }}" class="group flex items-center gap-4 transition hover:opacity-75">
          <span class="transition-transform duration-300 group-hover:translate-x-1">Eat & Drink</span>
        </a>
        <a href="{{ route('experiences') }}" class="group flex items-center gap-4 transition hover:opacity-75">
          <span class="transition-transform duration-300 group-hover:translate-x-1">Experience</span>
        </a>
        <a href="{{ route('gallery') }}" class="group flex items-center gap-4 transition hover:opacity-75">
          <span class="transition-transform duration-300 group-hover:translate-x-1">Gallery</span>
        </a>
        <a href="{{ route('about') }}" class="group flex items-center gap-4 transition hover:opacity-75">
          <span class="transition-transform duration-300 group-hover:translate-x-1">About</span>
        </a>
        <a href="{{ route('contact') }}" class="group flex items-center gap-4 transition hover:opacity-75">
          <span class="transition-transform duration-300 group-hover:translate-x-1">Contact</span>
        </a>
      </div>

      <div>
        <p class="max-w-[560px] text-sm text-white/90 md:text-[16px]">
          Book your stay today and discover seaside luxury, breathtaking views, and unforgettable moments.
        </p>
        <a href="{{ route('contact') }}"
          class="mt-6 inline-flex bg-white px-5 py-3 text-sm uppercase tracking-[0.02em] text-black transition hover:bg-[#ececec] md:text-[16px]">
          Book Your Stay
        </a>
      </div>
    </div>

    <div class="mt-8 flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
      <div class="flex flex-wrap items-center gap-4 text-[11px] text-white/90 md:text-[15px]">
        <a href="#" class="hover:underline">Cookies policy</a>
        <a href="#" class="hover:underline">Privacy policy</a>
        <a href="#" class="hover:underline">Terms of service</a>
      </div>

      <button id="backToTop"
        class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white p-3 text-black transition hover:bg-[#ececec]"
        aria-label="Back to top">
        <svg width="26" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M24.707 13L12.707 1L0.707031 13" stroke="black" stroke-width="3" stroke-linejoin="round" />
        </svg>
      </button>
    </div>

    <div class="mt-4 border-t border-white/20"></div>

    <div class="mt-6 flex flex-col gap-3 text-[12px] text-white/90 md:flex-row md:items-center md:justify-between md:text-[14px]">
      <p>Hotel Jindal , &copy; 2026</p>
      <a href="https://www.volymoly.com/" class="inline-flex items-center gap-5">
        <span>created by volymoly</span>
        <img src="{{ asset('assets/svg/volymoly.svg') }}" alt="volymoly" class="h-auto w-[6rem] md:h-4" />
      </a>
    </div>
  </div>
</footer>
@endsection

@section('scripts')
<script>
  const menuButton = document.getElementById("menuButton");
  const mobileMenu = document.getElementById("mobileMenu");
  const navBg = document.getElementById("navBg");
  const navShell = document.getElementById("navShell");
  const roomsToggle = document.getElementById("roomsToggle");
  const roomsMenu = document.getElementById("roomsMenu");
  const backToTop = document.getElementById("backToTop");

  menuButton?.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });

  const setRoomsNavTheme = (isOpen) => {
    navBg.classList.toggle("bg-[#f1f1f1]", isOpen);
    navShell.classList.toggle("text-black", isOpen);
    navShell.classList.toggle("text-white", !isOpen);
  };

  const openRoomsMenu = () => {
    roomsMenu.classList.remove("hidden");
    roomsToggle.setAttribute("aria-expanded", "true");
    setRoomsNavTheme(true);
  };

  const closeRoomsMenu = () => {
    roomsMenu.classList.add("hidden");
    roomsToggle.setAttribute("aria-expanded", "false");
    setRoomsNavTheme(false);
  };

  let roomsCloseTimer;
  const clearRoomsCloseTimer = () => {
    if (roomsCloseTimer) {
      clearTimeout(roomsCloseTimer);
      roomsCloseTimer = null;
    }
  };

  const scheduleRoomsClose = () => {
    clearRoomsCloseTimer();
    roomsCloseTimer = setTimeout(() => {
      closeRoomsMenu();
    }, 220);
  };

  roomsToggle?.addEventListener("mouseenter", () => {
    clearRoomsCloseTimer();
    openRoomsMenu();
  });

  roomsToggle?.addEventListener("mouseleave", () => {
    scheduleRoomsClose();
  });

  roomsMenu?.addEventListener("mouseenter", () => {
    clearRoomsCloseTimer();
    openRoomsMenu();
  });

  roomsMenu?.addEventListener("mouseleave", () => {
    scheduleRoomsClose();
  });

  document.addEventListener("click", () => {
    closeRoomsMenu();
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeRoomsMenu();
    }
  });

  backToTop?.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
</script>
@endsection
