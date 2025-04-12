<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
            <svg class="w-10" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>recycle</title> <g id="Layer_2" data-name="Layer 2"> <g id="invisible_box" data-name="invisible box"> <rect width="48" height="48" fill="none"></rect> </g> <g id="Q3_icons" data-name="Q3 icons"> <g> <path d="M45.4,33l-3.9-6.2A2,2,0,1,0,38.1,29L42,35.2H25.5l2.4-2.5a2.1,2.1,0,0,0-.1-2.9A2,2,0,0,0,25,30l-5.6,5.8a2.1,2.1,0,0,0,0,2.8l5.7,5.8a1.9,1.9,0,0,0,2.8,0,1.9,1.9,0,0,0,0-2.8l-2.2-2.3H42a3.9,3.9,0,0,0,3.5-2.1A4.2,4.2,0,0,0,45.4,33Z"></path> <path d="M19.8,14.6l4.1-7.5,7.6,11.8-3.2-.7a2.1,2.1,0,0,0-2.4,1.6,1.9,1.9,0,0,0,1.5,2.3l7.8,1.7h.4a2,2,0,0,0,1.1-.3,2,2,0,0,0,.8-1.3l1.7-8a2.1,2.1,0,0,0-1.6-2.4,2.1,2.1,0,0,0-2.4,1.6l-.6,3L27.3,4.9A3.9,3.9,0,0,0,24,3a4.2,4.2,0,0,0-3.4,1.8h0l-4.3,7.8a2,2,0,0,0,3.5,1.9Z"></path> <path d="M16.3,19.8a1.8,1.8,0,0,0-.9-1.3,1.9,1.9,0,0,0-1.5-.3L6.1,19.7a2.1,2.1,0,0,0-1.5,2.4,1.9,1.9,0,0,0,2.3,1.5l2.6-.5L2.7,32.9a4.2,4.2,0,0,0-.2,4.3A3.9,3.9,0,0,0,6,39.3h7.1a2,2,0,1,0,0-4H6l7.2-10.3.6,3.7a2,2,0,0,0,2,1.6h.4a2.1,2.1,0,0,0,1.6-2.4Z"></path> </g> </g> </g> </g></svg>
            <div class="border-b border-border-gray w-[70%]"></div>
            <div class="flex flex-col items-center">
                <svg class="w-5" fill="#ffffff" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M960 282c529.355 0 960 430.758 960 960 0 77.139-8.922 153.148-26.541 225.882l-10.504 43.144h-560.188c-27.106 74.88-79.85 140.838-155.52 181.045-47.887 25.185-101.647 38.625-155.633 38.625-123.445 0-236.047-67.651-293.76-176.64-5.873-11.18-11.859-25.75-17.845-43.03H37.045l-10.504-43.144C8.922 1395.148 0 1319.14 0 1242c0-529.242 430.645-960 960-960Zm168.17 1229.026c47.66-49.355 61.214-125.139 27.331-189.064-42.24-79.51-403.765-413.59-403.765-413.59s73.638 486.776 115.765 566.287c7.341 13.892 16.941 25.525 27.219 36.367h-.904c2.033 2.146 4.518 3.614 6.551 5.534 4.63 4.405 9.374 8.47 14.344 12.198 3.727 2.823 7.68 5.308 11.52 7.68 5.195 3.162 10.39 6.098 15.924 8.81 4.292 1.92 8.584 3.726 13.101 5.42 5.422 1.92 10.956 3.727 16.716 5.083a159.91 159.91 0 0 0 14.23 3.049c5.76.904 11.407 1.468 17.167 1.694 2.824.113 5.535.79 8.245.79 1.92 0 3.84-.677 5.76-.677 8.245-.226 16.377-1.355 24.508-2.936 3.727-.791 7.567-1.13 11.294-2.146 11.746-3.163 23.266-7.229 34.335-13.214h.338v-.113c15.7-8.245 28.687-19.2 40.32-31.172Zm361.524-625.807 112.715-112.715-119.717-119.831-112.828 112.715 119.83 119.83Zm-614.4-254.457h169.412V471.29H875.294v159.473ZM430.306 885.22l119.83-119.83-112.715-112.716-119.83 119.83L430.306 885.22Z" fill-rule="evenodd"></path> </g></svg>
                <p class="font-poppins text-white text-[10px]">Artikel</p>
            </div>
            <div class="border-b border-border-gray w-[70%]"></div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="w-16/17 min-h-screen flex flex-col bg-background-gray">
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

            <p class="font-poppins font-medium text-gray-800 text-[28px] ms-10 mb-6">Artikel</p>

            <div class="px-10 w-full flex flex-row gap-x-8 mb-6">
                <div class="border-s-4 border-s-primary-green px-6 flex flex-row py-8 w-full justify-between shadow-md bg-white rounded-md">
                    <div class="flex flex-col">
                        <p class="font-poppins font-medium text-primary-green text-[18px]">Jumlah Pengguna</p>
                        <p class="font-poppins font-light text-black text-[16px]">{{ $userCount }}</p>
                    </div>
                    <svg class="w-10" xmlns="http://www.w3.org/2000/svg" fill="#198754" viewBox="0 0 24 24"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></g></svg>
                </div>

                <div class="border-s-4 border-s-primary-green px-6 flex flex-row py-8 w-full justify-between shadow-md bg-white rounded-md">
                    <div class="flex flex-col">
                        <p class="font-poppins font-medium text-primary-green text-[18px]">Jumlah Admin</p>
                        <p class="font-poppins font-light text-black text-[16px]">{{ $adminCount }}</p>
                    </div>
                    <svg class="w-10" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#198754"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="none" d="M0 0h24v24H0z"></path> <path d="M12 14v8H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm9 4h1v5h-8v-5h1v-1a3 3 0 0 1 6 0v1zm-2 0v-1a1 1 0 0 0-2 0v1h2z"></path> </g> </g></svg>
                </div>

                <div class="border-s-4 border-s-primary-green px-6 flex flex-row py-8 w-full justify-between shadow-md bg-white rounded-md">
                    <div class="flex flex-col">
                        <p class="font-poppins font-medium text-primary-green text-[18px]">Jumlah Artikel Terpublish</p>
                        <p class="font-poppins font-light text-black text-[16px]">{{ $publishedArticles }}</p>
                    </div>
                    <svg class="w-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.272 3.365C5 3.9 5 4.6 5 6v12c0 1.4 0 2.1.272 2.635a2.5 2.5 0 0 0 1.093 1.092C6.9 22 7.6 22 9 22h6c1.4 0 2.1 0 2.635-.273a2.5 2.5 0 0 0 1.092-1.092C19 20.1 19 19.4 19 18V9.988c0-.734 0-1.1-.083-1.446a3 3 0 0 0-.36-.867c-.185-.303-.444-.562-.963-1.08l-3.188-3.19c-.519-.518-.778-.777-1.081-.963a3.001 3.001 0 0 0-.867-.36C12.112 2 11.745 2 11.012 2H9c-1.4 0-2.1 0-2.635.272a2.5 2.5 0 0 0-1.093 1.093zM11 9V4.82a.821.821 0 0 1 1.377-.604l4.386 4.386a.819.819 0 0 1-.58 1.398H12a1 1 0 0 1-1-1z" fill="#198754"></path></g></svg>
                </div>

                <div class="border-s-4 border-s-primary-green px-6 flex flex-row py-8 w-full justify-between shadow-md bg-white rounded-md">
                    <div class="flex flex-col">
                        <p class="font-poppins font-medium text-primary-green text-[18px]">Jumlah Artikel Draft</p>
                        <p class="font-poppins font-light text-black text-[16px]">{{ $unpublishedArticles }}</p>
                    </div>
                    <svg class="w-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.5 7V13C20.5 16.7712 20.5 18.6569 19.3284 19.8284C18.1569 21 16.2712 21 12.5 21H11.5M3.5 7V13C3.5 16.7712 3.5 18.6569 4.67157 19.8284C5.37634 20.5332 6.3395 20.814 7.81608 20.9259" stroke="#198754" stroke-width="1.5" stroke-linecap="round"></path> <path d="M12 3H4C3.05719 3 2.58579 3 2.29289 3.29289C2 3.58579 2 4.05719 2 5C2 5.94281 2 6.41421 2.29289 6.70711C2.58579 7 3.05719 7 4 7H20C20.9428 7 21.4142 7 21.7071 6.70711C22 6.41421 22 5.94281 22 5C22 4.05719 22 3.58579 21.7071 3.29289C21.4142 3 20.9428 3 20 3H16" stroke="#198754" stroke-width="1.5" stroke-linecap="round"></path> <path d="M12 7L12 16M12 16L15 12.6667M12 16L9 12.6667" stroke="#198754" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </div>
            </div>

            <div class="px-10 w-full flex flex-row justify-between mb-6 items-center">
                <p class="font-poppins font-medium text-gray-800 text-[22px]">List Articles</p>
                <button data-modal-target="tambah-modal" data-modal-toggle="tambah-modal"  class="flex items-center justify-center bg-primary-green px-12 py-3 font-poppins text-white font-medium text-[14px] rounded-md hover:cursor-pointer hover:opacity-90 hover:scale-105 hover:duration-300">Tambah Data</button>
            </div>

            <div class="px-10 w-full">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-white uppercase bg-primary-green">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Gambar
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Judul
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Konten
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Penulis
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Publish
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Buat
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $articles as $article )
                            <tr class="bg-white border-b  border-gray-200 hover:bg-gray-50 ">
                                <td class="px-6 py-4 w-48">
                                    @if($article->image)
                                        <div class="w-full h-32">
                                            <img 
                                                src="{{ Storage::url($article->image) }}" 
                                                alt="Article Image" 
                                                class="w-full h-full object-cover rounded-lg shadow-sm"
                                            >
                                        </div>
                                    @else
                                        <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-500 text-xs">No Image</span>
                                        </div>
                                    @endif
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                    <div class="max-w-[200px]">
                                        {{ $article->title }}
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <div class="truncate">
                                            {{ Str::limit($article->content, 50) }}
                                        </div>
                                        <a href="{{ route('articles.show', ['id' => $article->id]) }}" 
                                           class="text-primary-green hover:underline text-sm mt-1 inline-block">
                                            Read More
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $article->status }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $article->user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($article->published_at == null)
                                        Belum Publish
                                    @else
                                        {{ $article->published_at->format('d M Y') }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $article->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 justify-center items-center">
                                    <div class="flex flex-row gap-x-3">
                                        <button data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="font-medium text-blue-600 hover:underline hover:cursor-pointer editButton" data-id="{{ $article->id }}" data-title="{{ $article->title }}" data-content="{{ $article->content }}" data-status="{{ $article->status }}">Edit</button>
                                        <button data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="font-medium text-red-600 hover:underline deleteButton hover:cursor-pointer" data-id="{{ $article->id }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Tidak Ada Data
                                </th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah modal -->
    <div id="tambah-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md lg:max-w-3xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                    <h3 class="text-lg font-poppins font-semibold text-black ">
                        Tambah Artikel
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-black rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="tambah-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4" action="/articles" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium font-poppins text-black ">Judul Artikel</label>
                            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-black font-poppins text-sm rounded-lg block w-full p-2.5 focus:ring-2 focus:outline-none focus:ring-primary-green focus:border-primary-green" placeholder="Masukkan judul artikel" required="">
                        </div>
                        <div class="col-span-2 lg:col-span-1">
                            <label for="status" class="block mb-2 text-sm font-medium text-black font-poppins">Status Artikel</label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-black text-sm font-poppins rounded-lg focus:ring-primary-green focus:border-primary-green focus:outline-none block w-full p-2.5" required>
                                <option selected="">Pilih Status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="col-span-2 lg:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-black font-poppins" for="file_input">Upload Gambar </label>
                            <input class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 font-poppins focus:outline-none" aria-describedby="file_input_help" name="image" id="file_input" type="file" required>
                            <p class="mt-1 text-sm text-black font-poppins" id="file_input_help">PNG, JPG or JPEG (Max 10 MB).</p>
                        </div>
                        <div class="col-span-2">
                            <label for="content" class="block mb-2 text-sm font-medium text-black font-poppins ">Konten Artikel</label>
                            <textarea id="content" name="content" rows="10" class="block p-2.5 w-full text-sm text-black font-poppins  bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:outline-none focus:ring-primary-green focus:border-primary-green" placeholder="Konten artikel..." required=""></textarea>         
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-primary-green hover:scale-105 hover:duration-300 focus:ring-2 focus:outline-none focus:ring-primary-green font-medium font-poppins rounded-lg text-sm px-5 py-2.5 text-center hover:cursor-pointer">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Tambah Artikel
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md lg:max-w-3xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                    <h3 class="text-lg font-poppins font-semibold text-black ">
                        Edit Artikel
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-black rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="edit-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="editForm" class="p-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="editTitle" class="block mb-2 text-sm font-medium font-poppins text-black ">Judul Artikel</label>
                            <input type="text" name="editTitle" id="editTitle" class="bg-gray-50 border border-gray-300 text-black font-poppins text-sm rounded-lg block w-full p-2.5 focus:ring-2 focus:outline-none focus:ring-primary-green focus:border-primary-green" placeholder="Masukkan judul artikel" required="">
                        </div>
                        <div class="col-span-2 lg:col-span-1">
                            <label for="editStatus" class="block mb-2 text-sm font-medium text-black font-poppins">Status Artikel</label>
                            <select id="editStatus" name="editStatus" class="bg-gray-50 border border-gray-300 text-black text-sm font-poppins rounded-lg focus:ring-primary-green focus:border-primary-green focus:outline-none block w-full p-2.5" required>
                                <option selected="">Pilih Status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="col-span-2 lg:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-black font-poppins" for="file_input">Upload Gambar Makanan</label>
                            <input class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 font-poppins focus:outline-none" aria-describedby="file_input_help" name="image" id="file_input" type="file">
                            <p class="mt-1 text-sm text-black font-poppins" id="file_input_help">PNG, JPG or JPEG (Max 10 MB).</p>
                        </div>
                        <div class="col-span-2">
                            <label for="editContent" class="block mb-2 text-sm font-medium text-black font-poppins ">Konten Artikel</label>
                            <textarea id="editContent" name="editContent" rows="10" class="block p-2.5 w-full text-sm text-black font-poppins  bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:outline-none focus:ring-primary-green focus:border-primary-green" placeholder="Konten artikel..." required=""></textarea>         
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-primary-green hover:scale-105 hover:duration-300 focus:ring-2 focus:outline-none focus:ring-primary-green font-medium font-poppins rounded-lg text-sm px-5 py-2.5 text-center hover:cursor-pointer">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Update Artikel
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete modal --}}
    <div id="delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 font-poppins">Apakah anda yakin ingin menghapus?</h3>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="delete-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Ya
                        </button>
                        <button data-modal-hide="delete-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Tidak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Dropdown menu -->
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-35">
        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
          <li>
            <a href="{{ route('auth.admin.logout') }}" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
          </li>
        </ul>
    </div>
    



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".editButton");

            editButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const articleId = this.getAttribute("data-id");
                    const articleTitle = this.getAttribute("data-title");
                    const articleContent = this.getAttribute("data-content");
                    const articleStatus = this.getAttribute("data-status");

                    console.log(articleId, articleTitle, articleContent, articleStatus);

                    document.getElementById("editTitle").value = articleTitle;
                    document.getElementById("editContent").value = articleContent;
                    document.getElementById("editStatus").value = articleStatus;

                    const editForm = document.getElementById("editForm");
                    editForm.action = "/articles/" + articleId;
                })
            })

        });

        document.addEventListener("DOMContentLoaded", function () {

            const deleteButtons = document.querySelectorAll(".deleteButton");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const articleId = this.getAttribute("data-id");

                    document.getElementById("deleteForm").action = "/articles/" + articleId;
                });
            });
        });

        function toggleContent(id) {
            const contentContainer = document.getElementById(`content-${id}`);
            const fullContent = document.getElementById(`full-content-${id}`);
            const button = contentContainer.nextElementSibling;

            if (fullContent.classList.contains('hidden')) {
                contentContainer.classList.add('hidden');
                fullContent.classList.remove('hidden');
                button.textContent = 'Show Less';
            } else {
                contentContainer.classList.remove('hidden');
                fullContent.classList.add('hidden');
                button.textContent = 'Read More';
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>