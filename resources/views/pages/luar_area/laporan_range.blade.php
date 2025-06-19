@extends('layouts.app')

@section('title', 'Laporan Keluar Area')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>
                Laporan Keluar Area -
                Bulan {{ \Carbon\Carbon::createFromDate($year, $month, 1)->translatedFormat('F') }}
                {{ $year }}
            </h1>
        </div>

        <div class="section-body">
            <form method="GET" class="form-inline mb-4">
                <label class="mr-2">Pilih Bulan:</label>
                <select name="month" class="form-control mr-2">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromDate(2000, $m, 1)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>

                <label class="mr-2">Tahun:</label>
                <select name="year" class="form-control mr-2">
                    @for ($y = date('Y') - 2; $y <= date('Y') + 1; $y++)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>

                <button type="submit" class="btn btn-primary">Lihat</button>
            </form>

            @if ($data->isEmpty())
                <div class="alert alert-info">
                    Tidak ada data keluar area pada periode ini.
                </div>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Jumlah Keluar Area</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td><span class="badge badge-danger">{{ $item->total_out_of_range }} kali</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
</div>
@endsection
