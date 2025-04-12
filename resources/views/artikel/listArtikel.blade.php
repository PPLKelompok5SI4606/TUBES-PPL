<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Artikel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-primary-green: #198753;
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
    <div class="w-full min-h-screen">
        {{-- NAVBAR --}}
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

        <section id="title" class="w-full max-w-7xl mx-auto mb-8">
            <p class="font-poppins font-semibold text-black text-[32px] text-center">List Artikel</p>
        </section>
        
        <section id="content" class="w-full max-w-6xl mx-auto">
            <div class="grid grid-cols-3 gap-8">
                @forelse ( $articles as $article )
                    <button data-modal-target="detail-modal" data-modal-toggle="detail-modal" data-id="{{ $article->id }}" data-title="{{ $article->title }}" data-content="{{ $article->content }}" data-createdAt="{{ $article->created_at->format('d F Y') }}" data-image="{{ Storage::url($article->image) }}" data-publishedAt="{{ $article->created_at->format('d F Y') }}" class="detailButton flex flex-col text-start p-6 ring-gray-200 ring-3 rounded-xl gap-y-3 hover:ring-primary-green justify-between hover:cursor-pointer hover:scale-105 hover:duration-300">
                        <div class="flex flex-col gap-y-4 text-start">
                            <img src="{{ Storage::url($article->image) }}" alt="" class="w-full h-45 object-cover rounded-3xl">
                            <p class="font-bold font-poppins text-black text-[20px]">{{ $article->title }}</p>
                        </div>
                        <p class="font-light font-poppins text-gray-500 text-[16px]">{{ $article->created_at->format('d F Y') }}</p>
                    </button>
                @empty
                    <p>Tidak ada artikel</p>
                @endforelse
            </div>
        </section>
    </div>


    <div id="detail-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md lg:max-w-3xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                    <h3 class="text-lg font-poppins font-semibold text-black ">
                        Detail Artikel
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-black rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="detail-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="w-full p-4">
                    <img id="detailImage" src="" alt="" class="w-full max-h-80 object-cover rounded-2xl mb-8">
                    <p id="detailTitle" class="font-poppins font-bold text-black text-[24px] text-center mb-6">Judul</p>
                    <p id="detailContent" class="font-poppins text-black text-[14px] tracking-wider leading-8 mb-8">Content</p>
                    <div class="flex flex-row justify-between">
                        <p id="detailCreatedAt" class="font-poppins font-light text-black text-[12px]">Created at : </p>
                        <p id="detailPublishedAt" class="font-poppins font-light text-black text-[12px]">>Published at : </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-35">
        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
          <li>
            <form method="POST" action="{{route('logout')}}" class="block px-4">
                @csrf
                <button type="submit" class="w-full py-2 hover:bg-gray-100">Logout</a>
            </form>
          </li>
        </ul>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const detailButtons = document.querySelectorAll(".detailButton");

            detailButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const articleId = this.getAttribute("data-id");
                    const articleTitle = this.getAttribute("data-title");
                    const articleContent = this.getAttribute("data-content");
                    const articleImage = this.getAttribute("data-image");
                    const articleCreatedAt = this.getAttribute("data-createdAt");
                    const articlePublishedAt = this.getAttribute("data-publishedAt");

                    document.getElementById("detailTitle").textContent = articleTitle;
                    document.getElementById("detailContent").textContent = articleContent;
                    document.getElementById("detailImage").src = articleImage;
                    document.getElementById("detailCreatedAt").textContent = 'Created At : ' + articleCreatedAt;
                    document.getElementById("detailPublishedAt").textContent = 'Published At : ' + articlePublishedAt;
                })
            })

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>