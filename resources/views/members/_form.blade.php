@csrf

<div class="form-grid">
    <label>
        Nama
        <input type="text" name="name" value="{{ old('name', $member->user->name ?? '') }}" required>
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror
    </label>

    <label>
        Password {{ isset($member) ? '(Kosongkan jika tidak diubah)' : '' }}
        <input type="password" name="password" {{ isset($member) ? '' : 'required' }}>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror
    </label>

    <label>
        Kelas
        <select name="class_id" required>
            <option value="">Pilih kelas</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}" @selected(old('class_id', $member->class_id ?? '') == $class->id)>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
        @error('class_id')
            <span class="error">{{ $message }}</span>
        @enderror
    </label>

    <label>
        Regu
        <select name="team_id" required>
            <option value="">Pilih regu</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}" @selected(old('team_id', $member->team_id ?? '') == $team->id)>
                    {{ $team->name }} ({{ $team->gender === 'male' ? 'Cowok' : 'Cewek' }})
                </option>
            @endforeach
        </select>
        @error('team_id')
            <span class="error">{{ $message }}</span>
        @enderror
    </label>

    @if (! isset($member))
        <label>
            Total Poin Awal
            <input type="number" name="total_points" value="{{ old('total_points', 0) }}">
            @error('total_points')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>
    @endif
</div>

<div class="actions" style="margin-top: 20px;">
    <button type="submit" class="button">{{ $submitLabel }}</button>
    <a href="{{ route('members.index') }}" class="button secondary">Batal</a>
</div>
