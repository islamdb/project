<div class="card card-body">
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Weight</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->name ?? 'Unallocated' }}</td>
                <td>{{ $member->weight }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
