<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serifDisplay: ["Gilda Display", "serif"],
                        body: ["Raleway", "sans-serif"]
                    },
                    colors: {
                        brand: {
                            50: '#f1f1f1',
                            100: '#e7e7e7',
                            500: '#3c3c3c',
                            600: '#2f2f2f',
                        },
                        shell: '#f1f1f1',
                        ink: '#1f1f1f',
                        muted: '#6f6a64',
                        line: '#d6d0c8',
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
    </style>
</head>
<body class="min-h-screen bg-black font-body text-white antialiased">
    <main class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(0,0,0,0.46)_0%,rgba(0,0,0,0.38)_45%,rgba(0,0,0,0.72)_100%),url('{{ asset('assets/bg/hero-bg.jpg') }}')] bg-cover bg-center"></div>

        <div class="relative z-10 flex min-h-screen flex-col">
            <header class="mx-auto flex w-full items-center justify-center px-5 py-7 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
                <a href="{{ route('home') }}" class="text-center font-serifDisplay text-[31px] leading-[1] tracking-[0.03em] md:text-[32px]">
                    <span class="block">HOTEL</span>
                    <span class="block">JINDAL</span>
                </a>
            </header>

            <section class="flex flex-1 items-center justify-center px-5 pb-12 pt-6">
                <div class="w-full max-w-md border border-gray-500 bg-black/42 p-7 shadow-2xl shadow-black/20 backdrop-blur-md md:p-8">
                    <p class="text-xs uppercase tracking-[0.28em] text-white/72">Admin Login</p>
                    <h1 class="mt-4 font-serifDisplay text-4xl font-normal leading-none md:text-5xl">Welcome back</h1>
                    <p class="mt-4 text-sm leading-6 text-white/78">Use your admin credentials to continue.</p>

                    <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-white/90">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                   class="w-full border border-white/24 bg-white/92 px-4 py-3.5 text-black outline-none transition focus:border-white focus:ring-2 focus:ring-white/30">
                            @error('email')
                                <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-white/90">Password</label>
                            <input id="password" name="password" type="password"
                                   class="w-full border border-white/24 bg-white/92 px-4 py-3.5 text-black outline-none transition focus:border-white focus:ring-2 focus:ring-white/30">
                            @error('password')
                                <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex items-center gap-3 text-sm text-white/75">
                            <input type="checkbox" name="remember" class="h-4 w-4 border-white/40 bg-transparent text-brand-500 focus:ring-white/30">
                            Keep me signed in
                        </label>

                        <button type="submit" class="w-full bg-white px-5 py-4 text-base font-semibold uppercase tracking-[0.04em] text-black transition hover:bg-[#ececec]">
                            Sign In
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
