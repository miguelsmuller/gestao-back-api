@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron py-4 mb-3">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-center text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Primary card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Success card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Warning card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Danger card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
</div>
@endsection
