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
        .room-swiper {
            overflow: hidden;
        }

        .room-swiper .swiper-slide {
            height: clamp(340px, 52vw, 540px);
        }

        .room-swiper .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ── Pagination lines (outside slider) ── */
        .room-pagination {
            position: relative !important;
            inset: auto !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            width: min(80%, 960px) !important;
            margin: 16px auto 0;
            transform: none !important;
        }

        /* Each line */
        .room-pagination .swiper-pagination-bullet {
            flex: 1;
            height: 2px;
            background: rgba(0, 0, 0, 0.25);
            border-radius: 2px;
            cursor: pointer;
            opacity: 1;
            margin: 0 !important;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        /* Active line */
        .room-pagination .swiper-pagination-bullet-active {
            background: #1f1f1f;
            transform: scaleY(1.5);
        }

        /* Slightly thicker on mobile for better touch */
        @media (max-width: 768px) {
            .room-pagination {
                margin-top: 14px;
                width: 86% !important;
            }

            .room-pagination .swiper-pagination-bullet {
                height: 3px;
            }
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
    </style>
@endsection

@section('content')
<!-- ═══════════════════════════════════════
       HEADER (identical to index)
  ═══════════════════════════════════════ -->
    @include('partials.public-header')

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
    <section class="relative bg-white overflow-hidden">

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

        </div>
        <div class="px-5 pb-1 md:px-10">
            <div class="swiper-pagination room-pagination"></div>
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
    @include('partials.public-footer')

    <!-- ═══════════════════════════════════════
       SCRIPTS
  ═══════════════════════════════════════ -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
        @include('partials.public-header-scripts')

        /* ── Room image Swiper ── */
        const total = document.querySelectorAll(".room-swiper .swiper-slide").length;
        const currentEl = document.getElementById("slideCurrentNum");
        const totalEl = document.getElementById("slideTotalNum");
        const formatSlideNumber = (number) => String(number).padStart(2, "0");

        totalEl.textContent = formatSlideNumber(total);

        const roomSwiper = new Swiper(".room-swiper", {
            loop: true,
            speed: 700,
            navigation: {
                nextEl: "#roomNext",
                prevEl: "#roomPrev"
            },
            pagination: {
                el: ".room-pagination",
                clickable: true
            },
            on: {
                slideChange() {
                    const real = ((this.realIndex) % total) + 1;
                    currentEl.textContent = formatSlideNumber(real);
                }
            }
        });

        /* ── Back to top ── */
        @include('partials.public-footer-scripts')

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
