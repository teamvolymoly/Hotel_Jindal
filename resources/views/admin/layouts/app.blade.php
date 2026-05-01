<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serifDisplay: ["42dot Sans", "sans-serif"],
                        body: ["42dot Sans", "sans-serif"],
                        number: ["42dot Sans", "sans-serif"]
                    },
                    colors: {
                        brand: {
                            50: '#f1f1f1',
                            100: '#e7e7e7',
                            500: '#3c3c3c',
                            600: '#2f2f2f',
                            700: '#1f1f1f',
                        },
                        shell: '#f1f1f1',
                        ink: '#1f1f1f',
                        muted: '#6f6a64',
                        line: '#d6d0c8',
                    },
                    boxShadow: {
                        panel: '0 18px 45px rgba(31, 31, 31, 0.08)',
                    }
                }
            }
        };
    </script>
    <style>
        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsanswght.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 300 800;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-light.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 300;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-regular.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 400;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-medium.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 500;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-bold.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 700;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-extrabold.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 800;
            font-display: swap;
        }

        body,
        button,
        input,
        select,
        textarea {
            font-family: "42dot Sans", sans-serif;
        }

        .admin-page {
            font-size: 14px;
        }

        .admin-page h1,
        .admin-page h2,
        .admin-page h3,
        .admin-page [data-stat] {
            font-family: "42dot Sans", sans-serif;
            letter-spacing: 0;
        }

        .admin-page h1 {
            font-size: 28px !important;
            font-weight: 500;
        }

        .admin-page h2 {
            font-size: 20px !important;
            font-weight: 500;
        }

        .admin-page h3 {
            font-size: 15px !important;
            font-weight: 600;
        }

        .admin-page p,
        .admin-page td,
        .admin-page label,
        .admin-page input,
        .admin-page select,
        .admin-page textarea,
        .admin-page button,
        .admin-page a {
            font-size: 14px;
        }

        .admin-page .shadow-panel {
            box-shadow: none;
        }

        .admin-page [class*="rounded"] {
            border-radius: 0 !important;
        }

        .admin-page [class*="border-line"] {
            border-color: #d8d3cc !important;
        }

        .admin-page [class*="border-black"],
        .admin-page [class*="border-gray"],
        .admin-page [class*="border-slate"],
        .admin-page [class*="border-neutral"] {
            border-color: #d8d3cc !important;
        }

        .admin-page [class*="bg-white"] {
            background-color: #f8f8f8 !important;
        }

        .admin-page [class*="bg-shell"],
        .admin-page thead {
            background-color: #e7e7e7 !important;
        }

        .admin-page table {
            width: 100%;
            border: 1px solid #d8d3cc;
            background: #f8f8f8;
            font-size: 13px;
        }

        .admin-page th {
            padding: 12px 14px !important;
            border-bottom: 1px solid #d8d3cc;
            color: #5f5a55;
            font-size: 11px !important;
            font-weight: 600;
            letter-spacing: 0.12em !important;
            white-space: nowrap;
        }

        .admin-page td {
            padding: 14px !important;
            border-bottom: 1px solid #ded9d2;
            vertical-align: middle;
        }

        .admin-page table tbody tr {
            transition: background-color 160ms ease;
        }

        .admin-page table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .admin-page input,
        .admin-page select,
        .admin-page textarea {
            width: 100%;
            border: 0 !important;
            border-bottom: 1px solid #c7c1b9 !important;
            background: transparent !important;
            padding: 12px 4px !important;
            color: #1f1f1f;
            outline: none;
            box-shadow: none !important;
            border-radius: 0 !important;
        }

        .admin-page select {
            padding-right: 36px !important;
            background-position: right 12px center !important;
        }

        .admin-page input:focus,
        .admin-page select:focus,
        .admin-page textarea:focus {
            border-bottom-color: #1f1f1f !important;
            box-shadow: none !important;
            --tw-ring-shadow: 0 0 #0000 !important;
        }

        .admin-page input[type="checkbox"] {
            width: 16px;
            height: 16px;
            padding: 0 !important;
            border: 1px solid #c7c1b9 !important;
            background: #f8f8f8 !important;
        }

        .admin-page input[type="hidden"] {
            display: none !important;
        }

        .admin-page input[type="file"] {
            border: 1px dashed #c7c1b9 !important;
            padding: 12px !important;
        }

        .admin-page button,
        .admin-page a {
            outline-color: #3c3c3c;
        }

        .admin-page .bg-brand-500,
        .admin-page .hover\:bg-brand-600:hover {
            background-color: #3c3c3c !important;
            color: #fff !important;
        }

        .admin-page .bg-brand-100,
        .admin-page .bg-brand-50 {
            background-color: #e7e7e7 !important;
        }

        .admin-page .text-brand-700,
        .admin-page .text-brand-600 {
            color: #1f1f1f !important;
        }

        .admin-page [data-stat] {
            font-size: 30px !important;
            line-height: 1.1;
            font-weight: 600;
        }

        .admin-page .text-muted {
            color: #67625d !important;
        }

    </style>
    @yield('head')
