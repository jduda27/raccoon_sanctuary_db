<x-Layout heading="Sanctuaries">

    <div class="display">
        <h2>All Sanctuaries</h2>
        @foreach ($sanctuaries as $sanctuary)
            <div>
                <h2 style="bold">{{ $sanctuary['sanctuary_name'] }}</h2>
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-sanctuary/{{ $sanctuary['id'] }}">Edit</a></p>
            <form action="/delete-sanctuary/{{ $sanctuary['id'] }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Sanctuary</h2>
        <form action="/register-sanctuary" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            <input name="sanctuary_name" type="text" placeholder="sanctuary name" required>
            <br><br>
            <labeL>Address:</label>
            <select name="address_id" required>
                <option value="">Select Address</option>
                @foreach ($addresses as $address)
                    <option value="{{ $address['id'] }}">{{ $address['street_address'] }} {{ $address['city'] }}
                        {{ $address['state'] }} {{ $address['zipcode'] }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Register Sanctuary</button>
        </form>
    </div>

    <div class="display">
        <h2>All Addresses</h2>
        @foreach ($addresses as $address)
            <div>
                <h3 style="bold">{{ $address['id'] }}</h3>
                {{ $address['street_address'] }} {{ $address['city'] }} {{ $address['state'] }}
                {{ $address['zipcode'] }}
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-address/{{ $address['id'] }}">Edit</a></p>
            <form action="/delete-address/{{ $address['id'] }}" method="POST">
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
        <h2>All Shifts</h2>
        @foreach ($shifts as $shift)
            <div>
                <h3 style="bold">{{ $shift->id }} - {{ $shift->start_time }} {{ $shift->end_time }}</h3>
                {{ $shift->first_name }} {{ $shift->last_name }} {{ $shift->sanctuary_name }}
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-shift/{{ $shift->id }}">Edit</a></p>
            <form action="/delete-shift/{{ $shift->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>Create Shift</h2>
        <form action="/register-shift" method="POST">
            @csrf
            <label>Sanctuary</label>
            <select name="schedule_id" required>
                <option value="">Select Sanctuary</option>
                @foreach ($schedules as $schedule)
                    <option value="{{$schedule->id}}">{{ $schedule->sanctuary_name }}</option>
                @endforeach
            </select>
            <br><br>
            <label>Date</label>
            <input name="date" type="date" placeholder="start date" required>
            <label>Start Time</label>
            <input name="start_time" type="time" placeholder="start time" required>
            <label>End Time</label>
            <input name="end_time" type="time" placeholder="end time" required>
            <br><br>
            <labeL>Employee:</label>
            <select name="employee_id" required>
                <option value="">Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->role_name }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Create Shift</button>
        </form>
    </div>

</x-Layout>