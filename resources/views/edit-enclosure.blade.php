<x-Layout heading="Edit Enclosure {{ $enclosure['enclosure_name'] }}">
    <div class="action-box">
        <form action="/edit-enclosure/{{ $enclosure['id'] }}" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
    </script>
            @csrf
            @method('PUT')
            <input name="enclosure_name" type="text" value="{{ $enclosure['enclosure_name'] }}" required>
            <br><br>
            <button>Save Changes</button>
        </form>
    </div>
</x-Layout>
