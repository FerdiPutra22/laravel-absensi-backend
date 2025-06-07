@extends('layouts.app')

@section('title', 'Location History')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Location History</h1>
        </div>

        <div class="section-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Date</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                        <tr>
                            <td>{{ $location->id }}</td>
                            <td>{{ $location->user->name ?? '-' }}</td>
                            <td>{{ $location->date }}</td>
                            <td>{{ $location->latitude }}</td>
                            <td>{{ $location->longitude }}</td>
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
