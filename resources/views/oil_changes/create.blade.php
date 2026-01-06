<div>
    <div>
        <form method="POST" action="{{ route('oil_changes.store') }}">
            @csrf
            <div>
                <label for="current_odometer">Current Odometer:</label>
                <input type="number" id="current_odometer" name="current_odometer" value="{{ old('current_odometer') }}" required>
                @error('current_odometer')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="prev_oil_change_date">Date of Previous Oil Change:</label>
                <input type="date" id="prev_oil_change_date" name="prev_oil_change_date" value="{{ old('prev_oil_change_date') }}" required>
                @error('prev_oil_change_date')
                    <p style="color: red;">{{ $message }}</p>
                @enderror   
            </div>
            <div>
                <label for="prev_odometer">Odometer at Previous Oil Change:</label>
                <input type="number" id="prev_odometer" name="prev_odometer" value="{{ old('prev_odometer') }}" required>
                @error('prev_odometer')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>