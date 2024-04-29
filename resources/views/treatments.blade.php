<x-Layout heading="Treatments">
    <div class="display">
        <h2>All Treatments</h2>
        @foreach ($treatments as $treatment)
            <div >
                <h3 style="bold">{{ $treatment['id'] }}</h3>
                {{ $treatment['treatment_type'] }}
            </div>
            <p><a style="text-decoration: underline; color: blue" href="/edit-treatment/{{$treatment['id']}}">Edit</a></p>
            <form action="/delete-treatment/{{$treatment['id']}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <hr>
        @endforeach
    </div>

    <div class="action-box">
        <h2>New Treatment</h2>
        <form action="/register-treatments" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            <input name="treatment_type" type="text" placeholder="Treatment Type" required>
            <br><br>
            <button
                style="background-color: blue; color: white; font-weight: bold;padding:10px; border-radius: 3rem">Register</button>
        </form>
    </div>

    <div class="display">
        <h2>Treatment History</h2>
                @foreach ($historyDisplay as $element)
                <div>
                    <h2>{{ $element->treatment_time}}:</h3>
                        {{ $element->treatment_type }}
                        on
                        {{ $element->raccoon_name }}
                </div>
            @endforeach
    </div>

    <div class="action-box">
        <h2>Perform Treatment</h2>
        <form action="/register-raccoon-treatment" method="POST">
            @csrf
            <label>Treatment </label>
            <select name="treatment_id" required>
                <option value="">Select Treatment Type</option>
                @foreach ($treatments as $treatment)
                    <option value="{{ $treatment['id'] }}">{{ $treatment['treatment_type'] }}</option>
                @endforeach
            </select>
            <label>on raccoon </label>
            <select name="raccoon_id" required>
                <option value="">Select Raccoon</option>
                @foreach ($raccoons as $raccoon)
                    <option value="{{ $raccoon['id'] }}">{{ $raccoon['raccoon_name'] }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Log Treatment</button>
        </form>
    </div>


</x-Layout>