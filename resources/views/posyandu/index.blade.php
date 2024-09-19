<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-semibold leading-tight text-gray-900 dark:text-gray-100">
                            {{ __('Data Posyandu') }}
                        </h2>
                        <x-primary-button
                            onclick="window.location.href='{{ route('posyandu.create') }}'">Tambah</x-primary-button>
                    </div>
                    <x-search-form :homeRoute="route('posyandu.index')">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kategori :</label>
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
                    <x-table :headers="['Nama', 'Kategori', 'Alamat', 'No. Handpone', 'Status']">
                        @forelse ($posyandu as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->no_telepon }}</td>
                                <td>
                                    <span class="badge {{ $item->status_aktif ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('posyandu.show', ['posyandu' => $item->id]) }}">
                                        Detail
                                        <i class="fas fa-folder">
                                        </i>
                                    </a>
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('posyandu.edit', ['posyandu' => $item->id]) }}">
                                        Ubah
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                        onclick="btnDelete('{{ csrf_token() }}','{{ route('posyandu.destroy', ['id' => $item->id]) }}')"
                                        class="btn btn-danger btn-sm btn-delete">
                                        Hapus
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data tersedia. silahkan <a
                                        href="{{ route('posyandu.create') }}">Tambah data.</a></td>
                            </tr>
                        @endforelse
                    </x-table>
                    <div class="pagination-container">
                        {{ $posyandu->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
