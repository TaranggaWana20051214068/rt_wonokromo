<section>
</section>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Data Penduduk') }}
        </h2>
        <x-primary-button onclick="window.history.back()" class="mt-2">
            {{ __('Kembali') }}
        </x-primary-button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-7w-xl">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 order-1 border border-gray-300 border-2 rounded-lg shadow-sm mb-3 p-3"
                            id="detail">
                            <div class="row">
                                <div class="col">
                                    <h5>
                                        <i
                                            class="fas fa-circle text-{{ $penduduk->status_aktif ? 'success' : 'danger' }}"></i>
                                        {{ $penduduk->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                    </h5>
                                </div>
                                <div class="col text-right">
                                    <h5>Detail Penduduk</h5>
                                </div>
                            </div>
                            <h4 class="text-primary text-center">{{ $penduduk->nama_lengkap }}</h4>
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-5">No. KK</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->no_kk }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">NIK</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->nik }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Jenis Kelamin</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->jenis_kelamin }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Tempat Lahir</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->tempat_lahir }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Tanggal Lahir</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->tanggal_lahir->format('d-m-Y') }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Agama</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->agama ?? 'Tidak ada' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Pendidikan Terakhir</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">
                                        {{ $penduduk->pendidikan_terakhir ?? 'Tidak ada' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Pekerjaan</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->pekerjaan ?? 'Tidak ada' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Status Perkawinan</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">
                                        {{ $penduduk->status_perkawinan ?? 'Tidak ada' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Alamat</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->alamat ?? 'Tidak ada' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Nomor Telepon</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->nomor_telepon ?? 'Tidak ada' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Status Keluarga</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">
                                        {{ $penduduk->status_dalam_keluarga ?? 'Tidak ada' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Kategori Umur</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->umur_kategori }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Kesejahteraan</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $penduduk->status_kesejahteraan }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Foto KTP</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">
                                        <x-secondary-button class="ms-1" x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'view-ktp-modal')">
                                            <i class="fas fa-file fas-lg"></i> Lihat
                                        </x-secondary-button>
                                    </div>
                                </div>

                                <x-modal name="view-ktp-modal" maxWidth="md">
                                    <div class="p-6">
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Foto KTP') }}
                                        </h2>
                                        <div class="mt-4">
                                            <img src="{{ Storage::url('dokumen_pendukung/' . $penduduk->dokumen_pendukung) }}"
                                                class="img-fluid" alt="Foto KTP">
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center justify-end p-6 border-t border-gray-200 dark:border-gray-600">
                                        <x-secondary-button x-on:click="$dispatch('close-modal', 'view-ktp-modal')">
                                            {{ __('Tutup') }}
                                        </x-secondary-button>
                                    </div>
                                </x-modal>

                                @if (!$penduduk->status_aktif)
                                    <div class="row">
                                        <div class="col-5">Keterangan Tidak Aktif</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6 font-weight-bold">
                                            {{ $penduduk->keterangan_tidak_aktif ?? 'Tidak ada' }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="text-right mt-5 mb-3">
                                <a href="{{ route('penduduk.edit', ['penduduk' => $penduduk->id]) }}"
                                    class="btn btn-md btn-info">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <button type="button"
                                    onclick="btnDelete('{{ csrf_token() }}','{{ route('penduduk.destroy', ['id' => $penduduk->id]) }}')"
                                    class="btn btn-danger btn-md btn-delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
