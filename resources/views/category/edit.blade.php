<section>

</section>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <div class="max-7w-xl">
                    <header>
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Category Update</li>
                        </ol>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('From Data Category') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Isi data dengan teliti dan pastikan kembali!.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('category.update', ['category' => $category->id]) }}"
                        class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                :value="old('name', $category->name)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mt-6">
                            <x-input-label for="kk" :value="__('KK')" />
                            <input type="file" id="kk" name="kk" class="form-control" accept="image/*">
                            <br>
                            <small class="text-muted">max 2mb</small>
                            <x-input-error class="mt-2" :messages="$errors->get('kk')" />
                        </div>
                        <div>
                            <a class="ms-1" x-data="" href="#"
                                x-on:click.prevent="$dispatch('open-modal', 'view-ktp-modal')">
                                <img src="{{ Storage::url('dokumen_pendukung/' . $category->kk) }}"" class="img-fluid"
                                    alt="Foto KK" width="100" height="70">
                            </a>
                        </div>
                        <x-modal name="view-ktp-modal" maxWidth="md">
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Foto KK') }}
                                </h2>
                                <div class="mt-4">
                                    <img src="{{ Storage::url('dokumen_pendukung/' . $category->kk) }}""
                                        class="img-fluid" alt="Foto KK">
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-end p-6 border-t border-gray-200 dark:border-gray-600">
                                <x-secondary-button x-on:click="$dispatch('close-modal', 'view-ktp-modal')">
                                    {{ __('Tutup') }}
                                </x-secondary-button>
                            </div>
                        </x-modal>
                        <div class="flex items-center gap-4">
                            <x-secondary-button onclick="window.history.back()">
                                {{ __('Kembali') }}
                            </x-secondary-button>
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
