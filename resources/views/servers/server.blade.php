@extends('layouts.main')

@section('title', 'Listing Servers')
    
@section('content')
@include('servers.partials.filters.server')
<div>
    <table id="server-list">
        <thead>
            <tr>
                <th>Model</th>
                <th>RAM</th>
                <th>HDD</th>
                <th>Location</th>
                <th>Price</th>
            </tr>
        </thead>
    </table>
</div>
@endsection


@section('scripts')
    <script>
        const url = "{{ route('api.servers.list') }}"
    </script>
    <script src="{{ asset('js/servers/devexpress/server.js') }}"></script>

@stop


