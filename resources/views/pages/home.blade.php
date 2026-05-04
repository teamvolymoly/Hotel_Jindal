@extends('layouts.app')

@section('title', 'Hotel Jindal')
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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

    .suite-card {
      transform: scale(0.84);
      opacity: 0.9;
      transition: transform 0.35s ease, opacity 0.35s ease;
    }

    .swiper-slide-active .suite-card {
      transform: scale(1);
      opacity: 1;
    }
  </style>
@endsection

@section('content')
<main class="relative min-h-screen overflow-hidden text-white">
    <div
      class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(0,0,0,0.36)_0%,rgba(0,0,0,0.26)_40%,rgba(0,0,0,0.48)_100%),url('{{ asset('assets/bg/hero-bg.jpg') }}')] bg-cover bg-center bg-no-repeat md:bg-center">
    </div>

    @include('partials.public-header')

    <section class="relative z-10 flex min-h-screen items-center justify-center px-5 pb-14 pt-24">
      <div class="mx-auto max-w-[980px] text-center mt-10">
        <h1
          class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
          Experience Modern Luxury
          <br />
          in the Heart of Nimach
        </h1>
        <p class="mx-auto mt-3 max-w-[750px] text-[18px] font-light text-white/90 md:mt-4">
          The First &amp; Finest Hotel Serving Nimach with Legacy and Grace
        </p>
        <a href="{{ route('contact') }}"
          class="mt-7 inline-flex justify-center items-center gap-2 bg-[#3c3c3c]/90 px-8 py-4 text-[18px] font-light text-center font-medium uppercase tracking-[0.05em] transition hover:bg-white md:mt-20 hover:text-[#3c3c3c]/90 hover:bg-white ">
          &nbsp; Book Now
          <span aria-hidden="true" class="inline-flex mb-0.5 ms-1">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M22 15H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M15 7.5L22.5 15L15 22.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>

          </span>
        </a>
      </div>
    </section>
  </main>

  <section class="bg-[#f1f1f1] px-5 py-16 text-[#1f1f1f] md:py-20">
    <div class="mx-auto max-w-[980px] text-center">
      <p class="text-sm text-black font-normal leading-none md:text-[18px]">Connect with the city's past and present</p>
      <h2
        class="mt-7 font-serifDisplay text-3xl sm:text-5xl lg:text-5xl 2xl:text-6xl text-black leading-[0.95] md:mt-8 md:text-6xl">
        HOTEL JINDAL</h2>
      <h3
        class="mx-auto mt-7 max-w-[650px] font-serifDisplay text-2xl leading-[1.5] md:mt-8 md:text-4xl md:leading-[1.25]">
        An Open Home Where The
        <br />
        Unexpected unfolds
      </h3>

      <p class="mx-auto mt-7 max-w-[760px] text-base leading-[1.55] text-[#2c2c2c] md:mt-8 md:text-[18px]">
        Nestled in the heart of Nimach, Hotel Jindal stands as a symbol of the city's growth and heritage. We have been
        the preferred choice for travelers, families, and business guests who seek comfort without compromise. Our
        hospitality is built on years of trust, warmth, and a genuine love for serving people.
      </p>

      <a href="#"
        class="group mt-7 inline-flex items-center gap-3 text-[18px] leading-none font-medium text-[#1f1f1f] md:mt-8">
        <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
          aria-hidden="true">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
              stroke="black" />
          </svg>
        </span>
        <span>Read More</span>
        <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
          aria-hidden="true">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
              stroke="black" />
          </svg>
        </span>
      </a>

      <div class="mt-10 grid grid-cols-1 gap-3 sm:grid-cols-3">
        <div class="flex h-fit py-7 flex-col items-center justify-center gap-6 bg-[#e7e7e7] text-[18px] font-medium">
          <img src="{{ asset('assets/icons/icn.webp') }}" alt="" class="h-16 w-16 object-contain" />
          <span>City center</span>
        </div>
        <div class="flex h-fit py-7 flex-col items-center justify-center gap-6 bg-[#e7e7e7] text-[18px] font-medium">
          <img src="{{ asset('assets/icons/icn.webp') }}" alt="" class="h-16 w-16 object-contain" />
          <span>In-Room Dining</span>
        </div>
        <div class="flex h-fit py-7 flex-col items-center justify-center gap-6 bg-[#e7e7e7] text-[18px] font-medium">
          <img src="{{ asset('assets/icons/icn.webp') }}" alt="" class="h-16 w-16 object-contain" />
          <span>Free Wi-Fi</span>
        </div>
      </div>

      <div class="mx-auto mt-4 grid max-w-[650px] grid-cols-1 gap-3 sm:grid-cols-2">
        <div class="flex h-fit py-7 flex-col items-center justify-center gap-6 bg-[#e7e7e7] text-[18px] font-medium">
          <img src="{{ asset('assets/icons/icn.webp') }}" alt="" class="h-16 w-16 object-contain" />
          <span>24/7 Front Desk</span>
        </div>
        <div class="flex h-fit py-7 flex-col items-center justify-center gap-6 bg-[#e7e7e7] text-[18px] font-medium">
          <img src="{{ asset('assets/icons/icn.webp') }}" alt="" class="h-16 w-16 object-contain" />
          <span>Parking Area</span>
        </div>
      </div>
    </div>
  </section>

  <section class="overflow-hidden bg-[#E3DED6] py-16 text-[#1f1f1f] md:py-20">
    <div class="w-full">
      <h2 class="px-4 text-center font-serifDisplay text-3xl leading-none sm:text-5xl lg:text-5xl 2xl:text-6xl">SUITES
        &amp; ROOMS</h2>

      <div class="relative mt-10 w-full md:mt-12">
        <button id="suitePrev"
          class="absolute left-[calc(50%-34%)] top-1/2 z-20 hidden -translate-x-1/2 -translate-y-1/2 p-2 text-black/85 transition hover:opacity-70 md:inline-flex"
          aria-label="Previous room">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="black" stroke-width="1.6" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </button>

        <button id="suiteNext"
          class="absolute right-[calc(50%-34%)] top-1/2 z-20 hidden translate-x-1/2 -translate-y-1/2 p-2 text-black/85 transition hover:opacity-70 md:inline-flex"
          aria-label="Next room">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 18L15 12L9 6" stroke="black" stroke-width="1.6" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </button>

        <div class="swiper suitesSwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide !w-[88%] md:!w-[62%]">
              <article class="suite-card group relative overflow-hidden">
                <img src="{{ asset('assets/rooms/deluxe.png') }}" alt="Deluxe Suite"
                  class="relative z-0 h-[330px] w-full object-cover md:h-[500px] 2xl:h-[600px]" />
                <div
                  class="absolute inset-0 z-10 bg-black/45 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center ">
                  <h3 class="font-serifDisplay text-3xl uppercase tracking-[0.04em] text-white md:text-[56px]">Deluxe
                  </h3>
                  <a href="#"
                    class="absolute top-[60%] z-30 mt-8 inline-flex items-center gap-2 bg-[#3c3c3c]/90 font-medium px-5 py-3 text-sm uppercase tracking-[0.04em] text-white opacity-0 transition group-hover:opacity-100 hover:bg-white hover:text-[#3c3c3c]/90">
                    More Info
                  </a>
                </div>
              </article>
            </div>

            <div class="swiper-slide !w-[88%] md:!w-[62%]">
              <article class="suite-card group relative overflow-hidden">
                <img src="{{ asset('assets/rooms/family.png') }}" alt="Family Suite"
                  class="relative z-0 h-[330px] w-full object-cover md:h-[500px] 2xl:h-[600px]" />
                <div
                  class="absolute inset-0 z-10 bg-black/45 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center">
                  <h3 class="font-serifDisplay text-3xl uppercase tracking-[0.04em] text-white md:text-[56px]">Family
                  </h3>
                  <a href="#"
                    class="absolute top-[60%] z-30 mt-8 inline-flex items-center gap-2 bg-[#3c3c3c]/90 font-medium px-5 py-3 text-sm uppercase tracking-[0.04em] text-white opacity-0 transition group-hover:opacity-100 hover:bg-white hover:text-[#3c3c3c]/90">
                    More Info
                  </a>
                </div>
              </article>
            </div>

            <div class="swiper-slide !w-[88%] md:!w-[62%]">
              <article class="suite-card group relative overflow-hidden">
                <img src="{{ asset('assets/rooms/executive.png') }}" alt="Executive Suite"
                  class="relative z-0 h-[330px] w-full object-cover md:h-[500px] 2xl:h-[600px]" />
                <div
                  class="absolute inset-0 z-10 bg-black/45 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center">
                  <h3 class="font-serifDisplay text-3xl uppercase tracking-[0.04em] text-white md:text-[56px]">Executive
                  </h3>
                  <a href="#"
                    class="absolute top-[60%] z-30 mt-8 inline-flex items-center gap-2 bg-[#3c3c3c]/90 font-medium px-5 py-3 text-sm uppercase tracking-[0.04em] text-white opacity-0 transition group-hover:opacity-100 hover:bg-white hover:text-[#3c3c3c]/90">
                    More Info
                  </a>
                </div>
              </article>
            </div>

            <div class="swiper-slide !w-[88%] md:!w-[62%]">
              <article class="suite-card group relative overflow-hidden">
                <img src="{{ asset('assets/rooms/family.png') }}" alt="Family Suite"
                  class="relative z-0 h-[330px] w-full object-cover md:h-[500px] 2xl:h-[600px]" />
                <div
                  class="absolute inset-0 z-10 bg-black/45 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center">
                  <h3 class="font-serifDisplay text-3xl uppercase tracking-[0.04em] text-white md:text-[56px]">Family
                  </h3>
                  <a href="#"
                    class="absolute top-[60%] z-30 mt-8 inline-flex items-center gap-2 bg-[#3c3c3c]/90 font-medium px-5 py-3 text-sm uppercase tracking-[0.04em] text-white opacity-0 transition group-hover:opacity-100 hover:bg-white hover:text-[#3c3c3c]/90">
                    More Info
                  </a>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-[#f1f1f1] py-16 text-[#1f1f1f] md:py-20">
    <div class="mx-auto w-full px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
      <h2 class="px-4 text-center font-serifDisplay text-3xl leading-none sm:text-5xl lg:text-5xl 2xl:text-6xl">EAT
        &amp; DRINK</h2>

      <div class="relative mx-auto mt-10 min-h-[430px] w-full overflow-hidden md:mt-12 md:min-h-[470px]">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
          style="background-image: url('{{ asset('assets/bg/eat-drink.jpg') }}');"></div>
        <div
          class="absolute inset-0 bg-[linear-gradient(90deg,rgba(242,242,242,0.97)_0%,rgba(242,242,242,0.95)_38%,rgba(242,242,242,0.55)_58%,rgba(242,242,242,0.16)_73%,rgba(242,242,242,0.02)_100%)]">
        </div>

        <div class="relative z-10 grid min-h-[430px] grid-cols-1 md:min-h-[470px] md:grid-cols-2">
          <div class="flex items-center px-7 py-10 md:px-9">
            <ul class="w-full">
              <li
                class="border-b border-[#c9c9c9] py-3 md:py-5 2xl:py-7 font-serifDisplay text-2xl leading-none md:text-[34px]">
                BREAKFAST</li>
              <li
                class="border-b border-[#c9c9c9] py-3 md:py-5 2xl:py-7 font-serifDisplay text-2xl leading-none md:text-[34px]">
                LUNCH
                PACK</li>
              <li
                class="border-b border-[#c9c9c9] py-3 md:py-5 2xl:py-7 font-serifDisplay text-2xl leading-none md:text-[34px]">
                DINNER
              </li>
              <li
                class="border-b border-[#c9c9c9] py-3 md:py-5 2xl:py-7 font-serifDisplay text-2xl leading-none md:text-[34px]">
                SNACKS
              </li>
              <li class="py-3 md:py-5 2xl:py-7 font-serifDisplay text-2xl leading-none md:text-[34px]">CHINESE</li>
            </ul>
          </div>

          <div class="flex items-center justify-start px-7 pt-12 2xl:pt-14 md:px-10 md:pb-0">
            <div class="max-w-[420px]">
              <h3 class="font-serifDisplay text-2xl leading-[0.95] md:text-4xl md:leading-[1.25]">
                CRAVING
                <br />
                SOMETHING?
              </h3>
              <p class="mt-4 max-w-[380px] text-sm leading-[1.5] text-[#252525] md:text-[18px]">
                Order delicious meals right to your room and enjoy every bite in comfort.
              </p>
              <a href="{{ route('menu') }}"
                class="mt-16 inline-flex items-center bg-[#404040] px-5 py-3 text-sm uppercase tracking-[0.04em] text-white transition hover:bg-[#343434] md:text-[18px]">
                Explore Menu
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-[#f1f1f1] pb-16 text-[#1f1f1f] md:pb-20">
    <div class="mx-auto w-full px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
      <h2 class="text-center font-serifDisplay text-3xl leading-none sm:text-5xl lg:text-5xl 2xl:text-6xl">MOMENTS &amp;
        MEMORIES</h2>

      <div class="mt-10 grid grid-cols-1 gap-5 md:mt-12 md:grid-cols-3 md:gap-7">
        @forelse ($homeBlogs as $blog)
          <article class="group relative min-h-[420px] overflow-hidden">
            <img src="{{ $blog->image_url ?: asset('assets/bg/blog-1.jpg') }}" alt="{{ $blog->title }}"
              class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]" />
            <div
              class="absolute inset-0 bg-[linear-gradient(180deg,rgba(245,245,245,0.58)_0%,rgba(245,245,245,0.84)_52%,rgba(245,245,245,0.95)_100%)]">
            </div>
            <div class="relative z-10 flex min-h-[420px] flex-col justify-end px-6 pb-6">
              <span class="inline-flex w-fit border border-black/40 px-2 py-1 text-[14px] leading-none">{{ $blog->blog_tag }}</span>
              <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2] md:text-[34px]">{{ $blog->title }}</h3>
              <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-black/78">
                {{ \Illuminate\Support\Str::limit($blog->excerpt, 170) }}
              </p>
              <a href="{{ route('blogs.show', $blog) }}" class="group mt-5 inline-flex items-center gap-2 text-[18px] leading-none">
                <span>Read More</span>
                <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                  aria-hidden="true">
                  <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
                      stroke="black" />
                  </svg>
                </span>
              </a>
            </div>
          </article>
        @empty
          <div class="rounded-3xl border border-dashed border-black/15 bg-white/70 px-8 py-16 text-center text-lg text-black/55 md:col-span-3">
            No active blogs available right now.
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="bg-[#f1f1f1] pb-16 text-[#1f1f1f] md:pb-20">
    <div
      class="mx-auto px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24 w-full h-[300px] md:h-[400px] lg:h-[500px] xl:h-[500px] 2xl:h-[600px]">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2159.515196484195!2d74.87335116676972!3d24.45574010395511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e58cc2eeb089%3A0x52bd798a1d843c1!2sHotel%20Jindal!5e0!3m2!1sen!2sin!4v1777188149897!5m2!1sen!2sin"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>

  <section class="bg-[#f1f1f1] pb-16 text-[#1f1f1f] md:pb-20">
    <div class="mx-auto w-full px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
      <h2 class="text-center font-serifDisplay text-3xl leading-none sm:text-5xl lg:text-5xl 2xl:text-6xl">FOLLOW US ON
        INSTAGRAM</h2>

      <div class="mt-10 grid grid-cols-2 gap-3 md:mt-12 md:grid-cols-6 md:gap-4">
        <div class="aspect-square bg-[#e6e6e6]"></div>
        <div class="aspect-square bg-[#e6e6e6]"></div>
        <div class="aspect-square bg-[#e6e6e6]"></div>
        <div class="aspect-square bg-[#e6e6e6]"></div>
        <div class="aspect-square bg-[#e6e6e6]"></div>
        <div class="aspect-square bg-[#e6e6e6]"></div>
      </div>
    </div>
  </section>

  @include('partials.public-footer')
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    @include('partials.public-header-scripts')
    const suitesSwiper = new Swiper(".suitesSwiper", {
      loop: true,
      centeredSlides: true,
      slidesPerView: "auto",
      spaceBetween: 10,
      speed: 650,
      navigation: {
        nextEl: "#suiteNext",
        prevEl: "#suitePrev"
      },
      breakpoints: {
        768: {
          spaceBetween: 14
        },
        1024: {
          spaceBetween: 18
        }
      }
    });

    @include('partials.public-footer-scripts')
  </script>
@endsection

