<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('sweetalert::alert')
    <section class="h-screen">
        <div class="px-6 h-full text-gray-800">
          <div
            class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6"
          >
            <div
              class="grow-0 shrink-1 md:shrink-0 basis-auto xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 md:mb-0"
            >
              <img
                src="/OJT MANAGEMENT.png"
                class="w-full"
              />
            </div>
            <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
              <form action="/login" method="POST">
                @csrf
                <h1 class="text-2xl font-bold uppercase mb-2">Login</h1>

                <!-- Email input -->
                <div class="mb-6">
                    <label for="">Student No. / Employee No </label>
                  <input
                    type="text"
                    name="id"
                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"

                    placeholder="Identification Number"
                  />
                </div>

                <!-- Password input -->
                <div class="mb-6">
                    <label for="">Password </label>
                  <input
                    type="password"
                    name="password"
                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="exampleFormControlInput2"
                    placeholder="Password"
                  />
                </div>

                <div class="flex justify-between items-center mb-6">
                  <a href="/app/password/reset" class="text-gray-800">Forgot password?</a>
                </div>

                <div class="text-center lg:text-left">
                  <button
                    class="inline-block px-7 py-3 bg-red-700 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-red-800 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-900 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    Login
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
