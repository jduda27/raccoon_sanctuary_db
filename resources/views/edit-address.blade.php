<x-Layout heading="Edit Address ">
    <div class="action-box">
        <form action="/edit-address/{{ $address['id']}}"method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            @method('PUT')
            <label>Street Address</label>
            <input name="street_address" type="text" value="{{$address['street_address']}}" required>
            <label>City</label>
            <input name="city" type="text" value="{{$address['city']}}" required>
            <label>State</label>
            <input name="state" type="text" value="{{$address['state']}}" required>
            <label>Zipcode</label>
            <input name="zipcode" type="text" value="{{$address['zipcode']}}" required>
            <br><br>
            <button>Save Changes</button>
        </form>
    </div>
</x-Layout>
