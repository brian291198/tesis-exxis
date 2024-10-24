<form action="{{ route('periodos.listpag') }}" method="POST">
    @csrf
    <label for="recordsPerPage">Registros por página:</label>
    <select id="recordsPerPage" name="records" class="form-select" onchange="this.form.submit()">
        <option value="5" {{ $numRecords == 5 ? 'selected' : '' }}>5</option>
        <option value="10" {{ $numRecords == 10 ? 'selected' : '' }}>10</option>
        <option value="20" {{ $numRecords == 20 ? 'selected' : '' }}>20</option>
        <option value="50" {{ $numRecords == 50 ? 'selected' : '' }}>50</option>
        <option value="100" {{ $numRecords == 100 ? 'selected' : '' }}>100</option>
        <option value="300" {{ $numRecords == 300 ? 'selected' : '' }}>300</option>
        <option value="500" {{ $numRecords == 500 ? 'selected' : '' }}>500</option>
        <option value="1000" {{ $numRecords == 1000 ? 'selected' : '' }}>1000</option>
    </select>
</form>
