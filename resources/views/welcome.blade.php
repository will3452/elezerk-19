<x-layout>
    <div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-12">
                    <div class="shop-top-bar">
                        <div class="select-shoing-wrap">
                            <p>Showing {{$cars->toArray()['from']}}–{{$cars->toArray()['to']}} of {{$cars->total()}} result</p>
                        </div>
                    </div>

                    <div class="shop-bottom-area mt-35">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">
                                    @foreach ($cars as $item)
                                        <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6 col-6">
                                            <x-item :item="$item"></x-item>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="pro-pagination-style text-center mt-30">
                            <ul>
                                {{$cars->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
