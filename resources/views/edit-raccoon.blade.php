<x-Layout heading="Edit Raccoon {{ $raccoon['raccoon_name'] }}">
<div class="action-box">
        <form action="/edit-raccoon/{{$raccoon['id']}}" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            @method('PUT')
            <input name="raccoon_name" type="text" value="{{$raccoon['raccoon_name']}}" required>
            <input name="age" type="number" value="{{$raccoon['age']}}">
            <br><br>
            <select name="sex" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
            <label>Length (inches): </label>
            <input name="length" type="decimal" value="{{$raccoon['length']}}" required>
            <label>Weight (lbs): </label>
            <input name="weight" type="decimal" value="{{$raccoon['weight']}}" required>
            <br><br>
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