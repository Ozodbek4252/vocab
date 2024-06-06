@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Words') }}</h4>
                </div>
                <div class="table-responsive mb-3">
                    <livewire:words />
                </div>
            </div>
        </div>
    </div>
@endsection
