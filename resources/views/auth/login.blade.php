  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <section class="vh-100" style="background-color: #9A616D;">
      <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col col-xl-10">
                  <div class="card" style="border-radius: 1rem;">
                      <div class="row g-0">
                          <div class="col-md-6 col-lg-5 d-none d-md-block">
                              <img src="{{ asset('289.png') }}" alt="login form" class="img-fluid"
                                  style="border-radius: 1rem 0 0 1rem; object-fit: cover; height: 100%; width: 100%;" />
                          </div>
                          <div class="col-md-6 col-lg-7 d-flex align-items-center">
                              <div class="card-body p-4 p-lg-5 text-black">

                                  <!-- Logo y título -->
                                  <div class="d-flex align-items-center mb-3 pb-1">
                                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                      <span class="h1 fw-bold mb-0">Perfumes</span>
                                  </div>

                                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar sesión</h5>

                                  <!-- Mostrar mensajes de estado -->
                                  <x-auth-session-status class="mb-3" :status="session('status')" />

                                  <!-- Formulario -->
                                  <form method="POST" action="{{ route('login') }}">
                                      @csrf

                                      <div class="form-outline mb-4">
                                          <input id="rut" name="rut" type="text" required autofocus
                                              placeholder="Ejemplo: 12.345.678-9"
                                              class="form-control form-control-lg @error('rut') is-invalid @enderror" />
                                          <label class="form-label" for="rut">RUT</label>
                                          @error('rut')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>

                                      <div class="form-outline mb-4">
                                          <input id="password" name="password" type="password" required
                                              placeholder="********"
                                              class="form-control form-control-lg @error('password') is-invalid @enderror" />
                                          <label class="form-label" for="password">Contraseña</label>
                                          @error('password')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>

                                      <div class="d-flex justify-content-between align-items-center mb-4">
                                          <div class="form-check">
                                              <input id="remember_me" name="remember" type="checkbox"
                                                  class="form-check-input" />
                                              <label for="remember_me" class="form-check-label">Recordarme</label>
                                          </div>

                                          @if (Route::has('password.request'))
                                              <a href="{{ route('password.request') }}"
                                                  class="text-decoration-none text-primary">¿Olvidaste tu
                                                  contraseña?</a>
                                          @endif
                                      </div>

                                      <div class="pt-1 mb-4">
                                          <button type="submit" class="btn btn-dark btn-lg btn-block w-100"
                                              style="border-radius: 50px;">
                                              Ingresar
                                          </button>
                                      </div>
                                  </form>

                                  <p class="mb-5 pb-lg-2" style="color: #393f81;">
                                  </p>
                                  <a href="#" class="small text-muted me-3">Términos de uso</a>
                                  <a href="#" class="small text-muted">Política de privacidad</a>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- FontAwesome for the icon -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
