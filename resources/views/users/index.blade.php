<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-gray-100">
                            {{ __('Daftar User') }}
                        </h2>
                        <x-primary-button
                            onclick="window.location.href='{{ route('users.create') }}'">Tambah</x-primary-button>
                    </div>
                    <x-search-form :homeRoute="route('users.index')" />
                    @if (session('success'))
                        <div class="callout callout-success">
                            <h5>Berhasil!</h5>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <x-table :headers="['Name', 'Email']">
                        @forelse ($users as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('users.edit', ['user' => $item->id]) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    <button type="button"
                                        onclick="btnDelete('{{ csrf_token() }}','{{ route('users.destroy', ['id' => $item->id]) }}')"
                                        class="btn btn-danger btn-sm btn-delete">
                                        <i class="fas fa-trash">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data tersedia. silahkan <a
                                        href="{{ route('users.create') }}">Tambah data.</a></td>
                            </tr>
                        @endforelse
                    </x-table>
                    <div class="pagination-container">
                        {{ $users->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
