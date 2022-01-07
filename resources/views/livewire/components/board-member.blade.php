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
            <td colspan="2">
                <b><small>Total</small></b>
            </td>
            <td colspan="2" style="text-align: right">
                <b><small>{{ number_format($usedPrice, 0, ',', '.') }}</small></b>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <b><small>Remining Payment</small></b>
            </td>
            <td colspan="2" style="text-align: right">
                <b><small>{{ rtrim(rtrim(number_format($price - $usedPrice, 20, ',', '.'), '0'), ',') }}</small></b>
            </td>
        </tr>
        </tbody>
    </table>
</div>
