<x-Layout heading="Enclosures">

    <div class="display">
        <h2>All Enclosures</h2>
        @foreach ($enclosures as $enclosure)
            <div>
                <h3 style="bold">{{ $enclosure['id'] }} - {{ $enclosure['enclosure_name'] }}</h3>
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-enclosure/{{ $enclosure['id'] }}">Edit</a></p>
            <form action="/delete-enclosure/{{ $enclosure['id'] }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Enclosure</h2>
        <form action="/register-enclosure" method="POST">
            @csrf
            <input name="enclosure_name" type="text" placeholder="enclosure name" required>
            <br><br>
            <button>Register Enclosure</button>
        </form>
    </div>

    <div class="display">
        <h2>All Storage Rooms</h2>
        @foreach ($storageRooms as $room)
            <div>
                <h3 style="bold">{{ $room['id'] }} - {{ $room['location_name'] }}</h3>
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-storage-room/{{ $room['id'] }}">Edit</a></p>
            <form action="/delete-storage-room/{{ $room['id'] }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Storage Room</h2>
        <form action="/register-storage-room" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            <input name="location_name" type="text" placeholder="location name" required>
            <labeL>Enclosure:</label>
            <select name="enclosure_id" required>
                <option value="">Select Enclosure</option>
                @foreach ($enclosures as $enclosure)
                    <option value="{{ $enclosure['id'] }}">{{ $enclosure['enclosure_name'] }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Register Storage Room</button>
        </form>
    </div>

    <div class="display">
        <h2>All Supplies</h2>
        @foreach ($supplies as $supply)
            <div>
                <h3 style="bold">{{ $supply->id }} - {{ $supply->supply_name }}</h3>
                Purchase price: {{$supply->price}} 
                Current Quantity: {{$supply->quantity}} 
                Current Location: {{$supply->location_name}}
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-supply/{{ $supply->id }}">Edit</a></p>
            <form action="/delete-supply/{{ $supply->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Supply</h2>
        <form action="/register-supply" method="POST">
            @csrf
            <input name="supply_name" type="text" placeholder="supply name" required>
            <input name="quantity" type="number" placeholder="quantity" required>
            <input name="price" type="money" placeholder="$0.00">
            <labeL>Storage Room:</label>
                <select name="storage_id" required>
                    <option value="">Select Storage Room</option>
                @foreach ($storageRooms as $room)
                    <option value="{{ $room['id'] }}">{{ $room['location_name'] }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Register Supply</button>
        </form>
    </div>
</x-Layout>