@extends('layouts.app')

@section('content')
    <h2>Sales Report</h2>

    <form method="GET" action="{{ route('reports.sales') }}" style="margin-bottom: 20px;">
        <label>Start Date: <input type="date" name="start_date" value="{{ $startDate }}" required></label>
        <label>End Date: <input type="date" name="end_date" value="{{ $endDate }}" required></label>
        <button type="submit">Filter</button>
    </form>

    <div style="display: flex; gap: 20px;">
        <div style="flex: 2;">
            <h3>Daily Revenue Array</h3>
            <table style="width: 100%; border-collapse: collapse;" border="1">
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 8px;">Date</th>
                    <th style="padding: 8px;">Total Revenue</th>
                </tr>
                @forelse($dailySales as $sale)
                    <tr>
                        <td style="padding: 8px;">{{ $sale->date }}</td>
                        <td style="padding: 8px;">₱{{ number_format($sale->total, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" style="padding: 8px; text-align: center;">No sales during this period.</td></tr>
                @endforelse
            </table>
        </div>

        <div style="flex: 1;">
            <h3>Top 5 Products</h3>
            <ul>
                @foreach($topProducts as $item)
                    <li>{{ $item->ProductName }} - {{ $item->total_sold }} sold</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection