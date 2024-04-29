<x-Layout heading="Edit Supply {{$supply['supply_name']}}">
<div class="action-box">
        <form action="/edit-supply/{{$supply['id']}}" method="POST">
            @csrf
            @method('PUT')
            <input name="supply_name" type="text" value={{$supply['supply_name']}} required>
            <input name="quantity" type="number" value={{$supply['quantity']}} required>
            <input name="price" type="money" value={{$supply['price']}}>
            <labeL>Storage Room:</label>
                <select name="storage_id" required>
                    <option value="">Select Storage Room</option>
                @foreach ($storageRooms as $room)
                    <option value="{{ $room['id'] }}">{{ $room['location_name'] }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Save Changes</button>
        </form>
    </div>
</x-Layout>