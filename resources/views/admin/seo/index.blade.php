@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">SEO</h4>
                    <div>
                        <a href="{{ Route('seos.edit', $seo->id) }}" class="btn btn-warning waves-effect waves-light">
                            <i class="fas fa-plus"></i>
                            {{ __('body.Edit') }}
                        </a>
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td>{{ __('body.Title') }}</td>
                                <td>{{ $seo->translations['title']['content'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Description') }}</td>
                                <td>{{ $seo->translations['description']['content'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Keywords') }}</td>
                                <td>{{ $seo->keywords }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
