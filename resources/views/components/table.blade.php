<div class="table-responsive">
    <table id="example2" class="table projects table-hover">
        <thead>
            <tr class="">
                <th>#</th>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
                <th> </th>
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
