<section>
</section>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <div class="max-7w-xl">
                    <header>
                        <ol class="breadcrumb float-sm-right bg-transparent d-md-none">
                            <li class="breadcrumb-item"><a href="#detail">Asset Detail</a></li>
                            <li class="breadcrumb-item active"><a href="#jadwal">Jadwal</a></li>
                        </ol>
                    </header>

                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4 order-1 border border-gray-300 border-2 rounded-lg shadow-sm mb-3 p-3"
                            id="detail">
                            <div class="row">
                                <div class="col">
                                    <h5>
                                        <i
                                            class="fas fa-circle text-{{ $asset->status === 'Baik' ? 'success' : ($asset->status === 'Kurang Baik' ? 'warning' : 'danger') }}"></i>
                                        {{ $asset->status }}
                                    </h5>
                                </div>
                                <div class="col text-right">
                                    <h5>Detail Asset</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-center align-content-center">
                                <img class=" img-fluid"
                                    style="width: 70%; aspect-ratio:1/1;background-repeat: no-repeat; object-fit:contain; "
                                    src="{{ asset('/images/photo3.jpg') }}" alt="">
                            </div>
                            <h4 class="text-primary text-center"> {{ $asset->name }}</h4>
                            <p class="text-muted text-justify">{{ $asset->description }}</p>
                            <br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-3">
                                        <p>Category</p>
                                    </div>
                                    <div class="col-auto">
                                        <p>:</p>
                                    </div>
                                    <div class="col font-weight-bold text-right">
                                        {{ $asset->category->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <p>Harga</p>
                                    </div>
                                    <div class="col-auto">
                                        <p>:</p>
                                    </div>
                                    <div class="col font-weight-bold text-right">
                                        {{ formatRupiah($asset->value) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <p>Status</p>
                                    </div>
                                    <div class="col-auto">
                                        <p>:</p>
                                    </div>
                                    <div class="col font-weight-bold text-right">
                                        <span
                                            class="badge badge-pill badge-{{ $asset->status === 'Baik' ? 'success' : ($asset->status === 'Kurang Baik' ? 'warning' : 'danger') }}">
                                            {{ $asset->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-5 mb-3">
                                <a href="{{ route('assets.edit', ['asset' => $asset->id]) }}"
                                    class="btn btn-md btn-info"> <i class="fas fa-pencil-alt">
                                    </i> Edit</a>
                                <button type="button"
                                    onclick="btnDelete('{{ csrf_token() }}','{{ route('assets.destroy', ['id' => $asset->id]) }}')"
                                    class="btn btn-danger btn-md btn-delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-8 order-2" id="jadwal">
                            <h4 class="text-center"><i class="fas fa-calendar-alt"></i> Jadwal Pemeliharaan</h4>
                            <div class="row">
                                @forelse($schedules as $item)
                                    @php
                                        $badgeClass = 'success';
                                        if ($item->status == 'upcoming') {
                                            $badgeClass = 'warning';
                                        } elseif ($item->status == 'overdue') {
                                            $badgeClass = 'danger';
                                        }
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="card border border-grey-300 border-2 rounded-lg shadow-sm mb-3">
                                            <div class="card-body">
                                                <h3 class="card-title uppercase" style="margin-bottom: 10px;">

                                                    <i class="fas fa-circle text-{{ $badgeClass }}"></i>
                                                    {{ $item->status }}
                                                </h3>
                                                <div class="card-text">
                                                    <div class="row text-sm mb-n1">
                                                        <p class="col-4 col-md-3">Petugas</p>
                                                        <p class="col-auto">:</p>
                                                        <p class="col"><b>{{ $item->assignedTo->name }}</b></p>
                                                    </div>
                                                    <div class="row text-sm mb-n1">
                                                        <p class="col-4 col-md-3">Keterangan</p>
                                                        <p class="col-auto">:</p>
                                                        <p class="col">{{ $item->description }}</p>
                                                    </div>
                                                    <div class="row text-sm">
                                                        <p class="col-4 col-md-3">Tanggal</p>
                                                        <p class="col-auto">:</p>
                                                        <p class="col">
                                                            <b>{{ \Carbon\Carbon::parse($item->schedule_date)->format('Y-m-d') }}</b>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                @empty
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    Belum ada jadwal pemeliharaan
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
