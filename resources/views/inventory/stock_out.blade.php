@extends('layouts.app')

@section('content')
    <h2>Record Raw Material Stock-Out (To Kitchen)</h2>

    <form action="{{ route('inventory.store_stock_out') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Raw Material:</label><br>
            <select name="InventoryID" required>
                <option value="">Select Material</option>
                @foreach($rawMaterials as $material)
                    <option value="{{ $material->ID }}">{{ $material->ItemName }} ({{ $material->Measurement }}) - Current: {{ $material->Quantity }}</option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label>Quantity Issued to Kitchen:</label><br>
            <input type="number" name="Quantity" min="1" required>
        </div>

        <button type="submit">Complete Stock-Out</button>
        <a href="{{ route('inventory.index') }}">Cancel</a>
    </form>
@endsection