</head>
<body class="bg-[#f1f1f1] font-body text-ink antialiased">
    <div class="min-h-screen">
        <header class="relative overflow-visible bg-black text-white">
            <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(0,0,0,0.70)_0%,rgba(0,0,0,0.58)_54%,rgba(0,0,0,0.76)_100%),url('{{ asset('assets/bg/hero-bg.jpg') }}')] bg-cover bg-center"></div>
            <div class="relative z-10">
                <div class="mx-auto flex w-full items-center justify-between px-5 py-6 md:px-10 lg:px-16 xl:px-20 2xl:px-24 md:py-7">
                    <button id="adminMenuButton" type="button"
                        class="inline-flex items-center justify-center border border-white/40 px-2 py-1 text-xs uppercase tracking-[0.15em] transition hover:bg-white hover:text-black lg:hidden"
                        aria-label="Open admin menu" aria-expanded="false">
                        Menu
                    </button>

                    <nav class="hidden flex-1 items-start gap-6 pt-1 lg:flex xl:gap-8">
                        <a href="{{ route('admin.dashboard') }}" class="admin-top-link {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-white/75' }}">
                            Dashboard
                        </a>
                          <a href="{{ route('admin.contact-inquiries.index') }}" class="admin-top-link {{ request()->routeIs('admin.contact-inquiries.*') ? 'text-white' : 'text-white/75' }}">
                            Inquiries
                        </a>
                          <a href="{{ route('admin.menu-orders.index') }}" class="admin-top-link {{ request()->routeIs('admin.menu-orders.*') ? 'text-white' : 'text-white/75' }}">
                            Orders
                        </a>
                    
                       
                    </nav>

                    <a href="{{ route('admin.dashboard') }}"
                        class="shrink-0 px-2 text-center font-serifDisplay text-[31px] leading-[1] tracking-[0.03em] md:px-6 md:text-[34px] 2xl:text-[40px]">
                        <span class="block">HOTEL</span>
                        <span class="block">JINDAL</span>
                    </a>

                    <nav class="hidden flex-1 items-start justify-end gap-6 pt-1 lg:flex xl:gap-8">
                         <a href="{{ route('admin.menu-categories.index') }}" class="admin-top-link {{ request()->routeIs('admin.menu-categories.*') ? 'text-white' : 'text-white/75' }}">
                            Categories
                        </a>
                        <a href="{{ route('admin.menu-items.index') }}" class="admin-top-link {{ request()->routeIs('admin.menu-items.*') ? 'text-white' : 'text-white/75' }}">
                            Menu Items
                        </a>
                        <a href="{{ route('admin.blogs.index') }}"   class="admin-top-link {{ request()->routeIs('admin.blogs.*') ? 'text-white' : 'text-white/75' }}">
                            Blogs
                        </a>
                    </nav>

                    <div class="w-[56px] lg:hidden"></div>
                </div>

                <div id="adminMobileMenu" class="hidden border-t border-white/20 bg-black/60 backdrop-blur-sm lg:hidden">
                    <nav class="mx-auto grid w-full gap-4 px-5 py-5 text-center md:grid-cols-2 md:px-10">
                        <a href="{{ route('admin.dashboard') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Dashboard</a>
                        <a href="{{ route('admin.blogs.index') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Blogs</a>
                        <a href="{{ route('admin.menu-categories.index') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Categories</a>
                        <a href="{{ route('admin.menu-items.index') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Menu Items</a>
                        <a href="{{ route('admin.menu-orders.index') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Orders</a>
                        <a href="{{ route('admin.contact-inquiries.index') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Inquiries</a>
                        <a href="{{ route('admin.profile.index') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Profile</a>
                    </nav>
                </div>

                <section class="mx-auto w-full px-5 pb-10 pt-6 md:px-10 lg:px-16 xl:px-20 2xl:px-24 md:pb-12">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.22em] text-white/72">Admin Workspace</p>
                            <h1 class="mt-3 font-serifDisplay text-4xl font-normal leading-none md:text-5xl uppercase">
                                @yield('title', 'Admin Panel')
                            </h1>
                        </div>
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            {{-- <a href="{{ route('home') }}" class="inline-flex justify-center bg-white px-5 py-3 text-sm font-medium uppercase tracking-[0.04em] text-black transition hover:bg-[#ececec]">
                                View Website
                            </a> --}}
                            <div id="adminUserDropdown" class="relative">
                                <button id="adminUserDropdownButton" type="button" class="flex w-full items-center gap-3 border border-white/25 bg-white/10 px-4 py-3 text-left backdrop-blur transition hover:bg-white/15" aria-expanded="false" aria-haspopup="true">
                                    <div class="grid h-10 w-10 place-items-center rounded-full bg-white text-sm font-medium text-black">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div class="min-w-0 me-1">
                                        <p class="truncate text-sm font-medium leading-none">{{ auth()->user()->name ?? 'Admin' }}</p>
                                        <p class="mt-1 text-xs text-white/70">Admin</p>
                                    </div>
                                    <span class="ml-auto inline-flex text-white/70" aria-hidden="true">
                                        <svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.0942 0.625L6.35962 6.35962L0.625 0.625" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </button>

                                <div id="adminUserDropdownMenu" class="absolute right-0 top-[calc(100%+8px)] z-50 hidden w-48 border border-[#d8d3cc] bg-[#f1f1f1] py-2 text-[#1f1f1f] shadow-[0_16px_35px_rgba(0,0,0,0.16)]">
                                    <a href="{{ route('admin.profile.index') }}" class="block px-4 py-3 text-sm transition hover:bg-[#e7e7e7]">
                                        Profile
                                    </a>
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full px-4 py-3 text-left text-sm transition hover:bg-[#e7e7e7]">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </header>

        <main class="admin-page px-4 py-8 md:px-10 lg:px-16 xl:px-20 2xl:px-24 md:py-10">
            @if (session('status'))
                <div class="mb-6 border border-line bg-white px-4 py-4 text-[14px] text-ink shadow-panel md:px-5 md:text-[15px]">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <style>
        .admin-top-link {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            font-size: 12px;
            line-height: 1;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            transition: opacity 160ms ease, color 160ms ease;
        }

        .admin-top-link::after {
            content: "";
            margin-top: 8px;
            height: 10px;
            width: 10px;
            border: 1px solid currentColor;
            opacity: 0;
            transform: rotate(45deg);
            transition: opacity 160ms ease;
        }

        .admin-top-link:hover,
        .admin-top-link.text-white {
            opacity: 1;
        }

        .admin-top-link:hover::after,
        .admin-top-link.text-white::after {
            opacity: 1;
        }
    </style>

    <script>
        const adminMenuButton = document.getElementById('adminMenuButton');
        const adminMobileMenu = document.getElementById('adminMobileMenu');
        const adminUserDropdownButton = document.getElementById('adminUserDropdownButton');
        const adminUserDropdownMenu = document.getElementById('adminUserDropdownMenu');

        adminMenuButton?.addEventListener('click', () => {
            adminMobileMenu.classList.toggle('hidden');
            adminMenuButton.setAttribute('aria-expanded', adminMobileMenu.classList.contains('hidden') ? 'false' : 'true');
        });

        adminUserDropdownButton?.addEventListener('click', (event) => {
            event.stopPropagation();
            adminUserDropdownMenu.classList.toggle('hidden');
            adminUserDropdownButton.setAttribute('aria-expanded', adminUserDropdownMenu.classList.contains('hidden') ? 'false' : 'true');
        });

        document.addEventListener('click', (event) => {
            if (!adminUserDropdownMenu || !adminUserDropdownButton) {
                return;
            }

            if (!adminUserDropdownMenu.contains(event.target) && !adminUserDropdownButton.contains(event.target)) {
                adminUserDropdownMenu.classList.add('hidden');
                adminUserDropdownButton.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                adminUserDropdownMenu?.classList.add('hidden');
                adminUserDropdownButton?.setAttribute('aria-expanded', 'false');
            }
        });

        const adminOrdersLatestApiUrl = '{{ route('api.admin.menu-orders.latest') }}';
        const adminLastSeenOrderKey = 'hotel_jindal_admin_last_seen_order_id';
        const adminOrderPollIntervalMs = 3000;

        let orderToneContext = null;
        let orderTonePlaying = false;

        const playOrderNotificationTone = async () => {
            if (orderTonePlaying) {
                return;
            }

            try {
                const AudioContextClass = window.AudioContext || window.webkitAudioContext;

                if (!AudioContextClass) {
                    return;
                }

                orderToneContext ??= new AudioContextClass();

                if (orderToneContext.state === 'suspended') {
                    await orderToneContext.resume();
                }

                orderTonePlaying = true;

                const now = orderToneContext.currentTime;
                const gainNode = orderToneContext.createGain();
                gainNode.gain.setValueAtTime(0.0001, now);
                gainNode.gain.exponentialRampToValueAtTime(0.12, now + 0.05);
                gainNode.gain.exponentialRampToValueAtTime(0.0001, now + 3);
                gainNode.connect(orderToneContext.destination);

                const oscillatorA = orderToneContext.createOscillator();
                oscillatorA.type = 'sine';
                oscillatorA.frequency.setValueAtTime(784, now);
                oscillatorA.connect(gainNode);

                const oscillatorB = orderToneContext.createOscillator();
                oscillatorB.type = 'triangle';
                oscillatorB.frequency.setValueAtTime(1046, now);
                oscillatorB.connect(gainNode);

                oscillatorA.start(now);
                oscillatorB.start(now);
                oscillatorA.stop(now + 3);
                oscillatorB.stop(now + 3);

                setTimeout(() => {
                    orderTonePlaying = false;
                }, 3100);
            } catch (error) {
                orderTonePlaying = false;
            }
        };

        const pollLatestOrder = async () => {
            try {
                const response = await fetch(adminOrdersLatestApiUrl, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    return;
                }

                const payload = await response.json();
                const latestOrder = payload.data;

                if (!latestOrder?.id) {
                    return;
                }

                const lastSeenOrderId = Number(localStorage.getItem(adminLastSeenOrderKey) || 0);

                if (lastSeenOrderId === 0) {
                    localStorage.setItem(adminLastSeenOrderKey, String(latestOrder.id));
                    return;
                }

                if (Number(latestOrder.id) > lastSeenOrderId) {
                    localStorage.setItem(adminLastSeenOrderKey, String(latestOrder.id));
                    playOrderNotificationTone();
                    window.dispatchEvent(new CustomEvent('admin:new-order', {
                        detail: latestOrder
                    }));
                }
            } catch (error) {
            }
        };

        setInterval(pollLatestOrder, adminOrderPollIntervalMs);
        pollLatestOrder();
    </script>
</body>
</html>
