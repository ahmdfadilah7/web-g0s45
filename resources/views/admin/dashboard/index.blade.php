@extends('admin.layouts.app')
@include('admin.layouts.partials.css')
@include('admin.layouts.partials.js')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Penjualan</h4>
                    </div>
                    <div class="card-body">
                        {{ $jumlahpenjualan }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-warning bg-warning">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Penjualan</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $jual = 0;
                        @endphp
                        @foreach ($totalpenjualan as $row)
                            @php
                                $transaksi = \App\Models\Transaksi::join('produks', 'transaksis.produk_id', 'produks.id')
                                    ->where('invoice_id', $row->id)
                                    ->get();
                                $totaljual = 0;
                            @endphp
                            @foreach ($transaksi as $value)
                                @php
                                    $harga = $value->harga * $value->jumlah;
                                    $totaljual += $harga;
                                @endphp
                            @endforeach
                            @php
                                $jual += $totaljual;
                            @endphp
                        @endforeach
                        {{ AllHelper::rupiah($jual) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-danger bg-danger">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Biaya Admin</h4>
                    </div>
                    <div class="card-body">
                        {{ $setting->biaya_admin . '%' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-success bg-success">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pendapatan</h4>
                    </div>
                    <div class="card-body">
                        @if(Auth::user()->role == 'petani')                            
                            @php
                                $admin = $jual*$setting->biaya_admin/100;
                                $pendapatan = $jual - $admin;
                            @endphp
                            {{ AllHelper::rupiah($pendapatan) }}
                        @elseif(Auth::user()->role == 'admin')
                            {{ AllHelper::rupiah($setting->saldo) }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Produk Terjual</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart3"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Stok Produk</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart4"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pesanan</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart2" height="180"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        var ctx = document.getElementById("myChart4").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        @foreach ($produk as $row)
                            {{ $row->stok }},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#3abaf4',
                        '#63ed7a',
                        '#ffa426',
                        '#fc544b',
                        '#6777ef',
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    @foreach ($produk as $row)
                        '{{ $row->nama }}',
                    @endforeach
                ],
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
            }
        });

        var ctx = document.getElementById("myChart3").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        @foreach ($produk as $row)
                            @php
                                $jumlah = 0;
                                $transaksi = \App\Models\Transaksi::join('invoices', 'transaksis.invoice_id', 'invoices.id')
                                        ->where('invoices.status', 4)
                                        ->where('produk_id', $row->id)
                                        ->get();
                                foreach ($transaksi as $value) {
                                    $jumlah += $value->jumlah;
                                }
                            @endphp
                            {{ $jumlah }},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#3abaf4',
                        '#63ed7a',
                        '#ffa426',
                        '#fc544b',
                        '#6777ef',
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    @foreach ($produk as $row)
                        '{{ $row->nama }}',
                    @endforeach
                ],
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
            }
        });

        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    "Pesanan belum dibayar",
                    "Pesanan menunggu konfirmasi",
                    "Pesanan sedang diproses",
                    "Pesanan sedang dikirim",
                    "Pesanan selesai",
                    "Pesanan dibatalkan",
                ],
                datasets: [{
                    label: 'Jumlah',
                    data: [
                        {{ $belumbayar }},
                        {{ $menunggukonfirmasi }},
                        {{ $diproses }},
                        {{ $dikirim }},
                        {{ $selesai }},
                        {{ $batal }},
                    ],
                    borderWidth: 2,
                    backgroundColor: ['#fc544b', '#3abaf4', '#6777ef', '#ffa426 ', '#63ed7a', '#fc544b'],
                    borderColor: 'transparent',
                    borderWidth: 0,
                    pointBackgroundColor: '#999',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: true,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: {{ $jumlahpesanan }}
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: true
                        }
                    }]
                },
            }
        });
    </script>
@endsection
