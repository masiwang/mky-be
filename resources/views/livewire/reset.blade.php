<div class="d-flex justify-content-center align-items-center" style="height: 100vh">
  <div class="">
    <h1 class="text-center mb-4" style="font-weight: 600">
      Reset password
    </h1>
    <form wire:submit.prevent="update">
        <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Password Baru</label>
            <input type="password" wire:model="password" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Ulangi password</label>
          <input type="password" wire:model="password_confirm" class="form-control">
          @if(!($password === $password_confirm))
          <small class="text-danger">Password tidak cocok.</small>
          @endif
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success w-100 py-2 rounded-lg">
              Ganti password
            </button>
        </div>
    </form>
</div>
</div>
