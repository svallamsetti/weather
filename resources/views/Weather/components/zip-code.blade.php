<div class="offset-sm-3 col-sm-6 mt-5">
    <div class="card shadow-lg">
        <div class="card-header">
            <h2>Weather App</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/weather') }}">
                @csrf
                <div class="form-group">
                    <label for="zipCode">Zip Code:*</label>
                    <input type="number" class="form-control" name="zipCode" id="zipCode" value="{{ old('zipCode') }}" required/>
                </div>
                <button class="btn btn-block btn-success zip-code-search" type="submit">Search
                    <span class="spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
            </form>
        </div>
    </div>
</div>
