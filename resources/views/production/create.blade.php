@extends('layouts.app')

@section('content')
    <h2>Record Production Batch</h2>

    <form action="{{ route('production.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Finished Product Produced:</label><br>
            <select name="ProductID" required>
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->ID }}">{{ $product->ProductName }} - Current: {{ $product->Quantity }}</option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label>Quantity Produced:</label><br>
            <input type="number" name="QuantityProduced" min="1" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Date & Time of Production:</label><br>
            <input type="datetime-local" name="ProductionDate" required value="{{ date('Y-m-d\TH:i') }}">
        </div>

        <button type="submit">Record Batch</button>
        <a href="{{ route('inventory.index') }}">Cancel</a>
    </form>
@endsection