@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Upload CSV file to insert into database.') }}

                    <br><br>

                    <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="csv_file" accept=".csv">
                        <button type="submit">Upload CSV</button>
                    </form>

                    <br>
                    <br>

                    <div id="progressBarContainer" style="display: none;">
                        <div id="progressBar" style="width: 0;"></div>
                        <div id="progressText">0%</div>
                    </div>

                    <script>
                        function uploadFile() {
                            const form = document.getElementById('uploadForm');
                            const progressBarContainer = document.getElementById('progressBarContainer');
                            const progressBar = document.getElementById('progressBar');
                            const progressText = document.getElementById('progressText');

                            const formData = new FormData(form);

                            axios.post(form.action, formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data',
                                },
                                onUploadProgress: function (progressEvent) {
                                    const progress = Math.round((progressEvent.loaded * 100) / progressEvent.total);

                                    progressBar.style.width = progress + '%';
                                    progressText.innerText = progress + '%';
                                },
                            })
                            .then(response => {
                                console.log(response.data);
                                // Add any additional logic after successful upload
                            })
                            .catch(error => {
                                console.error(error);
                                // Handle errors
                            });
                            
                            // Show progress bar container
                            progressBarContainer.style.display = 'block';
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
