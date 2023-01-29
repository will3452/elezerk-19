<x-layout>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Account setting
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" value="{{auth()->user()->name}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" value="{{auth()->user()->email}}" readonly>
                        </div>
                        <form action="/change-password" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="">New Password</label>
                                <input name="password" type="password" value="" required/>
                            </div>
                            <div class="mb-3">
                                <label for="">Confirm Password</label>
                                <input name="password_confirmation" type="password" value="" required/>
                            </div>
                            <div class="place-order your-order-wrap ">
                                <button type="submit" class=" btn btn-secondary">
                                    CHANGE PASSWORD
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex" style="justify-content: space-between; align-items:center;">
                        <div>
                            Your Balance : <b>PHP {{ number_format(auth()->user()->balance, 2) }}</b>
                        </div>
                        <form class="d-flex" method="POST" action="/cash-in">
                            @csrf
                            <input type="text" placeholder="Amount" name="amount" required />
                            <button class="btn btn-success mx-2">Load</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <h3>Your transactions</h3>
                        <table id="myTable" class="table">
                            <tr>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Description
                                </th>
                            </tr>
                            @foreach (\App\Models\Transaction::whereUserId(auth()->id())->latest()->take(5)->get() as $item)
                                <tr>
                                    <td>
                                        {{$item->created_at->format('m/d/y')}}
                                    </td>
                                    <td>
                                        PHP {{number_format($item->amount, 2)}}
                                    </td>
                                    <td>
                                        {{$item->description}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="mt-2">
                    <button class="btn btn-sm btn-primary" onclick="getLocation()">Broadcast your location</button> <small>This is important, so that the owner of the rented vehicle knows where you are.</small>
                </div>

                <script>
                    const x = document.getElementById("demo");
                    function getLocation() {
                      if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                      } else {
                        x.innerHTML = "Geolocation is not supported by this browser.";
                      }
                    }

                    function showPosition(position) {
                      window.location.href = `/share-location?lat=${position.coords.latitude}&lng=${position.coords.longitude}`;
                    }
                    </script>
            </div>
        </div>
    </div>
</x-layout>
