<x-print>

    <div class="text-center">
        <div class="text-xl">
            <h2 class="font-bold">REPUBLIC OF THE PHILIPPINES</h2>
            <p class="text-sm">Province of Tarlac</p>
            <p class="text-sm">Municipality of Lapaz</p>
            <p class="text-sm font-bold">BARANGAY GUEVARA</p>
            </div>
        <br/>
        <hr>
        <h1 class="my-5 text-2xl text-center uppercase font-bold">Barangay Clearance</h1>
        <div class="text-left font-serif text-xl">
            <p>To whom it may concern.</p>
            <p>This is to certified that <span class="underline">{{$citizen->first_name}} {{$citizen->last_name}}</span> Born on <span class="underline">{{$citizen->dob->format('M,d Y')}}</span> Filipino, Resident of Brgy. Guevara, La Paz, Tarlac has no derogatory record filed in the office.</p>
            <p class="mt-2">The above-named individual who is a resident of this barangay
                is a preson of good moral character, peace loving and civic minded citizen.

                this certificate is hereby issued for legal purposes it may serve,
                this <span class="underline">{{now()->format('d')}}</span> day of <span class="underline">{{now()->format('M, Y')}}</span>.</p>
        </div>
    </div>

    <div id="footer" class="mt-6">
        <div class="flex items-center justify-between">
            <div>
                <div>
                    __________________________
                </div>
                <div class="font-bold text-xs">Signature of requestor</div>
            </div>
            <div>

                <div class="font-bold text-xs">Certified By: </div>
                <div>
                    __________________________
                </div>

                <div class="font-bold text-xs">Punong Barangay</div>
            </div>
        </div>
    </div>

</x-print>
