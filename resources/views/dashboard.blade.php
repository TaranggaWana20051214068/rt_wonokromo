<section>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
        integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

    <style>
        /* .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        } */

        .l-bg-cherry {
            background: linear-gradient(to right, #493240, #f09) !important;
            color: #fff;
        }

        .l-bg-blue-dark {
            background: linear-gradient(to right, #373b44, #4286f4) !important;
            color: #fff;
        }

        .l-bg-green-dark {
            background: linear-gradient(to right, #0a504a, #38ef7d) !important;
            color: #fff;
        }

        .l-bg-orange-dark {
            background: linear-gradient(to right, #a86008, #ffba56) !important;
            color: #fff;
        }

        .card .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 110px;
        }

        .card .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

        .l-bg-green {
            background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
            color: #fff;
        }

        .l-bg-orange {
            background: linear-gradient(to right, #f9900e, #ffba56) !important;
            color: #fff;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }
    </style>
</section>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="container">
                            <div class="row ">
                                <div class="col-xl-6 col-lg-6">
                                    <a href="{{ route('penduduk.index') }}">
                                        <div class="card l-bg-blue-dark">
                                            <div class="card-statistic-3 p-4">
                                                <div class="card-icon card-icon-large"><i class="fas fa-users"></i>
                                                </div>
                                                <div class="mb-4">
                                                    <h5 class="card-title mb-0">Penduduk</h5>
                                                </div>
                                                <div class="row align-items-center mb-2 d-flex">
                                                    <div class="col-8">
                                                        <h2 class="d-flex align-items-center mb-0">
                                                            {{ $data['pendudukCount'] }}
                                                        </h2>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <a href="{{ route('posyandu.index') }}">
                                        <div class="card l-bg-green-dark">
                                            <div class="card-statistic-3 p-4">
                                                <div class="card-icon card-icon-large"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="110" height="110"
                                                        fill="currentColor" class="bi bi-person-heart"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z" />
                                                    </svg></div>
                                                <div class="mb-4">
                                                    <h5 class="card-title mb-0">Jumlah Posyandu</h5>
                                                </div>
                                                <div class="row align-items-center mb-2 d-flex">
                                                    <div class="col-8">
                                                        <h2 class="d-flex align-items-center mb-0">
                                                            {{ $data['posyanduCount'] }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <a href="{{ route('assets.index') }}">
                                        <div class="card l-bg-orange-dark">
                                            <div class="card-statistic-3 p-4">
                                                <div class="card-icon card-icon-large"><i
                                                        class="fas fa-dollar-sign"></i>
                                                </div>
                                                <div class="mb-4">
                                                    <h5 class="card-title mb-0">Jumlah inventaris</h5>
                                                </div>
                                                <div class="row align-items-center mb-2 d-flex">
                                                    <div class="col-8">
                                                        <h2 class="d-flex align-items-center mb-0">
                                                            {{ $data['inventoryCount'] }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
