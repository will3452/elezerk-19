<x-print>

    <div class="flex">
        <div class="w-2/6">
            <div class="border-2 border-black m-4">
                <div class="text-center uppercase font-bold">
                    Barangay Official
                </div>
                @foreach ([
                    [
                        'name' => 'Hon. PRIMO G. FAJARDO',
                        'position' => 'Punong Barangay',
                    ],
                    [
                        'name' => 'Hon. CARLITO R. MARIANO',
                        'position' => 'Barangay Kagawad',
                    ],
                    [
                        'name' => 'Hon. RONIE B. MIGUEL',
                        'position' => 'Barangay Kagawad',
                    ],
                    [
                        'name' => 'Hon. GILBERT J. CRUZCOSA',
                        'position' => 'Barangay Kagawad',
                    ],
                    [
                        'name' => 'Hon. JOHN M. TORRES',
                        'position' => 'Barangay Kagawad',
                    ],
                    [
                        'name' => 'Hon. VICENTE M. ESQUIVEL',
                        'position' => 'Barangay Kagawad',
                    ],
                    [
                        'name' => 'Hon. MILAGROS C. SULAY',
                        'position' => 'Barangay Kagawad',
                    ],
                    [
                        'name' => 'Hon. ARISTEDES E. MARQUEZ',
                        'position' => 'Barangay Kagawad',
                    ],
                    [
                        'name' => 'Hon. JALYN C. TACUSALME',
                        'position' => 'SK Chairperson',
                    ],
                    [
                        'name' => 'ABEGAIL N. VALDOZ',
                        'position' => 'Barangay Secretary',
                    ],
                    [
                        'name' => 'MARITEZ U. CANONIZADO',
                        'position' => 'Barangay Tresurer',
                    ]
                ] as $item)
                    <div class="text-center font-sans mt-4 mb-2">
                        <div>
                            {{$item['name']}}
                        </div>
                        <div class="text-xs">
                            {{$item['position']}}
                        </div>
                    </div>
                @endforeach

            </div>
        </div >
        <div class="w-4/6">
            <div class="text-center">
                <x-header></x-header>
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

                <div class="mt-8 text-right uppercase">
                    <div>
                        HON. PRIMO G. FAJARDO
                    </div>
                    <div class="text-xs">
                        Punong Barangay
                    </div>
                </div>
                <div class="mt-4 text-left">
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
    </div>
</x-print>
