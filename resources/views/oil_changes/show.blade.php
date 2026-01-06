<div>
    <h1>Oil Change Details</h1>
    <p><strong>Current Odometer:</strong> {{ $oilChange->current_odometer }}</p>
    <p><strong>Date of Previous Oil Change::</strong> {{ $oilChange->prev_oil_change_date }}</p>
    <p><strong>Odometer at Previous Oil Change:</strong> {{ $oilChange->prev_odometer }}</p>
    <p><strong>Overdue for Oil Change:</strong>
        <span style="color: {{ $oilChange->is_due ? 'green' : 'red' }}">
            {{ $oilChange->is_due ? 'Yes' : 'No' }}
        </span>
    </p>
    <a href="{{ route('oil_changes.create') }}">Go Back</a>
</div>