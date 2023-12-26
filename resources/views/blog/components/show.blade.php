<div class="container-lg">

    <div class="row">

        <div class="row text-center">
            <div class="col-12">
                <h1>{{ data_get($data, 'name') }}</h1>
            </div>
        </div>

        @foreach (data_get($data, 'components') as $index => $component)
            <div class="row mt-3">
                @switch(data_get($component, 'type'))
                    @case('1')
                        <div class="col-12 card" style="text-align: center;">
                            {{ data_get($component, 'article.content') }}
                        </div>
                    @break

                    @case('2')
                        @php
                            $images = data_get($component, 'images');
                        @endphp
                        @if (count($images) > 1)
                            @for ($i = 0; $i < count($images); $i++)
                                @if ($i != 0)
                                    <div class="col-12" style="text-align: center;">
                                        <img class="w-100 card" loading="lazy" src="{{ data_get($images, "{$i}.url") }}"
                                            alt="">
                                    </div>
                                @endif
                            @endfor
                        @else
                            @for ($i = 0; $i < count($images); $i++)
                                <div class="col-12" style="text-align: center;">
                                    <img class="w-100 card" loading="lazy" src="{{ data_get($images, "{$i}.url") }}"
                                        alt="">
                                </div>
                            @endfor
                        @endif
                    @break

                    @default
                        <div class="col-6" style="text-align: right;">
                            {{ data_get($component, 'article.content') }}

                        </div>
                        <div class="col-6">
                            <img class="w-100 card" loading="lazy" src="{{ data_get($component, 'image.url') }}" alt="">
                        </div>
                @endswitch
            </div>
        @endforeach

    </div>

</div>
