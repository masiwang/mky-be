<div style="margin-top: 6rem">
  <h1>Investir</h1>
  <input wire:model="cari" type="text" placeholder="Cari...">
  <table>
    @foreach($user as $u)
    <tr>
      <td>{{ $u->name }} - {{ $u->phone }}</td>
    </tr>
    @endforeach
  </table>
</div>
