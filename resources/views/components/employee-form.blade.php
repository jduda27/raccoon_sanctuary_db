<div class="action-box">
    <h2>New Employee</h2>
    <form action="/{{$action}}-employee">
        @csrf
        <input name="first_name" type="text" placeholder="first name" required>
        <input name="last_name" type="text" placeholder="last name" required>
        <br><br>
        <input name="phone_number" type="text" placeholder="phone number" required>
        <input name="email" type="email" placeholder="email" required>
        <br><br>
        <labeL>Address:</label>
        <select name="address_id" required>
            <option value="">Select Address</option>
            @foreach ($addresses as $address)
                <option value="{{ $address['address_id'] }}">{{ $address['street_address'] }} {{ $address['city'] }}
                    {{ $address['state'] }} {{ $address['zipcode'] }}</option>
            @endforeach
        </select>
        <select name="address_id" required>
            <option value="">Select Role</option>
            {{-- @foreach ($addresses as $address)
                    <option value="{{ $address['address_id'] }}">{{ $address['street_address'] }} {{ $address['city'] }}
                        {{ $address['state'] }} {{ $address['zipcode'] }}</option>
                @endforeach --}}
        </select>
        <br><br>
        <button>Register Employee</button>
    </form>
</div>
