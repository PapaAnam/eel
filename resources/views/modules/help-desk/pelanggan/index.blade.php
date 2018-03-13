@foreach ($pelanggan as $p)
	{{ $p->Kode }} - {{ $p->NickNameOwner }} - {{ $p->Perusahaan }}
	<br>

@endforeach

{{ $pelanggan->links() }}