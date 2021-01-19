<div class="col-sm-10 offset-sm-1 mt-5 table-responsive-md">
    <table class="table table-hover table-bordered" style="width:100%"  id="weather-search">
        <thead class="bg-light text-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Visitor</th>
            <th scope="col">Location</th>
            <th scope="col">Temperature</th>
            <th scope="col">Zip Code</th>
            <th scope="col">Day & Time</th>
            <th scope="col">Searched At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($searchHistory as $search)
            <tr>
                <th scope="row">{{ $search->id }}</th>
                <td>{{ $search->visitor }}</td>
                <td>{{ $search->location ?? '-' }}</td>
                @isset($search->temperature)
                <td>{{ $search->temperature }} <span>&#8457;</span></td>
                @else
                    <td>{{ '-'  }}</td>
                @endisset
                <td>{{ $search->zipCode }}</td>
                <td>{{ $search->dayTime ?? '-'  }}</td>
                <td>{{ $search->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
