<div class="offset-sm-3 col-sm-6 mt-5">
    <div class="card text-center shadow-lg rounded-3">
        <div class="card-header"><h4>{{ $weatherByZipCode->getLocation() .', '. $weatherByZipCode->getZipCode() }}</h4></div>
        <div class="card-body">
            <h2 class="card-title {{ $weatherByZipCode->getTemperature() < 70 ? 'text-info' : 'text-danger' }}">{{ $weatherByZipCode->getTemperature() }} <span>&#8457;</span></h2>
        </div>
        <div class="card-footer text-muted"><p class="text-muted">{{ $weatherByZipCode->getDayTime() }}</p></div>
    </div>
</div>

