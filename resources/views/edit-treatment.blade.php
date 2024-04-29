<x-Layout heading="Edit Treatment {{ $treatment['treatment_type'] }}">
    <div class="action-box">
        <form action="/edit-treatment/{{ $treatment['id'] }}" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            @method('PUT')
            <Label>Treatment Type</Label>
            <br>
            <input type="text" name="treatment_type" value="{{ $treatment['treatment_type'] }}">
            <br><br>
            <button>Save changes</button>
        </form>
    </div>
</x-Layout>
