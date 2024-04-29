<x-Layout heading="Raccoons">

    <div class="display">
        <h2>All Raccoons</h2>
        @foreach ($raccoons as $raccoon)
            <div>
                <h3 style="bold">{{ $raccoon['id'] }}</h3>
                {{ $raccoon['raccoon_name'] }}
                {{ $raccoon['age'] }}
                {{ $raccoon['sex'] }}
                {{ $raccoon['weight'] }}
                {{ $raccoon['length'] }}
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-raccoon/{{ $raccoon['id'] }}">Edit</a></p>
            <form action="/delete-raccoon/{{ $raccoon['id'] }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Raccoon</h2>
        <form action="/register-raccoon" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            <input name="raccoon_name" type="text" placeholder="raccoon name" required>
            <input name="age" type="number" placeholder="age">
            <br><br>
            <select name="sex" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
            <label>Length (inches): </label>
            <input name="length" type="decimal" placeholder="length" required>
            <label>Weight (lbs): </label>
            <input name="weight" type="decimal" placeholder="weight" required>
            <br><br>
            <labeL>Enclosure:</label>
            <select name="enclosure_id" required>
                <option value="">Select Enclosure</option>
                @foreach ($enclosures as $enclosure)
                    <option value="{{ $enclosure['id'] }}">{{ $enclosure['enclosure_name'] }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Register</button>
        </form>
    </div>
</x-Layout>
