<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-gray-100">
                            {{ __('Daftar Category') }}
                        </h2>
                        <x-primary-button class="ms-2" x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'add-category-modal')">
                            Tambah</x-primary-button>
                    </div>
                    <x-search-form :homeRoute="route('category.index')" />
                    @if (session('success'))
                        <div class="callout callout-success">
                            <h5>Berhasil!</h5>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <x-table :headers="['Name', 'Description']">
                        @forelse ($categories as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('category.edit', ['category' => $item->id]) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    <button type="button"
                                        onclick="btnDelete('{{ csrf_token() }}','{{ route('category.destroy', ['id' => $item->id]) }}')"
                                        class="btn btn-danger btn-sm btn-delete">
                                        <i class="fas fa-trash">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data tersedia. silahkan <a
                                        x-data="" href=""
                                        x-on:click.prevent="$dispatch('open-modal', 'add-category-modal')">Tambah
                                        data.</a></td>
                            </tr>
                        @endforelse
                    </x-table>
                    <div class="pagination-container">
                        {{ $categories->appends(request()->input())->links() }}
                    </div>
                    <x-modal name="add-category-modal" maxWidth="xl">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            @method('post')
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Tambah Kategori') }}</h2>

                                <div class="mt-4">
                                    <x-input-label for="name" :value="__('Nama Kategori')" />
                                    <x-text-input id="name" name="name" class="mt-1 block w-3/4" required
                                        autofocus :value="old('name')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="description" :value="__('Descripsi')" />
                                    <textarea id="description" name="description" class="mt-1 block w-3/4">{{ old('description') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-end p-6 border-t border-gray-200 dark:border-gray-600">
                                <x-secondary-button x-on:click="$dispatch('close-modal', 'add-category-modal')">
                                    {{ __('Batal') }}
                                </x-secondary-button>

                                <x-primary-button class="ml-3"
                                    onclick="formAjaxPost('{{ route('category.store') }}','')">
                                    {{ __('Simpan') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
