@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">{{ __('body.Edit SEO') }}</h4>

                            <div class="my-2">
                                <a href="{{ Route('seos.index') }}"
                                    class="btn btn-secondary btn-soft-secondary waves-effect
                                        waves-light d-flex align-items-center justify-content-between">
                                    <i class='bx bx-arrow-back'></i>
                                    {{ __('body.Back') }}
                                </a>
                            </div>
                        </div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($langs as $lang)
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab"
                                        href="ui-tabs-accordions.html#navtabs-{{ $lang->code }}" role="tab">
                                        <span class="d-none d-sm-block">
                                            <img src="/{{ $lang->icon }}" style="width: 20px; height: auto;"
                                                alt="user-image" class="me-1">
                                            {{ $lang->name }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <form action="{{ Route('seos.update', $seo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                @foreach ($langs as $lang)
                                    <div class="tab-pane" id="navtabs-{{ $lang->code }}" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="seo-description-{{ $lang->code }}">
                                                        {{ __('body.Description') }}<span class="text-danger">*</span>
                                                    </label>
                                                    <input name="title_{{ $lang->code }}"
                                                        value="@if (isset($seo->translations[$lang->code])){{ $seo->translations[$lang->code]['title']['content'] }}@endif"
                                                        type="text" placeholder="{{ __('body.Enter title') }}..."
                                                        class="form-control" id="seo-title-{{ $lang->code }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="seo-description-{{ $lang->code }}">
                                                        {{ __('body.Description') }}<span class="text-danger">*</span>
                                                    </label>
                                                    <textarea placeholder="{{ __('body.Enter description') }}..." name="description_{{ $lang->code }}"
                                                        id="seo-description-{{ $lang->code }}" class="form-control">@if (isset($seo->translations[$lang->code]) && isset($seo->translations[$lang->code]['description'])){{ $seo->translations[$lang->code]['description']['content'] }}@endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="seo-keywords">
                                                {{ __('body.Keywords') }}<span class="text-danger">*</span>
                                            </label>
                                            <textarea placeholder="{{ __('body.Enter keywords') }}..." name="keywords" id="seo-keywords" class="form-control">{{ $seo->keywords }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="form-label" style="opacity: 0;">|</label>
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light form-control">
                                                {{ __('body.Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // add active class to the first nav-link
            $('.nav-link').first().addClass('active');
            $('.tab-pane').first().addClass('active');

            $('.nav-link').click(function() {
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
            });
            $('.tab-pane').click(function() {
                $('.tab-pane').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endsection
