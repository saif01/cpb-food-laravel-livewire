<div>

    <div class="page-wrapper">

        <!-- start: Inner page hero -->
        <div class="inner-page-hero hedader-bg">
            <div class="container">
                <h2 class="text-white">All Products</h2>
                <p class="lead text-white">We believe in better quality and service</p>
            </div>
            <!-- end:Container -->
        </div>

        <!-- end:Inner page hero -->
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ url('/') }}" class="active">Home</a></li>
                    <li class="text-danger">Products</li>
                </ul>
            </div>
        </div>

        <!-- //results show -->
        <section class="restaurants-page mt-2">
            <div class="container">
                <div class="row">

                    @foreach ($allData as $row )

                    <!-- Each popular food item starts -->
                    <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                        <div class="food-item-wrap">
                            <div class="figure-wrap bg-image zoom">
                                <img src="{{ asset($row->image) }}" height="211" width="392">
                                <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                            </div>
                            <div class="content">
                                <h5><a href="{{ url('/products-details/'.$row->id) }}">{{ Str::limit($row->title, $limit = 30 ) }}</a></h5>
                                <div class="product-name" style="height: 166px;"> {!! Str::limit($row->details, 300, '......') !!} <a href="{{ url('/products-details/'.$row->id) }}"> Read More.</a></div>

                                <div class="price-btn-block"> <span class="price">{{ $row->price }}/= Taka</span> <a href="{{ url('/products-details/'.$row->id) }}" class="btn theme-btn-dash pull-right">View Details</a> </div>
                            </div>

                        </div>
                    </div>
                    <!-- Each popular food item starts -->
                    @endforeach

                </div>

                <div>
                    {{ $allData->links() }}
                </div>
            </div>
        </section>

    </div>

</div>
