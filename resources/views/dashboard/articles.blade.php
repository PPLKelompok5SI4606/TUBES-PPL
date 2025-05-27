
@extends('dashboard.main')

@section('content')
<p class="font-poppins font-medium text-gray-800 text-[28px] ms-10 mb-6">Artikel</p>

<div class="px-10 w-full flex flex-row justify-between mb-6 items-center">
    <p class="font-poppins font-medium text-gray-800 text-[22px]">List Articles</p>
    <button data-modal-target="tambah-modal" data-modal-toggle="tambah-modal"
        class="flex items-center justify-center bg-primary-green px-12 py-3 font-poppins text-white font-medium text-[14px] rounded-md hover:cursor-pointer hover:opacity-90 hover:scale-105 hover:duration-300">Tambah
        Data</button>
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
                            <img src="{{ Storage::url($article->image) }}" alt="Article Image"
                                class="w-full h-full object-cover rounded-lg shadow-sm">
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
                            <div id="short-content-{{ $article->id }}">
                                {{ Str::limit($article->content, 50) }}
                                <button onclick="toggleContent({{ $article->id }})"
                                    class="text-primary-green hover:underline text-sm mt-1">
                                    Read More
                                </button>
                            </div>
                            <div id="full-content-{{ $article->id }}" class="hidden">
                                {{ $article->content }}
                                <button onclick="toggleContent({{ $article->id }})"
                                    class="text-primary-green hover:underline text-sm mt-1">
                                    Show Less
                                </button>
                            </div>
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
                            <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                class="font-medium text-blue-600 hover:underline hover:cursor-pointer editButton"
                                data-id="{{ $article->id }}" data-title="{{ $article->title }}"
                                data-content="{{ $article->content }}"
                                data-status="{{ $article->status }}">Edit</button>
                            <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                class="font-medium text-red-600 hover:underline deleteButton hover:cursor-pointer"
                                data-id="{{ $article->id }}">Delete</button>
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

<!-- Tambah modal -->
<div id="tambah-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md lg:max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                <h3 class="text-lg font-poppins font-semibold text-black ">
                    Tambah Artikel
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-black rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                    data-modal-toggle="tambah-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4" action="/articles" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium font-poppins text-black ">Judul
                            Artikel</label>
                        <input type="text" name="title" id="title"
                            class="bg-gray-50 border border-gray-300 text-black font-poppins text-sm rounded-lg block w-full p-2.5 focus:ring-2 focus:outline-none focus:ring-primary-green focus:border-primary-green"
                            placeholder="Masukkan judul artikel" required="">
                    </div>
                    <div class="col-span-2 lg:col-span-1">
                        <label for="status" class="block mb-2 text-sm font-medium text-black font-poppins">Status
                            Artikel</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-black text-sm font-poppins rounded-lg focus:ring-primary-green focus:border-primary-green focus:outline-none block w-full p-2.5"
                            required>
                            <option selected="">Pilih Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="col-span-2 lg:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-black font-poppins" for="file_input">Upload
                            Gambar </label>
                        <input
                            class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 font-poppins focus:outline-none"
                            aria-describedby="file_input_help" name="image" id="file_input" type="file" required>
                        <p class="mt-1 text-sm text-black font-poppins" id="file_input_help">PNG, JPG or JPEG (Max 10
                            MB).</p>
                    </div>
                    <div class="col-span-2">
                        <label for="content" class="block mb-2 text-sm font-medium text-black font-poppins ">Konten
                            Artikel</label>
                        <textarea id="content" name="content" rows="10"
                            class="block p-2.5 w-full text-sm text-black font-poppins  bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:outline-none focus:ring-primary-green focus:border-primary-green"
                            placeholder="Konten artikel..." required=""></textarea>
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-primary-green hover:scale-105 hover:duration-300 focus:ring-2 focus:outline-none focus:ring-primary-green font-medium font-poppins rounded-lg text-sm px-5 py-2.5 text-center hover:cursor-pointer">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah Artikel
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Edit modal -->
<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md lg:max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                <h3 class="text-lg font-poppins font-semibold text-black ">
                    Edit Artikel
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-black rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                    data-modal-toggle="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                        <label for="editTitle" class="block mb-2 text-sm font-medium font-poppins text-black ">Judul
                            Artikel</label>
                        <input type="text" name="editTitle" id="editTitle"
                            class="bg-gray-50 border border-gray-300 text-black font-poppins text-sm rounded-lg block w-full p-2.5 focus:ring-2 focus:outline-none focus:ring-primary-green focus:border-primary-green"
                            placeholder="Masukkan judul artikel" required="">
                    </div>
                    <div class="col-span-2 lg:col-span-1">
                        <label for="editStatus" class="block mb-2 text-sm font-medium text-black font-poppins">Status
                            Artikel</label>
                        <select id="editStatus" name="editStatus"
                            class="bg-gray-50 border border-gray-300 text-black text-sm font-poppins rounded-lg focus:ring-primary-green focus:border-primary-green focus:outline-none block w-full p-2.5"
                            required>
                            <option selected="">Pilih Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="col-span-2 lg:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-black font-poppins" for="file_input">Upload
                            Gambar Makanan</label>
                        <input
                            class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 font-poppins focus:outline-none"
                            aria-describedby="file_input_help" name="image" id="file_input" type="file">
                        <p class="mt-1 text-sm text-black font-poppins" id="file_input_help">PNG, JPG or JPEG (Max 10
                            MB).</p>
                    </div>
                    <div class="col-span-2">
                        <label for="editContent" class="block mb-2 text-sm font-medium text-black font-poppins ">Konten
                            Artikel</label>
                        <textarea id="editContent" name="editContent" rows="10"
                            class="block p-2.5 w-full text-sm text-black font-poppins  bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:outline-none focus:ring-primary-green focus:border-primary-green"
                            placeholder="Konten artikel..." required=""></textarea>
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-primary-green hover:scale-105 hover:duration-300 focus:ring-2 focus:outline-none focus:ring-primary-green font-medium font-poppins rounded-lg text-sm px-5 py-2.5 text-center hover:cursor-pointer">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Update Artikel
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Delete modal --}}
<div id="delete-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                data-modal-hide="delete-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 font-poppins">Apakah anda yakin ingin menghapus?</h3>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button data-modal-hide="delete-modal" type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Ya
                    </button>
                    <button data-modal-hide="delete-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Tidak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".editButton");

        editButtons.forEach(button => {
            button.addEventListener("click", function() {
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

    document.addEventListener("DOMContentLoaded", function() {

        const deleteButtons = document.querySelectorAll(".deleteButton");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                const articleId = this.getAttribute("data-id");

                document.getElementById("deleteForm").action = "/articles/" + articleId;
            });
        });
    });

    function toggleContent(id) {
        const shortContent = document.getElementById(`short-content-${id}`);
        const fullContent = document.getElementById(`full-content-${id}`);

        if (shortContent.classList.contains('hidden')) {
            // Show short content
            shortContent.classList.remove('hidden');
            fullContent.classList.add('hidden');
        } else {
            // Show full content
            shortContent.classList.add('hidden');
            fullContent.classList.remove('hidden');
        }
    }
</script>
@endsection