<section>

</section>
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <div class="max-7w-xl">
                    <header>
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('posyandu.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Data Posyandu</li>
                        </ol>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Form Data Posyandu') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Isi data dengan teliti dan pastikan kembali!.') }}
                        </p>
                    </header>
                    <form method="post" action="{{ route('posyandu.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input id="nama" class="form-control" type="text" name="nama"
                                :value="old('nama')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <div>
                            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                            <select id="jenis_kelamin" class="form-control" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                        </div>

                        <div>
                            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                            <x-text-input id="tanggal_lahir" class="form-control" type="date" name="tanggal_lahir"
                                :value="old('tanggal_lahir')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                        </div>

                        <div>
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <select id="kategori" class="form-control" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($category as $key => $value)
                                    <option value="{{ $key }}" {{ old('kategori') == $key ? 'selected' : '' }}>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                        </div>
                        <div>
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <x-text-input id="alamat" class="form-control" type="text" name="alamat"
                                :value="old('alamat')" required placeholder="Contoh: Jl. Pulo Wonokromo No.xx" />
                            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                        </div>
                        <div>
                            <x-input-label for="no_telepon" :value="__('No. Handpone')" />
                            <x-text-input id="no_telepon" class="form-control" type="text" name="no_telepon"
                                placeholder="Contoh: 081234567890" :value="old('no_telepon')" />
                            <x-input-error class="mt-2" :messages="$errors->get('no_telepon')" />
                            <small class="text-muted">Bisa dikosongkan apabila tidak ada</small>
                        </div>

                        <div>
                            <x-input-label for="nama_ibu" :value="__('Nama Ibu')" />
                            <x-text-input id="nama_ibu" class="form-control" type="text" name="nama_ibu"
                                :value="old('nama_ibu')" />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_ibu')" />
                            <small class="text-muted">Bisa dikosongkan apabila tidak ada</small>
                        </div>

                        <div>
                            <x-input-label for="nama_ayah" :value="__('Nama Ayah')" />
                            <x-text-input id="nama_ayah" class="form-control" type="text" name="nama_ayah"
                                :value="old('nama_ayah')" />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_ayah')" />
                            <small class="text-muted">Bisa dikosongkan apabila tidak ada</small>
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
