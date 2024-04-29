<x-Layout heading="Edit Storage Room {{ $storage_room['location_name'] }}">
    <div class="action-box">
        <form action="/edit-storage-room/{{ $storage_room['id'] }}" method="POST">
            <script>
            @if (session()->has('error'))
                alert('{{ session()->get('error') }}')
            @endif
            </script>
            @csrf
            @method('PUT')
            <input name="location_name" type="text" value="{{$storage_room['location_name']}}" required>
            <labeL>Enclosure:</label>
            <select name="enclosure_id" required>
                <option value="">Select Enclosure</option>
                @foreach ($enclosures as $enclosure)
                    <option value="{{ $enclosure['id'] }}">{{ $enclosure['enclosure_name'] }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Save Changes</button>
        </form>
    </div>
</x-Layout>