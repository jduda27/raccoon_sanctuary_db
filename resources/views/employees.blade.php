<x-Layout heading="Employees">
    <div class="display">
        <h2>All Employees</h2>
        @foreach ($employees as $employee)
            <div>
                <h3 style="bold">{{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->role_id }}</h3>
                {{ $employee->email }} {{ $employee->phone_number }}
                <br>
                {{ $employee->street_address }} {{ $employee->city}} {{ $employee->state}} {{ $employee->zipcode}}
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-employee/{{$employee->id}}">Edit</a></p>
            <form action="/delete-employee/{{$employee->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Employee</h2>
        <form action="/register-employee" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
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
            <button>Register Employee</button>
        </form>
    </div>

    <div class="display">
        <h2>All Addressees</h2>
        @foreach ($addresses as $address)
            <div>
                <h3 style="bold">{{ $address['address_id'] }}</h3>
                {{ $address['street_address'] }} {{ $address['city'] }} {{ $address['state'] }}
                {{ $address['zipcode'] }}
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-address/{{$address['id']}}">Edit</a></p>
            <form action="/delete-address/{{$address['id']}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Address</h2>
        <form action="/register-address" method="POST">
            @csrf
            <input name="street_address" type="text" placeholder="street address" required>
            <input name="city" type="text" placeholder="city" required>
            <input name="state" type="text" placeholder="state" required>
            <input name="zipcode" type="text" placeholder="zipcode" required>
            <br><br>
            <button>Register Address</button>
        </form>
    </div>

    <div class="display">
        <h2>All Roles</h2>
        @foreach ($roles as $role)
                <div>
                    <h3>{{ $role->id }} {{ $role->role_name }}
                            {{ $role->treatment_type }} {{ $role->enclosure_name }}
                    </h3>
                </div>
                <p><a style="text-decoration: underline; color: blue" href="/edit-role/{{$role->id}}">Edit</a></p>
                <form action="/delete-role/{{$role->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="delete-button">Delete</button>
                </form>
                <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Role</h2>
        <form action="/register-role" method="POST">
            @csrf
            <input name="role_name" type="text" placeholder="role name" required>
            <label>Treatments</label>
            <select name="treatment_id">
                <option value="">Select Treatment</option>
                @foreach ($treatments as $treatment)
                    <option value="{{ $treatment['id'] }}">{{ $treatment['treatment_type'] }}</option>
                @endforeach
            </select>
            <br><br>
            <label>Enclosure Responsibility</label>
            <select name="enclosure_id">
                <option value="">Select Enclosure</option>
                @foreach ($enclosures as $enclosure)
                    <option value="{{ $enclosure['id'] }}">
                        {{ $enclosure['id'] }} - {{ $enclosure['enclosure_name'] }}
                    </option>
                @endforeach
            </select>
            <br><br>
            <button>Register Role</button>
        </form>
    </div>
</x-Layout>
