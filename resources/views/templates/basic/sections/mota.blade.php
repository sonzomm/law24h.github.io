@php
 $blogContent  = getContent('blog.content', true);
 $blogElements = getContent('blog.content', false, 3, true);
@endphp

<div class="cir">
    <div class="person">
        <div class="container1">
            <div class="container-inner">
                <div class="circle">
                    <img src="{{asset('images/law.png')}}" alt="">
                </div>

            </div>
        </div>
        <div class="name">THÀNH LẬP DOANH NGHIỆP</div>

    </div>
    <div class="person">
        <div class="container1">
            <div class="container-inner">

                <div class="circle">
                    <img src="{{asset('images/law.png')}}" alt="">
                </div>
            </div>
        </div>

        <div class="name">GIẢI THỂ DOANH NGHIỆP</div>

    </div>
    <div class="person">
        <div class="container1">
            <div class="container-inner">
                <div class="circle">
                    <img src="{{asset('images/law.png')}}" alt="">
                </div>
            </div>
        </div>

        <div class="name">CHỮ KÝ SỐ</div>

    </div>
</div>

<div class="content-size-sl">
    <div class="flex-col">
        <div class="col xs-12 m-6">
            <div class="teaser-element-container">
                <img src="{{asset('images/list.png')}}" alt="">

                <p>
                <h3>THÀNH LẬP DOANH NGHIỆP</h3>
                Quy trình thành lập công ty mới nhất
                Dịch vụ tư vấn thành lập doanh nghiệp giá rẻ Luật 24h
                Ưu điểm của dịch vụ thành lập doanh nghiệp trọn gói
                Dịch vụ tư vấn thành lập doanh nghiệp trọn gói, giá rẻ
                </p>
            </div>
        </div>
        <div class="col xs-12 m-6">
            <div class="teaser-element-container">
                <img src="{{asset('images/list.png')}}" alt="">

                <p>
                <h3>GIẢI THỂ DOANH NGHIỆP </h3>
                Giải thể doanh nghiệp cần những thủ tục gì?
                Những điều cần biết về giải thể doanh nghiệp
                Bảng giá giải thể doanh nghiệp
                Dịch vụ giải thể doanh nghiệp 0 đồng trọn gói
                </p>
            </div>
        </div>
    </div>
</div>

<div class="wp-block-columns has-2-columns swapped-columns two-step-gradient">
    <div class="wp-block-column no-padding">
        <figure class="wp-block-image wp-block-image-scale" data-ghostkit-sr="fade-up;distance:150px;delay:1">
            <img src="{{ getImage('assets/images/frontend/blog/'.$blogContent->data_values->image) }}" alt="">
        </figure>
    </div>

    <div class="wp-block-column padding-right">

        <h2 class="wp-block-heading" id="reach-and-grow-your-audience" data-ghostkit-sr="fade-up">
                {{($blogContent->data_values->heading)}}
        </h2>
        <p data-ghostkit-sr="fade-up"> {{($blogContent->data_values->subheading)}}</p>

        <p class="feature-cta-group">
            <a class="button button-secondary" data-video="https://player.vimeo.com/video/223581490" href="https://vimeo.com/223581490" target="_blank" rel="noopener">
                Xem thêm
            </a>
        </p>
    </div>
</div>

