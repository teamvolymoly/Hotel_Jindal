@extends('layouts.app')

@section('title', 'Experiences - Hotel Jindal')
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
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0.55) 100%);
        }
    </style>
@endsection

@section('content')
<!-- ================= NAVBAR ================= -->
    @include('partials.public-header')

    <!-- ================= HERO ================= -->
    <main class="relative min-h-screen overflow-hidden text-white">
        <div
            class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(0,0,0,0.30)_0%,rgba(0,0,0,0.18)_40%,rgba(0,0,0,0.42)_100%),url('{{ asset('assets/rooms/deluxe.png') }}')] bg-cover bg-center bg-no-repeat">
        </div>

        <div
            class="relative z-10 flex min-h-screen flex-col items-center justify-center px-5 pb-14 pt-24 text-center sm:mt-16">
            <h1
                class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                EXPERIENCES
            </h1>
            <a href="{{ route('contact') }}"
                class="mt-10 sm:mt-16 inline-flex text-[18px] items-center gap-3 bg-[#3c3c3c]/90 px-8 py-4 text-sm font-medium uppercase tracking-[0.08em] transition hover:bg-white hover:text-[#3c3c3c]">
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

    <!-- ================= INTRO ================= -->
    <section class="bg-[#f1f1f1] text-[#1f1f1f] py-20 px-5 text-center">
        <div class="mx-auto max-w-[900px]">

            <p class="text-xs uppercase tracking-[0.15em] text-gray-500">
                Home &nbsp; &gt; &nbsp; Experiences
            </p>

            <h2
                class="mt-6 font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                MUST-SEE NEARBY<br />WONDERS
            </h2>

            <p class="mt-6 text-[16px] md:text-[18px] leading-[1.7] text-[#4a4a4a]">
                Nimach is more than just a city — it is an experience waiting to be discovered. From centuries-old
                temples and historic landmarks to breathtaking natural scenery, there is something here for every kind
                of traveler.
            </p>

        </div>
    </section>

    <!-- ================= CARDS GRID ================= -->
    <section class="bg-[#f1f1f1] pb-20 px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24 text-[#1f1f1f]">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            <!-- CARD -->
            <div>
                <img src="{{ asset('assets/places/new-img-pashupatinath-temple.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Pashupatinath Temple</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    Located by the banks of Shivna River, this unique temple depicts Lord Shiva in eight forms.
                </p>
                <a href="https://maps.app.goo.gl/Ex9qVdebMbAJmiWo7" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/buddhist caves.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Buddhist Caves</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    Dating back to the 5th century AD, these caves are a prominent historical attraction.
                </p>
                <a href="https://maps.app.goo.gl/BE9DbCfZuF2yXCGR7" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/Gandhisagar-Sanctuary.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Gandhisagar Sanctuary</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    Spread across vast land, a must-visit destination for nature lovers and wildlife enthusiasts.
                </p>
                <a href="https://maps.app.goo.gl/4NtbL7wbySHTy9Bv5" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/Mandsaur-Fort.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Mandsaur Fort</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    A historic fort reflecting the rich heritage of the region.
                </p>
                <a href="https://maps.app.goo.gl/4VXWRvdDiMJEV79E6" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/Neemuch-img-1.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Neemuch</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    A beautiful cantonment city known for scenic views and calm surroundings.
                </p>
                <a href="https://maps.app.goo.gl/GTbxJX4E5hjypkDj9" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/gandhisagar-dam.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Gandhisagar Dam</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    One of the largest dams offering scenic views and peaceful surroundings.
                </p>
                <a href="https://maps.app.goo.gl/MwQ831VVCTHFtbi86" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

        </div>

    </section>

    <!-- ================= FOOTER ================= -->
    @include('partials.public-footer')
@endsection

@section('scripts')
<script>
        @include('partials.public-header-scripts')
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

