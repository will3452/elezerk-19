  <!-- ========================= contact-section start ========================= -->
  <section id="register" class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-xl-4">
          <div class="contact-item-wrapper">
            <div class="row">
              <div class="col-12 col-md-6 col-xl-12">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="lni lni-phone"></i>
                  </div>
                  <div class="contact-content">
                    <h4>Contact</h4>
                    <p>09496516352</p>
                    <p>dormifindlopez@gmail.com</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-12">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="lni lni-map-marker"></i>
                  </div>
                  <div class="contact-content">
                    <h4>Address</h4>
                    <p>Lorem, Ipsum dolor set</p>
                    <p>Philippines</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="contact-form-wrapper">
            <div class="row">
              <div class="col-xl-10 col-lg-8 mx-auto">
                <div class="section-title text-center">
                  <h2>
                    Register
                  </h2>
                </div>
              </div>
            </div>
            <form action="/register" method="POST" class="contact-form">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
                @csrf
              <div class="row">
                <div class="col-md-12">
                  <input type="text" name="name" id="name" placeholder="Name" required />
                </div>
                <div class="col-md-12">
                  <input type="email" name="email" id="email" placeholder="Email" required />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <input type="password" name="password" id="password" placeholder="Password" required />
                </div>
                <div class="col-md-12">
                  <input type="password" name="password_confirmation" id="password_conf" placeholder="Confirm password" required />
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="button text-center rounded-buttons">
                    <button type="submit" class="btn primary-btn rounded-full">
                      SUBMIT
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ========================= contact-section end ========================= -->
