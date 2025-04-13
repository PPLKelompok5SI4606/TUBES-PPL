<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $article->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-primary-green: #198754;
            --font-poppins: "Poppins", sans-serif;
        }

        @layer utilities {
            .font-poppins {
                font-family: var(--font-poppins);
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    {{-- Navbar --}}
    <nav class="w-full bg-primary-green mb-8">
        <div class="w-full max-w-7xl mx-auto flex flex-row justify-between items-center py-3">
            <div class="flex flex-row items-center gap-x-4">
                <a href="/" class="font-poppins text-white font-medium text-[20px]">Logo</a>
                <a href="" class="font-poppins text-white opacity-70 font-light text-[16px] hover:opacity-100">Get the App</a>
                <a href="/articles" class="font-poppins text-white font-light text-[16px] hover:opacity-100">Articles</a>
                <a href="" class="font-poppins text-white opacity-70 font-light text-[16px] hover:opacity-100">Features</a>
                <a href="" class="font-poppins text-white opacity-70 font-light text-[16px] hover:opacity-100">About</a>
            </div>
            <div class="flex flex-row items-center gap-x-2">
                @if (Auth::user())
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="flex flex-row gap-x-2 items-center hover:cursor-pointer">
                        <p class="font-poppins text-white">{{ Auth::user()->name }}</p>
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="font-poppins rounded-sm text-white font-medium text-[14px] py-2 px-3 border border-white hover:bg-white hover:text-black hover:duration-300">Sign In</a>
                    <a href="{{ route('register') }}" class="font-poppins rounded-sm text-black font-medium text-[14px] py-2 px-3 bg-white hover:opacity-80 hover:duration-300">Sign Up</a>
                @endif
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div class="max-w-4xl mx-auto px-4 py-8">
        {{-- Back Button --}}
        <a href="/articles" class="flex items-center text-gray-600 hover:text-primary-green mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-poppins text-sm">Back to Articles</span>
        </a>

        <div class="bg-white rounded-lg shadow-sm p-6">
            {{-- Title --}}
            <h1 class="font-poppins font-bold text-3xl text-gray-800 mb-4">{{ $article->title }}</h1>

            {{-- Metadata --}}
            <div class="flex items-center gap-4 mb-6 text-gray-500 text-sm">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="font-poppins">{{ $article->user->name }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-poppins">{{ $article->published_at->format('d M Y, H:i') }} WIB</span>
                </div>
            </div>

            {{-- Image --}}
            @if($article->image)
                <div class="w-full mb-6">
                    <img src="{{ asset('storage/' . $article->image) }}" 
                         alt="{{ $article->title }}" 
                         class="w-full rounded-lg">
                    <p class="text-sm text-gray-500 mt-2 italic">Foto: {{ $article->title }}</p>
                </div>
            @endif

            {{-- Content --}}
            <div class="prose max-w-none">
                <p class="font-poppins text-gray-700 text-base leading-7 whitespace-pre-line">
                    {{ $article->content }}
                </p>
            </div>


    {{-- Dropdown menu --}}
    @if (Auth::user())
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-35">
        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
            <li>
                <form method="POST" action="{{route('logout')}}" class="block px-4">
                    @csrf
                    <button type="submit" class="w-full py-2 hover:bg-gray-100">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
