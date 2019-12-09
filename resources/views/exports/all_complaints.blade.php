<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Number</th>
            <th>Comments</th>
            <th>Status</th>
            <th>Section</th>
            <th>Action</th>
            <th>Modified by</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($complains as $key => $complain)
        <tr>
            <td> {{$key + 1}} </td>
            <td> {{$complain->name}} </td>
            <td> {{ $complain->email }} </td>
            <td> {{ $complain->mobile }} </td>
            <td> {{ $complain->comment }} </td>
            <td> {{ $complain->status }} </td>
            <td> {{ $complain->userRole->role }} </td>
            <td> {{ $complain->action_text }} </td>
            <td> {{ $complain->user->name }} </td>
            <td> {{ date('d-M-Y',strtotime($complain->created_at)) }} </td>
            <td> {{ date('d-M-Y',strtotime($complain->updated_at)) }} </td>
        </tr>
        @endforeach
    </tbody>
</table>