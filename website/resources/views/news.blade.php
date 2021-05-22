@extends('layouts.layouts')
@section('content')
<section>
  <body>
    <section class="hero-wrap hero-wrap-2" style="background-image: url();" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{url('/')}}">Home <i class="fa fa-chevron-right"></i></a></span> <span>News <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread">Recent News</h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section">
      <div class="container">
        <div class="row d-flex">
        
          @for ($i = 0; $i < 9; $i++)
            @php
              $year_month = explode("-",$news_data["articles"][$i]["publishedAt"]);
              $date_time = explode("T", $year_month[2]);
            @endphp
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry justify-content-end">
                <div class="text text-center">
                  <a href={{$news_data["articles"][$i]["url"]}} class="block-20 img" style="background-image: url({{$news_data['articles'][$i]['urlToImage']}});">
                  </a>
                  <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                    <div>
                      <span class="day">{{$date_time[0]}}</span>
                      <span class="mos">{{$year_month[1]}}</span>
                      <span class="yr">{{$year_month[0]}}</span>
                    </div>
                  </div>
                  <h3 class="heading mb-3"><a href={{$news_data["articles"][$i]["url"]}}>{{$news_data["articles"][$i]["title"]}}</a></h3>
                  <p>{{$news_data["articles"][$i]["description"]}}</p>
                </div>
              </div>
            </div>
          @endfor
        
          <!-- <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="{{url('blog-single')}}" class="block-20 img" style="background-image: url('assets/images/image_2.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">18</span>
                		<span class="mos">April</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">Social Media Risks To Mental Health</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="{{url('blog-single')}}" class="block-20 img" style="background-image: url('assets/images/image_3.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">18</span>
                		<span class="mos">April</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">Social Media Risks To Mental Health</a mb-3></h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>              
							</div>
            </div>
          </div>

          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="{{url('blog-single')}}" class="block-20 img" style="background-image: url('assets/images/image_4.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">18</span>
                		<span class="mos">April</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">Social Media Risks To Mental Health</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="{{url('blog-single')}}" class="block-20 img" style="background-image: url('assets/images/image_5.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">18</span>
                		<span class="mos">April</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">Social Media Risks To Mental Health</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="{{url('blog-single')}}" class="block-20 img" style="background-image: url('assets/images/image_6.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">18</span>
                		<span class="mos">April</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">Social Media Risks To Mental Health</a mb-3></h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>              
							</div>
            </div>
          </div>

          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="{{url('blog-single')}}" class="block-20 img" style="background-image: url('assets/images/image_7.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">18</span>
                		<span class="mos">April</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">Social Media Risks To Mental Health</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="{{url('blog-single')}}" class="block-20 img" style="background-image: url('assets/images/image_8.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">18</span>
                		<span class="mos">April</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">Social Media Risks To Mental Health</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="{{url('blog-single')}}" class="block-20 img" style="background-image: url('assets/images/image_9.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">18</span>
                		<span class="mos">April</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">Social Media Risks To Mental Health</a mb-3></h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>              
							</div>
            </div>
          </div> -->
        </div> 
        <div class="row mt-5">
          <div class="col text-center">
            <!-- <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div> -->
          </div>
        </div>
      </div>
    </section>	
  </body>
</section>