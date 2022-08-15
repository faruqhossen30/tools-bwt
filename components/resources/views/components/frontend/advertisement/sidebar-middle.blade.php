@switch( $advertisement->sidebar_middle_align )
    @case('left')
		<div class="sidebar_middle d-flex justify-content-start" style="margin:{{ $advertisement->sidebar_middle_margin }}px;">
			{!! $advertisement->sidebar_middle !!}
		</div>

    @break

    @case('right')
		<div class="sidebar_middle d-flex justify-content-end" style="margin:{{ $advertisement->sidebar_middle_margin }}px;">
			{!! $advertisement->sidebar_middle !!}
		</div>
    @break

    @default
		<div class="sidebar_middle d-flex justify-content-center" style="margin:{{ $advertisement->sidebar_middle_margin }}px;">
			{!! $advertisement->sidebar_middle !!}
		</div>
@endswitch