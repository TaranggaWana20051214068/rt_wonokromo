<section>

</section>
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <div class="max-7w-xl">
                    <header>
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('penduduk.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Data Penduduk</li>
                        </ol>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Form Data Penduduk') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Isi data dengan teliti dan pastikan kembali!.') }}
                        </p>
                    </header>
                    <form method="post" action="{{ route('penduduk.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                            <x-text-input id="nama_lengkap" class="form-control" type="text" name="nama_lengkap"
                                :value="old('nama_lengkap')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
                        </div>
                        <div>
                            <x-input-label for="category_id" :value="__('Keluarga')" />
                            <select id="category_id" class="form-control" name="category_id" required>
                                <option selected disabled>Pilih keluarga</option>
                                @foreach ($keluargas as $kk)
                                    <option value="{{ $kk->id }}"
                                        {{ old('category_id') == $kk->id ? 'selected' : '' }}>
                                        {{ $kk->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('umur_kategori')" />
                        </div>
                        <div>
                            <x-input-label for="nik" :value="__('NIK')" />
                            <x-text-input id="nik" class="form-control" type="text" name="nik"
                                :value="old('nik')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
                        </div>
                        <div>
                            <x-input-label for="no_kk" :value="__('Nomor KK')" />
                            <x-text-input id="no_kk" class="form-control" type="text" name="no_kk"
                                :value="old('no_kk')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('no_kk')" />
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
                            <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                            <x-text-input id="tempat_lahir" class="form-control" type="text" name="tempat_lahir"
                                :value="old('tempat_lahir')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
                        </div>
                        <div>
                            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                            <x-text-input id="tanggal_lahir" class="form-control" type="date" name="tanggal_lahir"
                                :value="old('tanggal_lahir')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                        </div>
                        <div>
                            <x-input-label for="umur_kategori" :value="__('Kategori Umur')" />
                            <select id="umur_kategori" class="form-control" name="umur_kategori" required>
                                <option value="">Pilih Kategori Umur</option>
                                <option value="Kanak-kanak"
                                    {{ old('umur_kategori') == 'Kanak-kanak' ? 'selected' : '' }}>
                                    Kanak-kanak</option>
                                <option value="Remaja" {{ old('umur_kategori') == 'Remaja' ? 'selected' : '' }}>Remaja
                                </option>
                                <option value="Dewasa" {{ old('umur_kategori') == 'Dewasa' ? 'selected' : '' }}>Dewasa
                                </option>
                                <option value="Lansia" {{ old('umur_kategori') == 'Lansia' ? 'selected' : '' }}>Lansia
                                </option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('umur_kategori')" />
                        </div>
                        <div>
                            <x-input-label for="status_kesejahteraan" :value="__('Status Kesejahteraan')" />
                            <select id="status_kesejahteraan" class="form-control" name="status_kesejahteraan" required>
                                <option value="">Pilih Status Kesejahteraan</option>
                                <option value="Sejahtera"
                                    {{ old('status_kesejahteraan') == 'Sejahtera' ? 'selected' : '' }}>
                                    Sejahtera</option>
                                <option value="Pra-sejahtera"
                                    {{ old('status_kesejahteraan') == 'Pra-sejahtera' ? 'selected' : '' }}>
                                    Pra-sejahtera
                                </option>
                                <option value="Rentan ekonomi"
                                    {{ old('status_kesejahteraan') == 'Rentan ekonomi' ? 'selected' : '' }}>Rentan
                                    ekonomi
                                </option>
                                <option value="Penerima bantuan sosial"
                                    {{ old('status_kesejahteraan') == 'Penerima bantuan sosial' ? 'selected' : '' }}>
                                    Penerima bantuan sosial</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status_kesejahteraan')" />
                        </div>
                        <div>
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <x-text-input id="alamat" class="form-control" type="text" name="alamat"
                                :value="old('alamat')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
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
