@foreach ($roomType as $type)
    <div class="{{ $class }}">
        <div class="room-card">
            <div class="room-card__thumb">
                <img alt="image" src="{{ getImage(getFilePath('roomTypeImage') . '/' . @$type->images->first()->image, getFileSize('roomTypeImage')) }}">
                <ul class="room-card__utilities">
                    @foreach ($type->amenities->take(4) as $amenity)
                        <li data-bs-placement="right" data-bs-toggle="tooltip" title="{{ $amenity->title }}">
                            @php echo $amenity->icon  @endphp
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="room-card__content">
                <h3 class="title mb-2"><a href="{{ route('room.type.details', [$type->id, slug($type->name)]) }}">{{ __($type->name) }}</a>
                </h3>
                <div class="room-card__bottom justify-content-between align-items-center mt-2 gap-3">
                    <div>
                        <h6 class="price text--base">
                            {{ showAmount($type->fare) }}
                            {{ $general->cur_text }} / @lang('Đêm')
                        </h6>

                        @isset($type->available_rooms)
                            <small class="text--muted ">
                                @lang('Phòng trống'): {{ $type->available_rooms }}
                            </small>
                        @endisset

                        <div class="room-capacity text--base d-flex align-items-center justify-content-center flex-wrap gap-3 mt-3">
                            <span class="custom--badge">
                                @lang('Người lớn') &nbsp; {{ $type->total_adult }}
                            </span>
                            <span class="custom--badge">
                                @lang('trẻ em') &nbsp; {{ $type->total_child }}
                            </span>

                            <a class="btn btn-sm btn--base" href="{{ route('room.type.details', [$type->id, slug($type->name)]) }}">
                                <i class="la la-desktop me-2"></i>@lang('Book Now')
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endforeach
