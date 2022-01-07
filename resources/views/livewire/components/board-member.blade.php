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
                <td>{{ number_format($member->weight / $weight * 100, 0, ',', '.') }}%</td>
                <td>{{ number_format($p = floor($member->weight / $weight * $price), 0, ',', '.') }}</td>
            </tr>
            @php $usedPrice += $p; @endphp
        @endforeach
        <tr>
            <td colspan="3">
                <b>Total</b>
            </td>
            <td>
                <b>{{ number_format($usedPrice, 0, ',', '.') }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <b>Remining Payment</b>
            </td>
            <td>
                <b>{{ rtrim(rtrim(number_format($price - $usedPrice, 20, ',', '.'), '0'), ',') }}</b>
            </td>
        </tr>
        </tbody>
    </table>
</div>
