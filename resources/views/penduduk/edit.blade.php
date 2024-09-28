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
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Form Data Penduduk') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Isi data dengan teliti dan pastikan kembali!.') }}
                        </p>
                    </header>
                    <form method="post" action="{{ route('penduduk.update', ['penduduk' => $penduduk->id]) }}"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                            <x-text-input id="nama_lengkap" class="form-control" type="text" name="nama_lengkap"
                                :value="old('nama_lengkap', $penduduk->nama_lengkap)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
                        </div>
                        <div>
                            <x-input-label for="category_id" :value="__('Keluarga')" />
                            <select id="category_id" class="form-control" name="category_id" required>
                                <option selected disabled>Pilih keluarga</option>
                                @foreach ($keluarga as $kk)
                                    <option value="{{ $kk->id }}"
                                        {{ old('category_id', $penduduk->category_id) == $kk->id ? 'selected' : '' }}>
                                        {{ $kk->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('umur_kategori')" />
                        </div>
                        <div>
                            <x-input-label for="nik" :value="__('NIK')" />
                            <x-text-input id="nik" class="form-control" type="text" name="nik"
                                :value="old('nik', $penduduk->nik)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
                        </div>
                        <div>
                            <x-input-label for="no_kk" :value="__('Nomer KK')" />
                            <x-text-input id="no_kk" class="form-control" type="text" name="no_kk"
                                :value="old('no_kk', $penduduk->no_kk)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('no_kk')" />
                        </div>

                        <div>
                            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                            <select id="jenis_kelamin" class="form-control" name="jenis_kelamin" required>
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                        </div>
                        <div>
                            <x-input-label for="status_kesejahteraan" :value="__('Status Kesejahteraan')" />
                            <select id="status_kesejahteraan" class="form-control" name="status_kesejahteraan" required>
                                @foreach ($status_kesejahteraans as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status_kesejahteraan', $penduduk->status_kesejahteraan) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status_kesejahteraan')" />
                        </div>

                        <div>
                            <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                            <x-text-input id="tempat_lahir" class="form-control" type="text" name="tempat_lahir"
                                :value="old('tempat_lahir', $penduduk->tempat_lahir)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
                        </div>

                        <div>
                            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                            <x-text-input id="tanggal_lahir" class="form-control" type="date" name="tanggal_lahir"
                                :value="old('tanggal_lahir', $penduduk->tanggal_lahir->format('Y-m-d'))" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                        </div>

                        <div>
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <x-text-input id="alamat" class="form-control" type="text" name="alamat"
                                :value="old('alamat', $penduduk->alamat)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                        </div>

                        <div>
                            <x-input-label for="agama" :value="__('Agama')" />
                            <select id="agama" class="form-control" name="agama">
                                @foreach ($agamas as $agama)
                                    <option value="{{ $agama }}"
                                        {{ old('agama', $penduduk->agama) == $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('agama')" />
                        </div>

                        <div>
                            <x-input-label for="pendidikan_terakhir" :value="__('Pendidikan Terakhir')" />
                            <select id="pendidikan_terakhir" class="form-control" name="pendidikan_terakhir">
                                <option selected disabled>Pilih pendidikan terakhir</option>
                                @foreach ($pendidikans as $pendidikan)
                                    <option value="{{ $pendidikan }}"
                                        {{ old('pendidikan_terakhir', $penduduk->pendidikan_terakhir) == $pendidikan ? 'selected' : '' }}>
                                        {{ $pendidikan }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('pendidikan_terakhir')" />
                        </div>

                        <div>
                            <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                            <x-text-input id="pekerjaan" class="form-control" type="text" name="pekerjaan"
                                :value="old('pekerjaan', $penduduk->pekerjaan)" />
                            <x-input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
                        </div>

                        <div>
                            <x-input-label for="status_perkawinan" :value="__('Status Perkawinan')" />
                            <select id="status_perkawinan" class="form-control" name="status_perkawinan">
                                <option selected disabled>Pilih status Perkawinan</option>
                                @foreach ($status_perkawinans as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status_perkawinan', $penduduk->status_perkawinan) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status_perkawinan')" />
                        </div>

                        <div>
                            <x-input-label for="nomor_telepon" :value="__('No. Handphone')" />
                            <small class="text-muted">contoh 08987654321.</small>
                            <x-text-input id="nomor_telepon" class="form-control" type="text" name="nomor_telepon"
                                :value="old('nomor_telepon', $penduduk->nomor_telepon)" />
                            <x-input-error class="mt-2" :messages="$errors->get('nomor_telepon')" />
                        </div>

                        <div>
                            <x-input-label for="status_dalam_keluarga" :value="__('Status dalam Keluarga')" />
                            <x-text-input id="status_dalam_keluarga" class="form-control" type="text"
                                name="status_dalam_keluarga" :value="old('status_dalam_keluarga', $penduduk->status_dalam_keluarga)" />
                            <x-input-error class="mt-2" :messages="$errors->get('status_dalam_keluarga')" />
                        </div>

                        <div>
                            <x-input-label for="umur_kategori" :value="__('Kategori Umur')" />
                            <select id="umur_kategori" class="form-control" name="umur_kategori" required>
                                <option selected disabled>Pilih umur</option>
                                @foreach ($umur_kategoris as $kategori)
                                    <option value="{{ $kategori }}"
                                        {{ old('umur_kategori', $penduduk->umur_kategori) == $kategori ? 'selected' : '' }}>
                                        {{ $kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('umur_kategori')" />
                        </div>

                        {{-- <div>
                            <x-input-label for="dokumen_pendukung" :value="__('Foto KTP')" />
                            <input id="dokumen_pendukung" class="custom-file-input form-control" type="file"
                                name="dokumen_pendukung" accept="image/*" />
                            @if ($penduduk->dokumen_pendukung)
                                <p class="mt-2">Current file: {{ $penduduk->dokumen_pendukung }}</p>
                            @endif
                            <x-input-error class="mt-2" :messages="$errors->get('dokumen_pendukung')" />
                        </div> --}}



                        <div>
                            <x-input-label for="status_aktif" :value="__('Status Aktif')" />
                            <select id="status_aktif" class="form-control" name="status_aktif" required>
                                <option value="1"
                                    {{ old('status_aktif', $penduduk->status_aktif) == 1 ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0"
                                    {{ old('status_aktif', $penduduk->status_aktif) == 0 ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status_aktif')" />
                        </div>

                        <div id="keterangan_tidak_aktif_container" style="display: none;">
                            <x-input-label for="keterangan_tidak_aktif" :value="__('Keterangan Tidak Aktif')" />
                            <x-text-input id="keterangan_tidak_aktif" class="form-control" type="text"
                                name="keterangan_tidak_aktif" :value="old('keterangan_tidak_aktif', $penduduk->keterangan_tidak_aktif)" />
                            <x-input-error class="mt-2" :messages="$errors->get('keterangan_tidak_aktif')" />
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
    @section('script-bottom')
        <script>
            document.getElementById('status_aktif').addEventListener('change', function() {
                var keteranganContainer = document.getElementById('keterangan_tidak_aktif_container');
                if (this.value == '0') {
                    keteranganContainer.style.display = 'block';
                } else {
                    keteranganContainer.style.display = 'none';
                }
            });

            // Trigger the change event on page load
            document.getElementById('status_aktif').dispatchEvent(new Event('change'));
        </script>
    @endsection
</x-app-layout>
