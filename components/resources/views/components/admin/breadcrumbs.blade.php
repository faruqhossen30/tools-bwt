<div class="mt-2 d-print-none">
    <div class="align-items-center">
        <ol class="breadcrumb" aria-label="breadcrumbs">
          <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">{{ __('Admin') }}</a>
          </li>

          <li class="breadcrumb-item active" aria-current="page">
            <a>{{ __( ucwords( str_replace( '-', ' ', Route::currentRouteName() ) ) ) }}</a>
          </li>
      </ol>
  </div>
</div>       