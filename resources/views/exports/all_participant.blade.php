<table>
    <thead>
        <tr>
            <th>No .</th>
            <th>User id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Dial Code</th>
            <th>Number</th>
            <th>On behalf first name</th>
            <th>On behalf last name</th>
            <th>On behalf email</th>
            <th>On behalf mobile</th>
            <th>Gender</th>
            <th>Date of birth</th>
            <th>comment</th>
            <th>category</th>
            <th>Sub category</th>
            <th>Location</th>
            <th>Group</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr></tr>
        @foreach($participants as $key => $participant)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $participant->user_id }}</td>
            <td>{{ $participant->first_name }}</td>
            <td>{{ $participant->last_name }}</td>
            <td>{{ $participant->email }}</td>
            <td>{{ $participant->dial_code }}</td>
            <td>{{ $participant->mobile }}</td>
            <td>{{ $participant->on_behalf_first_name }}</td>
            <td>{{ $participant->on_behalf_last_name }}</td>
            <td>{{ $participant->on_behalf_email }}</td>
            <td>{{ $participant->on_behalf_mobile }}</td>
            <td>{{ $participant->gender == 1 ? 'Male' : 'Female' }}</td>
            <td>{{ $participant->dob }}</td>
            <td>{{ $participant->comment }}</td>
            <td>{{ $participant->category ? $participant->category->category_name : '' }}</td>
            <td>{{ $participant->sub_category ? $participant->sub_category->category_name : '' }}</td>
            <td>{{ $participant->location ? $participant->location->name : '' }}</td>
            <td>{{ $participant->group ? $participant->group->group_name: '' }}</td>
            <td>{{ $participant->type ? $participant->type->type_name : '' }}</td>
            <td>{{ $participant->status ? 'Active' : 'Inactive' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>