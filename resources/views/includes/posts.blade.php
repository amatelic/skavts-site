<article class="skavt-post">
  <h2>{{$article->title}}</h2>
  <div class="skavt-post truncate">
    {{$article->body}}
  </div>
  @if(count($imagesDir))
    <div class="skavt-post-gallery">
      @foreach($imagesDir as  $image)
        {{-- <img src="{{$image}}" width="100px" height="100px" alt="" /> --}}
        <a href="{{$image}}" data-lightbox="image-1" data-title="skavt-post">
          <img class="skavt-post-image skavt-post-image-animation" src="{{$image}}">
        </a>
      @endforeach
    </div>
  @endif
  <a class="see-more" href="#">Preberi članek</a>
</article>
