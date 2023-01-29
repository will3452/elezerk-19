<x-layout>
    <div class="login-register-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ms-auto me-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a href="#lg2">
                                <h4> LOGIN </h4>
                            </a>
                        </div>
                        <div>

                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="/login" method="post" autocomplete="false">
                                            @csrf
                                            <label for="">Email</label>
                                            <input autocomplete="false" autofocus="false" name="email" placeholder="Email" type="email">
                                            <label for="">Password</label>
                                            <input autocomplete="false" autofocus="false" type="password" name="password" placeholder="Password">
                                            <div class="button-box">
                                                <button type="submit"><span>LOGIN NOW</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
