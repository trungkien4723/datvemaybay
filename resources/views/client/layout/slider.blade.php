@if(!$slider->isEmpty())
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel"  style="padding:0px;">
  <div class="carousel-inner">
      @foreach($slider as $key => $slide)
        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
        <img src="{{asset('images/slider/'.$slide->image)}}"
            class="d-block w-100"
            alt="{{$slide->descr}}"
            style="width:auto; height:400px !important;">
        </div>
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
@endif