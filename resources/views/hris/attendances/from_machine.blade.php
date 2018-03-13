<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<td>USERID</td>
					<td>Nama</td>
					<td>CHECKTIME</td>
					<td>CHECKTYPE</td>
					<td>VERIFYCODE</td>
					<td>SENSORID</td>
					<td>Memoinfo</td>
					<td>WorkCode</td>
					<td>sn</td>
					<td>UserExtFmt</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($CheckInOut as $d)
				<tr>
					<td>{{ $d->USERID }}</td>
					<td>{{ $d->UserInfo->Name }}</td>
					<td>{{ $d->CHECKTIME }}</td>
					<td>{{ $d->CHECKTYPE }}</td>
					<td>{{ $d->VERIFYCODE }}</td>
					<td>{{ $d->SENSORID }}</td>
					<td>{{ $d->Memoinfo }}</td>
					<td>{{ $d->WorkCode }}</td>
					<td>{{ $d->sn }}</td>
					<td>{{ $d->UserExtFmt }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>