@extends('layouts.app')

@section('title', '3')

@section('content')
<div class="container mt-5">
    <h1>Create Polling Unit and Add Results</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('new-polling-unit.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="polling_unit_name" class="form-label">Polling Unit Name:</label>
            <input type="text" class="form-control @error('polling_unit_name') is-invalid @enderror" name="polling_unit_name" id="polling_unit_name" value="{{ old('polling_unit_name') }}" required>
            @error('polling_unit_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lga_id" class="form-label">LGA:</label>
            <select class="form-control @error('lga_id') is-invalid @enderror" name="lga_id" id="lga_id" required>
                <option value="">Select LGA</option>
                @foreach($lgas as $lga)
                    <option value="{{ $lga->lga_id }}">{{ $lga->lga_name }}</option>
                @endforeach
            </select>
            @error('lga_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ward_id" class="form-label">Ward:</label>
            <select class="form-control @error('ward_id') is-invalid @enderror" name="ward_id" id="ward_id" required>
                <option value="">Select Ward</option>
            </select>
            @error('ward_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="polling_unit_id" class="form-label">Polling Unit:</label>
            <select class="form-control @error('polling_unit_id') is-invalid @enderror" name="polling_unit_id" id="polling_unit_id" required>
                <option value="">Select Polling Unit</option>
                @for ($i = 1; $i <= 20; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
            </select>
            @error('polling_unit_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="polling_unit_number" class="form-label">Polling Unit Number:</label>
            <input type="number" class="form-control @error('polling_unit_number') is-invalid @enderror" name="polling_unit_number" id="polling_unit_number" value="{{ old('polling_unit_number') }}" required>
            @error('polling_unit_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="polling_unit_description" class="form-label">Description:</label>
            <textarea class="form-control @error('polling_unit_description') is-invalid @enderror" name="polling_unit_description" id="polling_unit_description">{{ old('polling_unit_description') }}</textarea>
            @error('polling_unit_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="entered_by_user" class="form-label">Entered By:</label>
            <input type="text" class="form-control @error('entered_by_user') is-invalid @enderror" name="entered_by_user" id="entered_by_user" value="Admin" readonly>
            @error('entered_by_user')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="user_ip_address" class="form-label">IP Address:</label>
            <input type="text" class="form-control @error('user_ip_address') is-invalid @enderror" name="user_ip_address" id="user_ip_address" value="{{ request()->ip() }}" readonly>
            @error('user_ip_address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <h2>Add Results for Polling Unit</h2>
        <div id="results-container">
            <div class="result mb-3">
                <label for="party_abbreviation_0" class="form-label">Party Abbreviation:</label>
                <input type="text" class="form-control @error('results.0.party_abbreviation') is-invalid @enderror" name="results[0][party_abbreviation]" id="party_abbreviation_0" maxlength="4" value="{{ old('results.0.party_abbreviation') }}" required>
                @error('results.0.party_abbreviation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="party_score_0" class="form-label">Party Score:</label>
                <input type="number" class="form-control @error('results.0.party_score') is-invalid @enderror" name="results[0][party_score]" id="party_score_0" value="{{ old('results.0.party_score') }}" required>
                @error('results.0.party_score')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="add-party-btn">+ Add Another Party</button>

        <div class="mb-3 mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let lgaSelect = document.getElementById('lga_id');
    let wardSelect = document.getElementById('ward_id');
    let pollingUnitSelect = document.getElementById('polling_unit_id');
    let resultsContainer = document.getElementById('results-container');
    let addPartyBtn = document.getElementById('add-party-btn');
    let partyCount = 1;

    lgaSelect.addEventListener('change', function () {
        let lga_id = this.value;
        if (lga_id) {
            fetch(`/wards/${lga_id}`)
                .then(response => response.json())
                .then(data => {
                    wardSelect.innerHTML = '<option value="">Select Ward</option>';
                    data.forEach(ward => {
                        wardSelect.innerHTML += `<option value="${ward.ward_id}">${ward.ward_name}</option>`;
                    });
                    wardSelect.disabled = false;
                });
        } else {
            wardSelect.innerHTML = '<option value="">Select Ward</option>';
            wardSelect.disabled = true;
        }
    });

    wardS

    addPartyBtn.addEventListener('click', function () {
        let newResultDiv = document.createElement('div');
        newResultDiv.classList.add('result', 'mb-3');
        newResultDiv.innerHTML = `
            <label for="party_abbreviation_${partyCount}" class="form-label">Party Abbreviation:</label>
            <input type="text" class="form-control" name="results[${partyCount}][party_abbreviation]" id="party_abbreviation_${partyCount}" maxlength="4" required>
            <label for="party_score_${partyCount}" class="form-label">Party Score:</label>
            <input type="number" class="form-control" name="results[${partyCount}][party_score]" id="party_score_${partyCount}" required>
        `;
        resultsContainer.appendChild(newResultDiv);
        partyCount++;
    });
});
</script>
@endsection
