<div>
    <div class="d-flex justify-content-between align-items-center pb-3">
        <div class="card-title">
            {{ $words->links() }}
            <!-- Numerical Pagination Links with Ellipsis -->
            @include('livewire.pagination-links', ['words' => $words])
        </div>
        <div>
            <div class="btn-group me-1 mt-2">
                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    @if ($with_duplicate)
                        {{ __('body.With Duplicates') }}
                    @else
                        {{ __('body.Uniques') }}
                    @endif
                    <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <div wire:click="filterDuplicate()" class="dropdown-item know-option">
                        @if ($with_duplicate)
                            {{ __('body.Uniques') }}
                        @else
                            {{ __('body.With Duplicates') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <table class="table mb-0 mt-2">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>{{ __('body.Word') }}</th>
                <th>{{ __('body.Guide Word') }}</th>
                <th>{{ __('body.Level') }}</th>
                <th>{{ __('body.Type') }}</th>
                <th>{{ __('body.Status') }}</th>
                <th>{{ __('body.Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($words as $index => $word)
                <livewire:word :$word :count="$currentStartPosition + $index" wire:key="key-{{ $word->id }}" />
            @endforeach
        </tbody>
    </table>
    {{ $words->links() }}

    <!-- Numerical Pagination Links with Ellipsis -->
    @include('livewire.pagination-links', ['words' => $words])
</div>
