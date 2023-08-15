
@php
    $testimonialElement = getContent('service_list.element', false);
@endphp
<div class="promotion-section">
    <div class="w-container promotion-container">
        <h1 class="section-title">Dịch vụ doanh nghiệp</h1>
        <div class="title-underline"></div>

        <!-- Cards First Row --->

        <div class="promo-flex">
            @foreach ($testimonialElement as $items)
            <div data-ix="blog-card" class="w-clearfix w-preserve-3d promo-card">
                <img width="100%" style="height:200px" src="{{ getImage('assets/images/frontend/service_list/' . $items->data_values->image) }}">
                <div class="blog-bar color-pink"></div>
                <div class="blog-post-text">
                    <div class="blog-description pink-text">
                        DỊCH VỤ THÀNH LẬP DOANH NGHIỆP TRỌN GÓI
                        {{($items->data_values->title)}}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
