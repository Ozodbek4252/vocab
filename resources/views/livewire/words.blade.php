<div>
    {{ $words->links() }}
    <!-- Numerical Pagination Links with Ellipsis -->
    @include('livewire.pagination-links', ['words' => $words])

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
