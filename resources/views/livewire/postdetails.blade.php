<div>
    <div class="page-wrapper">
        <!-- start: Inner page hero -->
       <div class="inner-page-hero hedader-bg">
            <div class="container">
                <h2 class="text-white">Single Post Details...</h2>
                <p class="lead text-white">We believe in better quality and service</p>
            </div>
            <!-- end:Container -->
        </div>

        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ url('/') }}" class="active">Home</a></li>
                    <li><a href="{{ url('/posts') }}">Posts</a></li>
                    <li class="text-danger">Post Details</li>
                </ul>
            </div>
        </div>
        <section class="contact-page inner-page">
            <div class="container">
                <div class="row">
                    <!-- REGISTER -->
                    <div class="col-md-6">
                        <div class="widget">
                            <div class="widget-body">

                                <b>Product Title : </b>
                                <div class="pl-2">
                                    {{ $singleData->title }}.
                                </div>
                                <hr>


                                <b>Product Details : </b>
                                <div class="pl-2">
                                    {!! $singleData->details !!}
                                </div>
                                <hr>

                            </div>
                        </div>
                        <!-- end: Widget -->
                    </div>
                    <!-- /REGISTER -->
                    <!-- WHY? -->
                    <div class="col-md-6">
                        <h4>Product Views</h4>
                        <hr>
                        <img src="{{ asset($singleData->image) }}" style="max-width: 609px; max-height: 350px;" alt="Image">
                    </div>
                    <!-- /WHY? -->
                </div>
            </div>
        </section>
</div>
