@extends('layouts.app')
@section('title') 2 @endsection
@section('content')
    <div class="container">
        <h1 class="mt-4">View LGA Summary Results</h1>
        
        <div class="form-group">
            <label for="lgaSelect">Select Local Government Area:</label>
            <select id="lgaSelect" class="form-control">
                <option value="">Select LGA</option>
                @foreach($lgas as $lga)
                    <option value="{{ $lga->lga_id }}">{{ $lga->lga_name }}</option>
                @endforeach
            </select>
        </div>

        <div id="summaryResults" class="mt-4"></div>
    </div>

    <script>
        document.getElementById('lgaSelect').addEventListener('change', function() {
            var lga_id = this.value;
            if (lga_id) {
                document.getElementById('summaryResults').innerHTML = ''; // Clear previous results
                fetch(`/lga-summary/${lga_id}`)
                    .then(response => response.json())
                    .then(data => {
                        var summaryResultsDiv = document.getElementById('summaryResults');
                        if (Object.keys(data).length === 0) {
                            summaryResultsDiv.innerHTML = '<div class="alert alert-danger alert-dismissible fade show">No results found for this LGA <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        } else {
                            var summaryHtml = '<h2>Summary Results</h2><table class="table table-bordered"><thead><tr><th>Party</th><th>Total Score</th></tr></thead><tbody>';
                            for (var party in data) {
                                if (data.hasOwnProperty(party)) {
                                    summaryHtml += `<tr><td>${party}</td><td>${data[party]}</td></tr>`;
                                }
                            }
                            summaryHtml += '</tbody></table>';
                            summaryResultsDiv.innerHTML = summaryHtml;
                        }
                    });
            } else {
                document.getElementById('summaryResults').innerHTML = '';
            }
        });
    </script>
@endsection
