@extends('layouts.app')

@section('title', 'Location History')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Location History</h1>
        </div>

        <div class="section-body">

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol Hapus Semua --}}
            <form action="{{ route('location-histories.destroyAll') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-3">Hapus Semua</button>
            </form>

            {{-- Tabel Data Lokasi --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Date</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                    <tr @if($location->is_out_of_range) style="background-color: #f8d7da;" @endif>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->user->name }}</td>
                        <td>{{ $location->date }}</td>
                        <td>{{ $location->latitude }}</td>
                        <td>{{ $location->longitude }}</td>
                        <td>
                            @if($location->is_out_of_range)
                                <span class="badge badge-danger">❌ Diluar Jangkauan</span>
                            @else
                                <span class="badge badge-success">✅ Dalam Jangkauan</span>
                            @endif
                        </td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $locations->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
