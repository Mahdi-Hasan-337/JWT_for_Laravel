<section class="carousel-section" style="margin: 1rem 0rem">
    <div id="myCarousel" class="carousel slide text-center carousel-dark" data-bs-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
        </ol>

        <!-- Slides -->
        <div class="carousel-inner">
            <div class="carousel-item active c-item">
                <img src="{{ asset('images/home/caro_img1.png') }}" class="c-img w-100" alt="Carousel Image 1">
                <!-- width changed -->
            </div>
            <div class="carousel-item c-item">
                <img src="{{ asset('images/home/caro_img2.png') }}" class="c-img w-100" alt="Carousel Image 2">
                <div class="carousel-caption">

                    <p><a href="#" class="reg-btn btn btn-warning mt-3">Registration now</a></p>
                </div>
            </div>

        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev" style="color:black">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</section>
