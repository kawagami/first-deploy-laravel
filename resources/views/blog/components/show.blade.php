<div class="container-lg overflow-auto">

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
                        <div class="col-12" style="text-align: center;">
                            {{ data_get($component, 'article.content') }}
                        </div>
                    @break

                    @case('2')
                        <div class="col-12" style="text-align: center;">
                            <img src="{{ data_get($component, 'image.url') }}" alt="">
                        </div>
                    @break

                    @default
                        <div class="col-6" style="text-align: right;">
                            {{ data_get($component, 'article.content') }}

                        </div>
                        <div class="col-6">
                            <img src="{{ data_get($component, 'image.url') }}" alt="">
                        </div>
                @endswitch
            </div>
        @endforeach

    </div>

</div>
