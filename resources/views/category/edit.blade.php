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
                        class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                :value="old('name', $category->name)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Descripsi')" />
                            <textarea id="description" name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
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
