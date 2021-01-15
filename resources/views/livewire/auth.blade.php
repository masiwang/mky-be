<div class="d-flex align-items-center bg-auth" style="height: 100vh; border-top: 3px solid #28a745">
  <div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-2">
            <img src="/happiness.svg" alt="" srcset="">
        </div>
        <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">
            <h1 class="text-center mb-2" style="font-weight: 600">
              {{ $view == 'login' ? 'Masuk Platform' : ($view == 'register' ? 'Registrasi' : 'Lupa password') }}
            </h1>
            <p class="text-center text-secondary mb-5">Yuk makmurkan petani Indonesia!</p>
            <form wire:submit.prevent="auth">
                <div class="mb-2">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" wire:model="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan email">
                </div>
                @if(!($view == 'forgot'))
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" wire:model="password" class="form-control" placeholder="Masukkan password">
                </div>
                @endif
                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100 py-2 rounded-lg">
                      {{ $view == 'login' ? 'Masuk' : ($view == 'register' ? 'Registrasi' : 'Reset password') }}
                    </button>
                    @if(Session::has('success'))
                    <div class="text-sm">
                      👌 {{ Session::get('success') }}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="text-sm text-danger">
                      {{ Session::get('error') }}
                    </div>
                    @endif
                </div>
                @if(!($view == 'register'))
                <p class="text-center text-secondary">Belum punya akun? <a wire:click="$set('view', 'register')" type="button" class="text-green">Daftar sekarang juga</a></p>
                @endif
                @if($view == 'register')
                <p class="text-center text-secondary">Sudah punya akun? <a wire:click="$set('view', 'login')" type="button" class="text-green">Masuk ke platform</a></p>
                @endif
                @if($view == 'login')
                <p class="text-center text-secondary"><a wire:click="$set('view', 'forgot')" type="button" class="text-green">Lupa password</a></p>
                @endif
            </form>
        </div>
    </div>
  </div>
</div>