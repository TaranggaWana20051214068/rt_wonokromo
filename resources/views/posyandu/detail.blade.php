<section>
</section>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Data Posyandu') }}
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
                                            class="fas fa-circle text-{{ $posyandu->status_aktif ? 'success' : 'danger' }}"></i>
                                        {{ $posyandu->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                    </h5>
                                </div>
                                <div class="col text-right">
                                    <h5>Detail Posyandu</h5>
                                </div>
                            </div>
                            <h4 class="text-primary text-center">{{ $posyandu->nama }}</h4>
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-5">Jenis Kelamin</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $posyandu->jenis_kelamin }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Tanggal Lahir</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $posyandu->tanggal_lahir }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Kategori</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $posyandu->kategori }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Alamat</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $posyandu->alamat }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">No. Telepon</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $posyandu->no_telepon ?? 'Tidak ada' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Nama Ibu</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $posyandu->nama_ibu ?? 'Tidak ada' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5">Nama Ayah</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 font-weight-bold">{{ $posyandu->nama_ayah ?? 'Tidak ada' }}</div>
                                </div>
                            </div>
                            <div class="text-right mt-5 mb-3">
                                <a href="{{ route('posyandu.edit', ['posyandu' => $posyandu->id]) }}"
                                    class="btn btn-md btn-info">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <button type="button"
                                    onclick="btnDelete('{{ csrf_token() }}','{{ route('posyandu.destroy', ['id' => $posyandu->id]) }}')"
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
