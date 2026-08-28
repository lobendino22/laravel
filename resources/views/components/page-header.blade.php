<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>{{ $pagetitle }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>{{ $pagetitle }}</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="" class="btn btn-primary">Actions</a>
        </div>
    </div>
</div>
