<div class="card">
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Weight</th>
            <th>Percent</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->name ?? 'Unallocated' }}</td>
                <td>{{ $member->weight }}</td>
                <td>{{ number_format($member->weight / $weight * 100, 2, ',', '.') }}%</td>
                <td>{{ number_format($member->weight / $weight * $price, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
