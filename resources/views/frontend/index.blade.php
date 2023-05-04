@extends('layouts.app')

@section('title', 'Home Page')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <style>
        .slide-container {
            max-width: 1120px;
            width: 100%;
            background-color: #f9f5f5;
            padding: 40px 0;
            border-radius: 15px
        }

        .card-image {
            position: relative;
            height: 150px;
            width: 150px;
        }

        .card-image .card-img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .card {
            position: relative;
            /* width: 320px; */
            border-radius: 5px;
            background-color: #fff;
        }

        .card .card-border {
            position: absolute;
            top: -3%;
            left: -5%;
            z-index: 1;
            border: 1px solid #6ee0ff;
            border-radius: 12px;
            background-color: #6ee0ff;
            padding: 2px 3px
        }


        .overplay {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background-color: #d0ddff5f;
            border-radius: 25px 25px 0 0;
        }

        .slide-content,
        .slide-content2 {
            margin: 0 40px;
        }

        .image-content,
        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 14px;
        }

        .image-content {
            position: relative;
            row-gap: 5px
        }

        .name {
            font-size: 18px;
            font-weight: 500;
            white-space: nowrap;
            width: 160px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .description {
            font-size: 14px;
            color: #707070;
            text-align: center;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }


        .swiper-slide img {
            display: block;
            width: 100%;
            /* height: 100%; */
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($sliders as $sliderItem)
                <div class="swiper-slide">
                    <img height="600px" src="{{ $sliderItem->image }}" alt="">
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination wp0"></div>
    </div>
    <h5 class="mt-2 ml-1 text-uppercase">Trending Product</h5>
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                @foreach ($prod as $prodItem)
                    <div class="swiper-slide card">
                        <h6 class="card-border text-light">Trending</h6>
                        <div class="image-content">
                            <span class="overplay"></span>
                            <div class="card-image">
                                <img class="card-img" src="{{ $prodItem->productImages[0]->image }}" alt="">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name text-info">{{ $prodItem->name }}</h2>
                            <span class="decription mb-3">
                                <span class="mr-5 text-danger"><s>${{ $prodItem->original_price }}</s></span>
                                <span class="text-primary">${{ $prodItem->selling_price }}</span>
                            </span>

                            <a href="{{ url('collections/' . $prodItem->category->slug . '/' . $prodItem->slug) }}"
                                class="btn btn-sm btn-outline-primary">View more</a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-pagination wp"></div>
    </div>
    <h5 class="mt-2 ml-1 text-uppercase">New Product</h5>
    <div class="slide-container swiper ">
        <div class="slide-content2">
            <div class="card-wrapper swiper-wrapper">
                @foreach ($prodNew as $prodNewItem)
                    <div class="swiper-slide card">
                        <h6 class="card-border text-light">New</h6>
                        <div class="image-content">
                            <span class="overplay"></span>
                            <div class="card-image">
                                <img class="card-img" src="{{ $prodNewItem->productImages[0]->image }}" alt="">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name text-info">{{ $prodNewItem->name }}</h2>
                            <span class="decription mb-3">
                                <span class="mr-5 text-danger"><s>${{ $prodNewItem->original_price }}</s></span>
                                <span class="text-primary">${{ $prodNewItem->selling_price }}</span>
                            </span>

                            <a href="{{ url('collections/' . $prodNewItem->category->slug . '/' . $prodNewItem->slug) }}"
                                class="btn btn-sm btn-outline-primary">View more</a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-pagination wp2"></div>
    </div>
    <div class="mx-2">
        <h5 class="mb-4 text-uppercase">Blog</h5>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img src="https://cdn.tuoitre.vn/zoom/212_132/2022/11/4/sgk-moi-1-16675240054552586592-crop-16675241853901320468354.jpg"
                        alt="">
                    <label class="mt-2" style="color:#000; height: 60px" for="">Nhà nước định giá sách giáo khoa
                        là hợp lý</label>
                    <div class="mt-3" style="color:#808080;height: 150px">
                        <p>Dù giá trị không nhiều nhưng sách giáo khoa là mặt hàng đặc biệt với đối tượng phục vụ, tác động
                            rất đông đảo, rộng rãi. Đồng thời, liên quan nhiều thành phần, gia đình trong xã hội.</p>
                    </div>

                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <img src="https://cdn.tuoitre.vn/zoom/212_132/2022/11/4/t62a9852-16675435041951012365028-crop-16675439865511287053748.jpg"
                        alt="">
                    <label class="mt-2" style="color:#000; height: 60px" for="">Khai quật khu đất 4.000m2, nơi
                        Công ty Sài Gòn Group xả bậy chất thải hầm cầu</label>
                    <div class="mt-3" style="color:#808080;height: 150px">
                        <p>Liên quan đến thông tin trong loạt bài điều tra của Tuổi Trẻ 'từ dán quảng cáo bậy đến lừa hút
                            hầm cầu', cơ quan chức năng đang khai quật khu đất nơi Công ty Sài Gòn Group xả bậy chất thải
                            hầm cầu để có cơ sở xử lý.</p>
                    </div>

                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <img src="https://cdn.tuoitre.vn/zoom/212_132/2022/11/4/giao-luu-bussi-7-166753885510217036326-crop-16675388675311090327657.jpg"
                        alt="">
                    <label class="mt-2" style="color:#000; height: 60px" for="">Michel Bussi và phương pháp phê
                        bình trinh thám trong ‘Mã 612: Ai đã giết Hoàng tử bé?’</label>
                    <div class="mt-3" style="color:#808080;height: 150px">
                        <p>Nhà văn Pháp Michel Bussi đã sử dụng phương pháp phê bình trinh thám: Ai đã
                            giết Hoàng tử bé?, mà theo dịch giả Bảo Chân, thể loại này còn ít thấy ở thị trường xuất bản
                            Việt Nam và cũng là lần đầu tiên tác giả sử dụng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".wp0",
            },
            mousewheel: true,
            keyboard: true,
        });


        var swiper = new Swiper(".slide-content", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".wp",
                clickable: true,
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                "@1.50": {
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
            },
        });

        var swiper = new Swiper(".slide-content2", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".wp2",
                clickable: true,
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                "@1.50": {
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
            },
        });
    </script>
@endsection
