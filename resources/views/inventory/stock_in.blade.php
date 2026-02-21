@extends('layouts.app')

@section('content')
    <h2>Record Raw Material Stock-In</h2>

    <form action="{{ route('inventory.store_stock_in') }}" method="POST">
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
            <label>Quantity Received:</label><br>
            <input type="number" name="Quantity" min="1" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Supplier (Optional):</label><br>
            <input type="text" name="Supplier">
        </div>

        <button type="submit">Complete Stock-In</button>
        <a href="{{ route('inventory.index') }}">Cancel</a>
    </form>
@endsection