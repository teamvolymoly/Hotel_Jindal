@extends('layouts.app')

@section('title', 'Deluxe Room – Hotel Jindal')
@section('body_class', 'bg-[#f1f1f1] font-body text-[#1f1f1f] antialiased')

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

        /* ── Room image slider ── */
        .room-swiper .swiper-slide {
            height: 540px;
        }

        @media (max-width: 768px) {
            .room-swiper .swiper-slide {
                height: 340px;
            }
        }

        .room-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Custom pagination bullets */
        .room-swiper .swiper-pagination-bullet {
            background: #1f1f1f;
            opacity: 0.28;
            width: 8px;
            height: 8px;
            transition: opacity 0.2s, transform 0.2s;
        }

        .room-swiper .swiper-pagination-bullet-active {
            opacity: 1;
            transform: scale(1.3);
        }

        /* Facility checkmark */
        .facility-item::before {
            content: "✓";
            font-size: 13px;
            color: #1f1f1f;
            margin-right: 10px;
            flex-shrink: 0;
        }

        /* Fade-in on scroll */
        .reveal {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        .room-swiper .swiper-pagination-bullet {
            width: 50px;
            height: 8px;
        }
    </style>
@endsection

@section('content')
<!-- ═══════════════════════════════════════
       HEADER (identical to index)
  ═══════════════════════════════════════ -->
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
                        class="group -mb-4 inline-flex flex-col items-center pb-4 leading-none text-left"
                        aria-label="Rooms menu" aria-expanded="false">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Rooms
                            <span class="ml-1 inline-flex align-middle" aria-hidden="true">
                                <svg width="13" height="7" viewBox="0 0 13 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.0942 0.625L6.35962 6.35962L0.625 0.625" stroke="currentColor"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px]" aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                    fill="currentColor" />
                            </svg>
                        </span>
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
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
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

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden border-t border-white/20 bg-black/55 backdrop-blur-sm md:hidden">
            <div class="mx-auto flex w-full flex-col gap-4 px-5 py-5 text-center">
                <a href="{{ route('rooms') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Rooms</a>
                <a href="{{ route('eatdrink') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Eat &amp; Drink</a>
                <a href="{{ route('experiences') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Experiences</a>
                <a href="{{ route('gallery') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Gallery</a>
                <a href="{{ route('about') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">About</a>
                <a href="{{ route('contact') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Contact</a>
            </div>
        </div>

        <!-- Rooms dropdown -->
        <div id="roomsMenu" class="hidden bg-[#f1f1f1] text-[#1f1f1f]">
            <div class="mx-auto w-full px-5 py-10 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
                <div class="grid grid-cols-3 gap-4">
                    <a href="{{ route('rooms') }}" class="group block">
                        <img src="{{ asset('assets/rooms/deluxe.png') }}" alt="Deluxe Room" class="h-[200px] w-full object-cover" />
                        <span
                            class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Deluxe</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                        </span>
                    </a>
                    <a href="{{ route('rooms') }}" class="group block">
                        <img src="{{ asset('assets/rooms/family.png') }}" alt="Family Room" class="h-[200px] w-full object-cover" />
                        <span
                            class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Family</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                        </span>
                    </a>
                    <a href="{{ route('rooms') }}" class="group block">
                        <img src="{{ asset('assets/rooms/executive.png') }}" alt="Executive Room"
                            class="h-[200px] w-full object-cover" />
                        <span
                            class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Executive</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ═══════════════════════════════════════
       HERO SECTION
  ═══════════════════════════════════════ -->
    <main class="relative min-h-screen overflow-hidden text-white">
        <div
            class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(0,0,0,0.30)_0%,rgba(0,0,0,0.18)_40%,rgba(0,0,0,0.42)_100%),url('{{ asset('assets/rooms/deluxe.png') }}')] bg-cover bg-center bg-no-repeat">
        </div>

        <div class="relative z-10 flex min-h-screen flex-col items-center justify-center px-5 pb-14 pt-24 text-center">
            <h1
                class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                DELUXE
            </h1>
            <a href="{{ route('contact') }}"
                class="mt-10 inline-flex items-center gap-3 bg-[#3c3c3c]/90 px-8 py-4 text-sm font-medium uppercase tracking-[0.08em] transition hover:bg-white hover:text-[#3c3c3c]">
                Book Now
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 15H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M15 7.5L22.5 15L15 22.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </main>

    <!-- ═══════════════════════════════════════
       BREADCRUMB + ROOM INFO
  ═══════════════════════════════════════ -->
    <section class="bg-white px-5 py-14 text-[#1f1f1f] md:py-20 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
        <div class="mx-auto max-w-[860px] text-center">

            <!-- Breadcrumb -->
            <nav
                class="mb-10 flex items-center justify-center gap-2 text-[11px] uppercase tracking-[0.12em] text-[#1f1f1f]/60">
                <a href="{{ route('home') }}" class="hover:text-[#1f1f1f] transition">Home</a>
                <svg width="6" height="10" viewBox="0 0 6 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#1f1f1f" stroke-opacity="0.4" stroke-width="1.2"
                        stroke-linecap="round" />
                </svg>
                <a href="{{ route('rooms') }}" class="hover:text-[#1f1f1f] transition">Rooms</a>
                <svg width="6" height="10" viewBox="0 0 6 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#1f1f1f" stroke-opacity="0.4" stroke-width="1.2"
                        stroke-linecap="round" />
                </svg>
                <span class="text-[#1f1f1f]">Deluxe</span>
                <svg width="6" height="10" viewBox="0 0 6 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#1f1f1f" stroke-opacity="0.4" stroke-width="1.2"
                        stroke-linecap="round" />
                </svg>
            </nav>

            <!-- Room name -->
            <h2
                class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2] reveal">
                DELUXE
            </h2>

            <!-- 3-col stats -->
            <div class="mt-12 grid grid-cols-3 divide-x divide-[#d0d0d0] reveal">
                <div class="flex flex-col items-center justify-center px-4 py-6">
                    <span class="font-serifDisplay text-2xl leading-tight md:text-[32px]">2–6</span>
                    <span class="mt-1 font-serifDisplay text-2xl leading-tight md:text-[32px]">GUESTS</span>
                </div>
                <div class="flex flex-col items-center justify-center px-4 py-6">
                    <span class="font-serifDisplay text-center text-xl leading-tight md:text-[28px]">EXCLUSIVE
                        &amp;</span>
                    <span
                        class="font-serifDisplay text-center text-xl leading-tight md:text-[28px]">SOPHISTICATED</span>
                </div>
                <div class="flex flex-col items-center justify-center px-4 py-6">
                    <span class="font-serifDisplay text-2xl leading-tight md:text-[32px]">KING</span>
                    <span class="font-serifDisplay text-2xl leading-tight md:text-[32px]">SIZE</span>
                </div>
            </div>

            <!-- Description -->
            <p
                class="mx-auto mt-10 max-w-[680px] text-center text-sm leading-[1.75] text-[#2c2c2c] md:text-[16px] reveal">
                The ultimate expression of luxury. The Deluxe Room comprises a spacious bedroom with a plush king-size
                bed, a
                comfortable sitting area, and an elegantly appointed bathroom. With outstanding views of the city, this
                sophisticated room can be connected to a double room transforming the space into a five-adult or four
                adult
                and two children apartment. The perfect answer for guests seeking a unique experience.
            </p>

            <!-- Book now CTA -->
            <a id="book" href="{{ route('contact') }}"
                class="mt-10 inline-flex items-center gap-3 bg-[#3c3c3c] px-8 py-4 text-sm font-medium uppercase tracking-[0.08em] text-white transition hover:bg-[#1f1f1f] reveal">
                Book Now
                <svg width="28" height="28" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 15H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M15 7.5L22.5 15L15 22.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </section>

    <!-- ═══════════════════════════════════════
       ROOM IMAGE SLIDER
  ═══════════════════════════════════════ -->
    <section class="relative bg-[#e9e4dc] overflow-hidden">

        <!-- Swiper -->
        <div class="swiper room-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('assets/rooms/deluxe.png') }}" alt="Deluxe Room – View 1" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/rooms/executive.png') }}" alt="Deluxe Room – View 2" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/rooms/family.png') }}" alt="Deluxe Room – View 3" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/rooms/deluxe.png') }}" alt="Deluxe Room – View 4" />
                </div>
            </div>

            <!-- Navigation arrows -->
            <button id="roomPrev"
                class="absolute left-5 top-1/2 z-20 -translate-y-1/2 flex h-11 w-11 items-center justify-center bg-white/80 backdrop-blur-sm text-black transition hover:bg-white md:left-8"
                aria-label="Previous image">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="black" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
            <button id="roomNext"
                class="absolute right-5 top-1/2 z-20 -translate-y-1/2 flex h-11 w-11 items-center justify-center bg-white/80 backdrop-blur-sm text-black transition hover:bg-white md:right-8"
                aria-label="Next image">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="black" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            <!-- Slide counter -->
            <div
                class="absolute bottom-5 right-6 z-20 font-body text-[12px] tracking-[0.1em] text-white/90 mix-blend-difference md:bottom-7 md:right-10">
                <span id="slideCurrentNum">01</span>
                <span class="mx-1 opacity-50">/</span>
                <span id="slideTotalNum">04</span>
            </div>

            <!-- Pagination dots -->
            <div class="swiper-pagination !bottom-5"></div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════
       FACILITIES
  ═══════════════════════════════════════ -->
    <section class="bg-white px-5 py-16 text-[#1f1f1f] md:py-20 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
        <div class="mx-auto max-w-[900px]">
            <h2
                class="text-center font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2] reveal">
                FACILITIES
            </h2>

            <div class="mt-12 grid grid-cols-1 gap-x-16 gap-y-0 sm:grid-cols-2 reveal">
                <!-- Left column -->
                <ul class="border-b border-[#e0e0e0]">
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Welcome amenities</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Complimentary coffee &amp; tea service</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Bathrobe &amp; slippers</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">24
                        hour room service</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        In-room hair dryer &amp; straightener ghd ®</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Premium minibar</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Bluetooth speaker</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Bathroom amenities</li>
                </ul>

                <!-- Right column -->
                <ul class="border-b border-[#e0e0e0]">
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Smart TV</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Complimentary still water</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Yoga mats</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Electric kettle with tea products</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Pet friendly</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        High Speed Free Wi-Fi</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Laundry service</li>
                    <li class="facility-item flex items-center border-t border-[#e0e0e0] py-3 text-sm md:text-[15px]">
                        Steamer, iron &amp; ironing board</li>
                </ul>
            </div>

            <!-- Bottom divider -->
            <div class="mt-14 border-t border-[#d4d4d4]"></div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════
       FOOTER (identical to index)
  ═══════════════════════════════════════ -->
    <footer class="bg-black py-8 text-white md:py-10">
        <div class="mx-auto w-full px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24">

            <!-- Top Section -->
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

            <!-- Middle Section -->
            <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-[1.2fr_0.6fr_1.4fr]">

                <!-- Info -->
                <div>
                    <!-- <h3 class="font-serifDisplay text-2xl md:text-[34px]">HOTEL JINDAL</h3> -->
                    <p class="mt-4 text-sm text-white/90 md:text-[16px]">Fawwara Chowk, Neemuch (M.P.)</p>
                    <p class="mt-3 text-sm text-white/90 md:text-[16px]">
                        <a href=" tel:9111684157">Tel. +91 91116 84157</a>
                    </p>
                    <p class="mt-1 text-sm text-white/90 md:text-[16px]">
                        <a href=" mailto:info@hoteljindal.com">
                            info@hoteljindal.com</a>
                    </p>
                </div>

                <!-- Links -->
                <div class="text-sm md:text-[15px] space-y-2">

                    <!-- Reusable Link -->
                    <a href="{{ route('rooms') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Rooms</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('eatdrink') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Eat & Drink</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('experiences') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Experience</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('gallery') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Gallery</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('about') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">About</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('contact') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Contact</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                </div>

                <!-- CTA -->
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

            <!-- Bottom -->
            <div class="mt-8 flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                <div class="flex flex-wrap items-center gap-4 text-[11px] text-white/90 md:text-[15px]">
                    <a href="#" class="hover:underline">Cookies policy</a>
                    <a href="#" class="hover:underline">Privacy policy</a>
                    <a href="#" class="hover:underline">Terms of service</a>
                </div>

                <button id="backToTop"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-black transition hover:bg-[#ececec] p-3"
                    aria-label="Back to top">
                    <svg width="26" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.707 13L12.707 1L0.707031 13" stroke="black" stroke-width="3"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <div class="mt-4 border-t border-white/20"></div>

            <!-- Copyright -->
            <div
                class="mt-6 flex flex-col gap-3 text-[12px] text-white/90 md:flex-row md:items-center md:justify-between md:text-[14px]">
                <p>Hotel Jindal , &copy; 2026</p>
                <a href="https://www.volymoly.com/" class="inline-flex items-center gap-5">
                    <span>created by volymoly</span>
                    <img src="{{ asset('assets/svg/volymoly.svg') }}" alt="volymoly" class="h-auto w-[6rem] md:h-4" />
                </a>
            </div>

        </div>
    </footer>

    <!-- ═══════════════════════════════════════
       SCRIPTS
  ═══════════════════════════════════════ -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
        /* ── Nav: mobile menu toggle ── */
        const menuButton = document.getElementById("menuButton");
        const mobileMenu = document.getElementById("mobileMenu");
        menuButton.addEventListener("click", () => mobileMenu.classList.toggle("hidden"));

        /* ── Nav: rooms dropdown ── */
        const navBg = document.getElementById("navBg");
        const navShell = document.getElementById("navShell");
        const roomsToggle = document.getElementById("roomsToggle");
        const roomsMenu = document.getElementById("roomsMenu");

        const setRoomsNavTheme = (isOpen) => {
            navBg.classList.toggle("bg-[#f1f1f1]", isOpen);
            navShell.classList.toggle("text-black", isOpen);
            navShell.classList.toggle("text-white", !isOpen);
        };
        const openRoomsMenu = () => { roomsMenu.classList.remove("hidden"); roomsToggle.setAttribute("aria-expanded", "true"); setRoomsNavTheme(true); };
        const closeRoomsMenu = () => { roomsMenu.classList.add("hidden"); roomsToggle.setAttribute("aria-expanded", "false"); setRoomsNavTheme(false); };

        let roomsCloseTimer;
        const clearTimer = () => { if (roomsCloseTimer) { clearTimeout(roomsCloseTimer); roomsCloseTimer = null; } };
        const scheduleClose = () => { clearTimer(); roomsCloseTimer = setTimeout(closeRoomsMenu, 220); };

        roomsToggle.addEventListener("mouseenter", () => { clearTimer(); openRoomsMenu(); });
        roomsToggle.addEventListener("mouseleave", scheduleClose);
        roomsMenu.addEventListener("mouseenter", () => { clearTimer(); openRoomsMenu(); });
        roomsMenu.addEventListener("mouseleave", scheduleClose);
        document.addEventListener("click", closeRoomsMenu);
        document.addEventListener("keydown", (e) => { if (e.key === "Escape") closeRoomsMenu(); });

        /* ── Room image Swiper ── */
        const total = 4;
        const currentEl = document.getElementById("slideCurrentNum");
        const totalEl = document.getElementById("slideTotalNum");
        totalEl.textContent = String(total).padStart(2, "0");

        const roomSwiper = new Swiper(".room-swiper", {
            loop: true,
            speed: 700,
            navigation: {
                nextEl: "#roomNext",
                prevEl: "#roomPrev"
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            on: {
                slideChange() {
                    const real = ((this.realIndex) % total) + 1;
                    currentEl.textContent = String(real).padStart(2, "0");
                }
            }
        });

        /* ── Back to top ── */
        document.getElementById("backToTop").addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });

        /* ── Scroll reveal ── */
        const revealEls = document.querySelectorAll(".reveal");
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach((el) => observer.observe(el));
    </script>
@endsection
