@extends('layouts.app')

@section('content')
    <h2>Inventory Movement Log</h2>

    <form method="GET" action="{{ route('reports.inventory') }}" style="margin-bottom: 20px;">
        <label>Start Date: <input type="date" name="start_date" value="{{ $startDate }}" required></label>
        <label>End Date: <input type="date" name="end_date" value="{{ $endDate }}" required></label>
        <button type="submit">Filter</button>
    </form>

    <table style="width: 100%; border-collapse: collapse;" border="1">
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px;">Date/Time</th>
            <th style="padding: 8px;">Item Name</th>
            <th style="padding: 8px;">Movement</th>
            <th style="padding: 8px;">Quantity</th>
            <th style="padding: 8px;">Processed By</th>
        </tr>
        @forelse($movements as $movement)
            <tr>
                <td style="padding: 8px;">{{ \Carbon\Carbon::parse($movement->DateAdded)->format('Y-m-d H:i') }}</td>
                <td style="padding: 8px;">{{ $movement->inventory->ItemName ?? 'Unknown' }}</td>
                <td style="padding: 8px;">
                    @if($movement->MovementType == 'Stock-In')
                        <span style="color: green;">In</span>
                    @else
                        <span style="color: red;">Out</span>
                    @endif
                </td>
                <td style="padding: 8px;">{{ $movement->Quantity }}</td>
                <td style="padding: 8px;">{{ $movement->user->FullName ?? 'System' }}</td>
            </tr>
        @empty
            <tr><td colspan="5" style="padding: 8px; text-align: center;">No inventory movements logged during this period.</td></tr>
        @endforelse
    </table>
@endsection