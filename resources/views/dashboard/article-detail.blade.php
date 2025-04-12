<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Article</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-border-gray: #eaecf4;
            --color-background-gray: #f8f9fc;
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
<body>
    <div class="w-full min-h-screen flex flex-row">
        {{-- LEFT SIDE --}}
        <div class="w-1/17 min-h-screen flex flex-col bg-primary-green items-center pt-6 gap-y-[12px]">
            <svg class="w-10" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                {{-- ... SVG content ... --}}
            </svg>
            <div class="border-b border-border-gray w-[70%]"></div>
            <a href="{{ route('admin.home') }}" class="flex flex-col items-center">
                <svg class="w-5" fill="#ffffff" viewBox="0 0 1920 1920">
                    {{-- ... SVG content ... --}}
                </svg>
                <p class="font-poppins text-white text-[10px]">Artikel</p>
            </a>
            <div class="border-b border-border-gray w-[70%]"></div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="w-16/17 min-h-screen flex flex-col bg-background-gray">
            {{-- Header --}}
            <div class="w-full py-6 px-10 bg-white flex flex-row justify-end items-center gap-x-5 mb-6 shadow-md">
                <div class="h-[100%] border-r-2 border-border-gray"></div>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="flex flex-row items-center gap-x-2 hover:cursor-pointer">
                    <p class="font-poppins text-[12px] text-gray-600">{{ Auth::user()->name }}</p>
                    <div class="flex flex-row items-center">
                        <img src="{{ asset('images/profile.svg') }}" alt="" class="w-8">
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </div>
                </button>
            </div>

            {{-- Content --}}
            <div class="px-10">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    {{-- Back Button --}}
                    <a href="{{ route('admin.home') }}" class="flex items-center text-gray-600 hover:text-primary-green mb-6">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="font-poppins">Back to List</span>
                    </a>

                    {{-- Article Image --}}
                    @if($article->image)
                        <div class="w-full h-96 mb-8">
                            <img src="{{ Storage::url($article->image) }}" 
                                 alt="Article Image" 
                                 class="w-full h-full object-cover rounded-lg">
                        </div>
                    @endif

                    {{-- Article Content --}}
                    <div class="max-w-3xl mx-auto">
                        <h1 class="font-poppins font-bold text-3xl text-gray-800 mb-4">{{ $article->title }}</h1>
                        
                        <div class="flex flex-wrap gap-4 mb-6 text-gray-600">
                            <p class="font-poppins text-sm">Author: {{ $article->user->name }}</p>
                            <p class="font-poppins text-sm">Status: {{ ucfirst($article->status) }}</p>
                            <p class="font-poppins text-sm">Created: {{ $article->created_at->format('d M Y') }}</p>
                            @if($article->published_at)
                                <p class="font-poppins text-sm">Published: {{ $article->published_at->format('d M Y') }}</p>
                            @endif
                        </div>

                        <div class="prose max-w-none">
                            <p class="font-poppins text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ $article->content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dropdown menu --}}
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-35">
        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
            <li>
                <a href="{{ route('auth.admin.logout') }}" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
            </li>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
