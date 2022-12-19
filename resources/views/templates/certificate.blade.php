<x-print>
    <x-header></x-header>
    <h1 class="text-2xl text-center font-serif mt-4">OFFICE OF THE PUNONG BARANGAY</h1>
        <h2 class="text-center font-serif text-xl font-bold">Certificate of Residency</h2>

        <div>
            To whom it may concern:
        </div>
        <div>
            This is to certify that <span class="underline">{{$citizen->first_name}} {{$citizen->last_name}}</span>, <span class="underline">{{$citizen->dob->age}}</span> years old, single,married, widow is a bonafide residence of Purok ____ Barangay Guevara, Lapaz, Tarlac.
        </div>
        <div>
            Further certifies that above named person has been staying this in the barangay ___________________.
        </div>
        <div>
            ISSUED this <span class="underline">{{now()->format('d')}}</span> day of <span class="underline">{{now()->format('M')}}</span>, {{now()->format('Y')}} here at Barangay Guevara, La Paz, Tarlac upon request whatever legal intent it may serve.
        </div>
        <div class="mt-8 text-right uppercase">
            <div>
                HON. PRIMO G. FAJARDO
            </div>
            <div class="text-xs">
                Punong Barangay
            </div>
        </div>
        <div class="mt-4">
            <div>
                Prepared/Verified By:
            </div>
            <div>
                ABEGAIL N. VALDOZ
            </div>
            <div class="text-xs">
                Barangay Secretary
            </div>
        </div>
</x-print>
