<x-Layout heading="Edit Sanctuary {{$sanctuary['sanctuary_name']}}">
<div class="action-box">
        <form action="/edit-sanctuary/{{$sanctuary['id']}}" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            @method('PUT')
            <input name="sanctuary_name" type="text" value={{$sanctuary['sanctuary_name']}} required>
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
</x-Layout>