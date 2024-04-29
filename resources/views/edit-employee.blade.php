<x-Layout heading="Edit Employee {{$employee['first_name']}} {{$employee['last_name']}}">
<div class="action-box">
        <form action="/edit-employee/{{$employee['id']}}" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            @method('PUT')
            <input name="first_name" type="text" value="{{$employee['first_name']}}" required>
            <input name="last_name" type="text" value="{{$employee['last_name']}}" required>
            <br><br>
            <input name="phone_number" type="text" value="{{$employee['phone_number']}}" required>
            <input name="email" type="email" value="{{$employee['email']}}" required>
            <br><br>
            <labeL>Address:</label>
            <select name="address_id" required>
                <option value="">Select Address</option>
                @foreach ($addresses as $address)
                    <option value="{{ $address['id'] }}">{{ $address['street_address'] }} {{ $address['city'] }}
                        {{ $address['state'] }} {{ $address['zipcode'] }}</option>
                @endforeach
            </select>
            <select name="role_id" required>
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->id }} at {{ $role->enclosure_name }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Save Changes</button>
        </form>
    </div>
</x-Layout>