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

    @include('partials.public-header')

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

    @include('partials.public-footer')

    <!-- ================= JS ================= -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
        @include('partials.public-header-scripts')
        @include('partials.public-footer-scripts')
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

