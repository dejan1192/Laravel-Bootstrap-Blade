<p class="d-flex" >

    
    @foreach($tags as $tag)
      <a style="font-size: 16px" href="#" class="badge badge-primary mr-2">{{$tag->name}}</a>
    @endforeach
</p>