<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-semibold leading-tight text-gray-900 dark:text-gray-100">
                            {{ __('Daftar Inventaris') }}
                        </h2>
                        <x-primary-button
                            onclick="window.location.href='{{ route('assets.create') }}'">Tambah</x-primary-button>
                    </div>
                    <x-search-form :homeRoute="route('assets.index')">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kategori:</label>
                                    <select name="result_types" class="select2" style="width:100%;">
                                        <option value="" selected>All</option>
                                        @foreach ($categoryOptions as $type)
                                            <option value="{{ $type }}"
                                                {{ request('result_types') == $type ? 'selected' : '' }}>
                                                {{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </x-search-form>
                    @if (session('success'))
                        <div class="callout callout-success">
                            <h5>Berhasil!</h5>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <x-table :headers="['Nama barang', 'Kategori', 'Tanggal penerimaan', 'Nilai awal', 'Jumlah', 'Lokasi']">
                        @forelse ($assets as $asset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->category }}</td>
                                <td>{{ $asset->purchase_date }}</td>
                                <td>{{ formatRupiah($asset->value) }}</td>
                                <td>{{ $asset->amount }}</td>
                                <td>{{ $asset->location }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('assets.edit', ['asset' => $asset->id]) }}">
                                        Ubah
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    <button type="button"
                                        onclick="btnDelete('{{ csrf_token() }}','{{ route('assets.destroy', ['id' => $asset->id]) }}')"
                                        class="btn btn-danger btn-sm btn-delete">
                                        Hapus
                                        <i class="fas fa-trash">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data tersedia. silahkan <a
                                        href="{{ route('assets.create') }}">Tambah data.</a></td>
                            </tr>
                        @endforelse
                    </x-table>
                    <div class="pagination-container">
                        {{ $assets->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
