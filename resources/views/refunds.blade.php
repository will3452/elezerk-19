<x-layout>
    <x-header></x-header>
    <div class="container">
        <h1 class="text-center">Refund Service</h1>
        <form action="refunds" method="POST" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="mb-2">
                        <div>Image</div>
                        <input type="file" accept="image/*" name='image' style="background:none;border:none;">
                    </div>
                    <div class="rating-form-style form-submit mb-2">
                        <input type="text" name='phone' required placeholder="Phone">
                    </div>
                    <div class="rating-form-style form-submit">

                        <textarea name="reason" required placeholder="Message"></textarea>
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <x-footer></x-footer>
</x-layout>
