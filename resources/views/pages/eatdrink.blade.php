@extends('layouts.app')

@section('title', 'Eat & Drink - Hotel Jindal')
@section('body_class', 'bg-[#111] font-body text-white')

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
            src: url("{{ asset('assets/fonts/GildaDisplay-Regular.ttf') }}");
        }

        @font-face {
            font-family: "Raleway";
            src: url("{{ asset('assets/fonts/Raleway-VariableFont_wght.ttf') }}");
        }

        .hero-overlay {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.36) 0%, rgba(0, 0, 0, 0.48) 100%);
        }
    </style>
@endsection

@section('content')
<!-- ================= NAVBAR (EXACT SAME) ================= -->

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
                            class="text-[12px] 2xl:text-[14px]  uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Rooms
                            <span class="ml-1 inline-flex align-middle" aria-hidden="true">
                                <svg width="13" height="7" viewBox="0 0 13 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.0942 0.625L6.35962 6.35962L0.625 0.625" stroke="currentColor"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
                    </button>
                    <a href="{{ route('eatdrink') }}" class="group inline-flex flex-col items-center leading-none">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Eat
                            &amp; Drink</span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px]" aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                    fill="currentColor" />
                            </svg>
                        </span>
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
                    <a href="{{ route('about') }}" 
                        class="group inline-flex flex-col items-center leading-none">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">About</span>
                        <!-- <span class="mt-[6px] inline-flex h-[12px] w-[12px]" aria-hidden="true">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)" fill="currentColor" />
                </svg>
              </span> -->
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
                        <span
                            class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Deluxe</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
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
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Family</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
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
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Executive</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
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

    <!-- ================= HERO ================= -->

    <section class="relative min-h-screen flex items-center justify-center text-center">

        <img src="{{ asset('assets/bg/eat-drink.jpg') }}" class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 hero-overlay"></div>

        <div class="relative z-10 px-5 sm:mt-16">
            <h1
                class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                DINING, WINES,<br />COCKTAILS & FUN
            </h1>

            <a href="{{ route('menu') }}"
                class="mt-10 sm:mt-16 inline-flex items-center gap-3 text-[18px] bg-[#3c3c3c]/90 px-8 py-4 text-sm font-medium uppercase tracking-[0.08em] transition hover:bg-white hover:text-[#3c3c3c]">
                View Menu
            </a>
        </div>

    </section>

    <!-- ================= INTRO ================= -->

    <section class="bg-[#f1f1f1] text-[#1f1f1f] py-20 text-center px-5">
        <div class="max-w-[900px] mx-auto">

            <p class="text-xs uppercase tracking-[0.2em]">Home > Eat & Drink</p>

            <h2
                class="mt-6 font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                DINING, WINES,<br />COCKTAILS & FUN
            </h2>

            <p class="mt-6 text-[18px] text-[#444]">
                With curated dining experiences and expertly crafted dishes, Hotel Jindal offers a blend of modern
                luxury and timeless taste.
            </p>

            <a href="{{ route('menu') }}"
                class="mt-8 inline-flex bg-[#3c3c3c] text-[18px] text-white px-8 py-4 uppercase hover:bg-black transition">
                View Menu
            </a>

        </div>
    </section>

    <!-- ================= SLIDER ================= -->

    <section class="bg-[#f1f1f1] pb-20 relative">
        <div class="px-5 md:px-16 relative">

            <div class="swiper foodSwiper">
                <div class="swiper-wrapper">
                    <!-- slides here -->
                    <a href="{{ route('menu') }}" class="swiper-slide">
                        <div class="h-[460px] overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836"
                                class="w-full h-full object-cover" />
                        </div>
                        <h3 class="mt-4 text-[18px] font-serifDisplay text-black uppercase">Breakfast</h3>
                    </a>

                    <a href="{{ route('menu') }}" class="swiper-slide">
                        <div class="h-[460px] overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c"
                                class="w-full h-full object-cover" />
                        </div>
                        <h3 class="mt-4 text-[18px] font-serifDisplay text-black uppercase">Snacks</h3>
                    </a>

                    <a href="{{ route('menu') }}" class="swiper-slide">
                        <div class="h-[460px] overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1555992336-03a23c7b20ee"
                                class="w-full h-full object-cover" />
                        </div>
                        <h3 class="mt-4 text-[18px] font-serifDisplay text-black uppercase">Dinner</h3>
                    </a>

                    <a href="{{ route('menu') }}" class="swiper-slide">
                        <div class="h-[460px] overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1555992336-03a23c7b20ee"
                                class="w-full h-full object-cover" />
                        </div>
                        <h3 class="mt-4 text-[18px] font-serifDisplay text-black uppercase">Chinese</h3>
                    </a>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="absolute z-10 -bottom-16 right-5 md:right-16 flex gap-4">

                <div class="food-prev flex items-center justify-center w-12 h-12 cursor-pointer">
                    <svg class="w-8 h-4" viewBox="0 0 38 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38 7.70715L1 7.70715" stroke="black" stroke-width="2" stroke-linejoin="round" />
                        <path d="M8 14.7072L1 7.70715L8 0.707153" stroke="black" stroke-width="2"
                            stroke-linejoin="round" />
                    </svg>
                </div>

                <div class="food-next flex items-center justify-center w-12 h-12 cursor-pointer">
                    <svg class="w-8 h-4" viewBox="0 0 38 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 7.70715L37 7.70716" stroke="black" stroke-width="2" stroke-linejoin="round" />
                        <path d="M30 0.707153L37 7.70715L30 14.7072" stroke="black" stroke-width="2"
                            stroke-linejoin="round" />
                    </svg>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= IN ROOM DINING ================= -->

    <section class="bg-[#f1f1f1] text-[#1f1f1f] pb-20 pt-5 px-5">
        <h2
            class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2] text-center mb-12">
            HOTEL’S IN<br />ROOM DINING
        </h2>
        <div class="max-w-[1100px] mx-auto grid md:grid-cols-2 gap-16 items-center">

            <div class="relative">
                <img src="{{ asset('assets/rooms/family.png') }}" class="w-[85%]" />
                <img src="{{ asset('assets/bg/eat-drink.jpg') }}" class="absolute bottom-[-40px] right-0 w-[50%] shadow-lg" />
            </div>

            <div>


                <p class="mt-6 text-[#444] text-[18px]">
                    The ultimate expression of luxury. The Grand Suite comprises a bedroom, living room with L shaped
                    sofa-bed, custom cowhide armchair and working area, XL bathtub + rain shower. With outstanding views
                    to the gothic quarter, this sophisticated room can be connected to a double room transforming the
                    space into a five-adult or four adult and two children apartment. The perfect answer for guests
                    seeking a unique experience.
                </p>

                <a href="{{ route('menu') }}"
                    class="mt-6 inline-flex bg-[#3c3c3c] text-[18px] text-white px-8 py-4 uppercase hover:bg-black transition">
                    Explore Menu
                </a>
            </div>

        </div>
    </section>

    <!-- ================= CONTACT ================= -->

    <section class="bg-[#f1f1f1] text-[#1f1f1f] py-20 text-center">
        <h2
            class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2] uppercase">
            Contact</h2>
        <p class="mt-4">
            <a href="tel:+919111684157"> Tel. +91 91116 84157</a>
        </p>
        <p class="mt-2">
            <a href="mailto:info@hoteljindal.com">info@hoteljindal.com</a>
        </p>
    </section>

    <!-- ================= FOOTER ================= -->

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

    <!-- ================= JS ================= -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
        const menuButton = document.getElementById("menuButton");
        const mobileMenu = document.getElementById("mobileMenu");
        const navBg = document.getElementById("navBg");
        const navShell = document.getElementById("navShell");
        const roomsToggle = document.getElementById("roomsToggle");
        const roomsMenu = document.getElementById("roomsMenu");
        const backToTop = document.getElementById("backToTop");

        menuButton.addEventListener("click", () => {
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

        roomsToggle.addEventListener("mouseenter", () => {
            clearRoomsCloseTimer();
            openRoomsMenu();
        });

        roomsToggle.addEventListener("mouseleave", () => {
            scheduleRoomsClose();
        });

        roomsMenu.addEventListener("mouseenter", () => {
            clearRoomsCloseTimer();
            openRoomsMenu();
        });

        roomsMenu.addEventListener("mouseleave", () => {
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

        backToTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>

<script>
        new Swiper(".foodSwiper", {
            slidesPerView: 1.2,
            loop: true,
            spaceBetween: 20,
            navigation: {
                nextEl: ".food-next",
                prevEl: ".food-prev",
            },
            breakpoints: {
                768: { slidesPerView: 3.3 },
                1024: { slidesPerView: 3.3 }
            }
        });
    </script>
@endsection
