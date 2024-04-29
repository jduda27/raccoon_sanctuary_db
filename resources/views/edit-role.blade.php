<x-Layout heading="Edit Role {{ $role['role_name'] }}">
<div class="action-box">
        <form action="/edit-role/{{$role['id']}}" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            @method('PUT')
            <input name="role_name" type="text" value="{{$role['role_name']}}" required>
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
            <button>Save Changes</button>
        </form>
    </div>
</x-Layout>