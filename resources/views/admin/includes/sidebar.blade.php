<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ Route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('/' . $logo->small_logo) }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('/' . $logo->main_logo) }}" style="max-height: 30px; height: auto" alt="">
            </span>
        </a>

        <a href="{{ Route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('/' . $logo->small_logo) }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('/' . $logo->main_logo) }}" alt="" height="20">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('words.index') }}" class="waves-effect">
                        <i class="uil-book-alt"></i>
                        <span>{{ __("body.Words") }}</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-cog"></i>
                        <span>{{ __('body.Settings') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ Route('langs.index') }}">{{ __('body.Lang') }}</a></li>
                        <li><a href="{{ Route('logos.index') }}">{{ __('body.Logo') }}</a></li>
                        <li @if (Route::currentRouteName() == 'seos.edit') class="mm-active" @endif>
                            <a href="{{ Route('seos.index') }}">SEO</a>
                        </li>
                        <li><a href="{{ Route('icons.index') }}">{{ __('body.Icons') }}</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
