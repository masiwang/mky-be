<div class="d-flex flex-column justify-content-center align-items-center" style="margin-top: 4rem; height: 100vh">
    <img src="https://media1.giphy.com/media/LmNwrBhejkK9EFP504/200.gif" alt="">
    <h1>Sedang dicoding..</h1>
    <button type="button" wire:click="sendTestNotification">Test onesignal</button>
    @if(Session::has('success'))
    <span>sukses...</span>
    @endif
</div>
