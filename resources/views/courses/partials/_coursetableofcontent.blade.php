@foreach ($sections as $section)
    @if ($loop->first)
        <collapse title="{{$section->title}}" :open="true">
            @foreach ($section->lectures as $lecture)
                <a href="{{$lecture->path()}}" class="columns is-mobile is-multiline" slot="content">
                    <div class="column is-narrow"><i class="fas fa-caret-right"></i></div>
                    <div class="column">{{$lecture->title}}</div>
                    @if ($lecture->hasVideo())
                        <div class="column is-narrow">
                            <i class="mdi mdi-film"></i>
                        </div>
                    @endif
                </a>
            @endforeach
        </collapse>
        @continue
    @endif

    <collapse title="{{$section->title}}">
            @foreach ($section->lectures as $lecture)
                <a href="{{$lecture->path}}" class="columns is-mobile is-multiline" slot="content">
                    <div class="column is-narrow">
                        <i class="fas fa-caret-right"></i>
                    </div>
                    <div class="column">{{$lecture->title}}</div>
                    <div class="column is-narrow">
                        <i class="mdi mdi-film"></i>
                    </div>
                </a>
            @endforeach
    </collapse>
@endforeach