@extends('layouts.page')

@section('content')
    <style>
        .container_car_image {
            margin-top: 14px;
            height: 320px;
            width: 100%;
        }

        .img-node {
            display: flex;
            gap: 8px;
            width: 100%;
            height: 100%;

        }

        .image-index {
            width: 100%;
            height: 100%;
        }

        .image-childen {}

        .image-index-one {
            width: 90%;
            height: 50%;
            padding: 0 5px 0 5px;

        }

        .image-child {
            display: flex;

        }

        .image-index-two,
        .image-index-three {
            width: 45%;
            height: 30%;
            padding: 10px 5px 5px 5px;
        }

        .detial-price {
            width: 100%;
            height: 100%;
            text-align: center;


        }

        p {
            color: grey
        }

        .table-price {
            display: flex;
            justify-content: center;
            gap: 18px;
        }
    </style>

    <div class="container">
        <div class="container_car_image">
            <div class="img-node">
                <img class="image-index"
                    src="https://www.usnews.com/object/image/00000191-d821-d8b8-adf7-f97944b10000/chevrolet-corvette-zr1-coupe-001.jpg?update-time=1725907944302&size=responsiveGallery"
                    alt="Car Image">
                <div class="image-childen">
                    <img class="image-index-one"
                        src="https://www.usnews.com/object/image/00000191-d821-d8b8-adf7-f97944b10000/chevrolet-corvette-zr1-coupe-001.jpg?update-time=1725907944302&size=responsiveGallery"
                        alt="Car Image">
                    <div class="image-child">
                        <img class="image-index-two"
                            src="https://www.usnews.com/object/image/00000191-d821-d8b8-adf7-f97944b10000/chevrolet-corvette-zr1-coupe-001.jpg?update-time=1725907944302&size=responsiveGallery"
                            alt="Car Image">
                        <img class="image-index-three"
                            src="https://www.usnews.com/object/image/00000191-d821-d8b8-adf7-f97944b10000/chevrolet-corvette-zr1-coupe-001.jpg?update-time=1725907944302&size=responsiveGallery"
                            alt="Car Image">
                    </div>

                </div>
                <div class="detial-price">
                    <h2>39,990,990</h2>
                    <p>ราคารวมมูลค่าของแถมเเล้ว</p>
                    <div class="table-price">
                        <div class="">เลขไมค์</div>
                        <div class="">29,687 กม.</div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

    </div>
@endsection
