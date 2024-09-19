<section>

</section>
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <div class="max-7w-xl">
                    <header>
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('assets.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Tambah inventaris</li>
                        </ol>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Form Data Inventaris') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Isi data dengan teliti dan pastikan kembali!.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('assets.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Nama Barang')" />
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                :value="old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="category" :value="__('Kategori')" />
                            <x-text-input id="category" class="form-control" type="text" name="category"
                                :value="old('category')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>

                        <div>
                            <x-input-label for="purchase_date" :value="__('Tanggal Penerimaan')" />
                            <x-text-input id="purchase_date" class="form-control" type="date" name="purchase_date"
                                :value="old('purchase_date')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('purchase_date')" />
                        </div>

                        <div>
                            <x-input-label for="value" :value="__('Harga')" />
                            <x-text-input id="value" class="form-control" type="number" name="value"
                                :value="old('value')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>
                        <div>
                            <x-input-label for="amount" :value="__('Jumlah')" />
                            <x-text-input id="amount" class="form-control" type="number" name="amount"
                                :value="old('amount')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Lokasi')" />
                            <x-text-input id="location" class="form-control" type="text" name="location"
                                :value="old('location')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
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
