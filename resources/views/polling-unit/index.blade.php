@extends('layouts.app')
@section('title') 1 @endsection
@section('content')
    <div class="container">
        <h1 class="mt-4">View Polling Unit Results</h1>
        
        <form id="pollingUnitForm">
            <div class="form-group">
                <label for="lgaSelect">Select Local Government Area:</label>
                <select id="lgaSelect" class="form-control">
                    <option value="">Select LGA</option>
                    @foreach($lgas as $lga)
                        <option value="{{ $lga->lga_id }}">{{ $lga->lga_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="wardSelect">Select Ward:</label>
                <select id="wardSelect" class="form-control" disabled>
                    <option value="">Select Ward</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="pollingUnitSelect">Select Polling Unit:</label>
                <select id="pollingUnitSelect" class="form-control" disabled>
                    <option value="">Select Polling Unit</option>
                </select>
            </div>
        </form>

        <div id="results" class="mt-4"></div>
    </div>

    <script>
        document.getElementById('lgaSelect').addEventListener('change', function() {
            var lga_id = this.value;
            if (lga_id) {
                fetch(`/wards/${lga_id}`)
                    .then(response => response.json())
                    .then(data => {
                        var wardSelect = document.getElementById('wardSelect');
                        wardSelect.innerHTML = '<option value="">Select Ward</option>';
                        data.forEach(ward => {
                            wardSelect.innerHTML += `<option value="${ward.ward_id}">${ward.ward_name}</option>`;
                        });
                        wardSelect.disabled = false;
                    });
            } else {
                document.getElementById('wardSelect').innerHTML = '<option value="">Select Ward</option>';
                document.getElementById('wardSelect').disabled = true;
                document.getElementById('pollingUnitSelect').innerHTML = '<option value="">Select Polling Unit</option>';
                document.getElementById('pollingUnitSelect').disabled = true;
                document.getElementById('results').innerHTML = '';
            }
        });

        document.getElementById('wardSelect').addEventListener('change', function() {
            var ward_id = this.value;
            var lga_id = document.getElementById('lgaSelect').value;
            if (ward_id && lga_id) {
                fetch(`/polling-units/${ward_id}/units?lga_id=${lga_id}`)
                    .then(response => response.json())
                    .then(data => {
                        var pollingUnitSelect = document.getElementById('pollingUnitSelect');
                        pollingUnitSelect.innerHTML = '<option value="">Select Polling Unit</option>';
                        data.forEach(unit => {
                            pollingUnitSelect.innerHTML += `<option value="${unit.polling_unit_id}">${unit.polling_unit_name}</option>`;
                        });
                        pollingUnitSelect.disabled = false;
                    });
            } else {
                document.getElementById('pollingUnitSelect').innerHTML = '<option value="">Select Polling Unit</option>';
                document.getElementById('pollingUnitSelect').disabled = true;
                document.getElementById('results').innerHTML = '';
            }
        });

        document.getElementById('pollingUnitSelect').addEventListener('change', function() {
            var polling_unit_id = this.value;
            var ward_id = document.getElementById('wardSelect').value;
            var lga_id = document.getElementById('lgaSelect').value;
            if (polling_unit_id && ward_id && lga_id) {
                document.getElementById('results').innerHTML = ''; // Clear previous results
                fetch(`/polling-units/${polling_unit_id}/results?ward_id=${ward_id}&lga_id=${lga_id}`)
                    .then(response => response.json())
                    .then(data => {
                        var resultsDiv = document.getElementById('results');
                        if (data.error) {
                            resultsDiv.innerHTML = '<div class="alert alert-danger">Polling unit not found</div>';
                        } else {
                            var resultsHtml = '<h2>Results</h2><table class="table table-bordered"><thead><tr><th>Party</th><th>Score</th></tr></thead><tbody>';
                            data.forEach(result => {
                                resultsHtml += `<tr><td>${result.party_abbreviation}</td><td>${result.party_score}</td></tr>`;
                            });
                            resultsHtml += '</tbody></table>';
                            resultsDiv.innerHTML = resultsHtml;
                        }
                    });
            } else {
                document.getElementById('results').innerHTML = '';
            }
        });
    </script>
@endsection
