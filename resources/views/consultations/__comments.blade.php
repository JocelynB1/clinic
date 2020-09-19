@if($consultations->isNotEmpty())
<table class="table table-hover table-light table-borded table-striped table-responsive">
    <thead>
        <tr>
            <th>
                Previous Comment
            </th>
            <th>
                Date
            </th>
        </tr>
    </thead>    
    @foreach ($consultations as $consultation)
        <tr>
                <td>{{ $consultation->comment }}</td>
                <td>{{ $consultation->created_at }}</td>
        </tr>
        @endforeach
</table>

{{ $consultations->links() }}
@endif