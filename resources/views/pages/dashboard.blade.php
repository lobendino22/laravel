@extends('layouts.app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Dashboard</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="" class="btn btn-primary">Actions</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Widget 1</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="m-xs">Run</h1>
                        <h3 class="font-bold no-margins">Notification</h3>
                        <small>We detected an error.</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Widget 2</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="m-xs">520</h1>
                        <h3 class="font-bold no-margins">Likes</h3>
                        <small>Emojis.</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Widget 3</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="m-xs">Warning</h1>
                        <h3 class="font-bold no-margins">Do</h3>
                        <small>Something right.</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Widget 4</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="m-xs">Info</h1>
                        <h3 class="font-bold no-margins">Check</h3>
                        <small>Status update.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Report for 2024</h5>
                        <small>Company Financial Status</small>
                    </div>
                    <div class="ibox-content">
                        <h5>Report for 2024</h5>
                        <small>Company Financial Status</small>
                    </div>
                    <div class="ibox-footer">
                        <button type="button" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Recent Activity</h5>
                    </div>
                    <div class="ibox-content">
                        <p>Activity summary goes here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
