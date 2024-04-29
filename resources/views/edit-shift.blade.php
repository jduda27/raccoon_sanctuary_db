<x-Layout heading="Edit Shift">
<div class="action-box">
        <form action="/edit-shift/{{$shift['id']}}" method="POST">
            <script>
        @if (session()->has('error'))
            alert('{{ session()->get('error') }}')
        @endif
        </script>
            @csrf
            @method('PUT')
            <label>Sanctuary</label>
            <select name="schedule_id" required>
                <option value="">Select Sanctuary</option>
                @foreach ($schedules as $schedule)
                    <option value="{{$schedule->id}}">{{ $schedule->sanctuary_name }}</option>
                @endforeach
            </select>
            <br><br>
            <label>Date</label>
            <input name="date" type="date" value="{{$shift['start_time']}}" required>
            <label>Start Time</label>
            <input name="start_time" type="time" value={{$shift['start time']}} required>
            <label>End Time</label>
            <input name="end_time" type="time" value={{$shift['end time']}} required>
            <br><br>
            <labeL>Employee:</label>
            <select name="employee_id" required>
                <option value="">Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->role_name }}</option>
                @endforeach
            </select>
            <br><br>
            <button>Save Changes</button>
        </form>
    </div>
</x-Layout>