<tr>
  <td><strong>Employee Type</strong></td>
  <td><strong>Local Employee {{ edit_btn(1) }}</strong></td>
  <td><strong>International Employee {{ edit_btn(2) }}</strong></td>
</tr>
<tr>
  <td><strong>Special Permits</strong></td>
  <td>{{ $local->special_permit }}</td>
  <td>{{ $international->special_permit }}</td>
</tr>
<tr>
  <td><strong>Holiday</strong></td>
  <td>{{ $local->holiday }}</td>
  <td>{{ $international->holiday }}</td>
</tr>
<tr>
  <td><strong>Father Leave</strong></td>
  <td>{{ $local->father_leave }}</td>
  <td>{{ $international->father_leave }}</td>
</tr>
<tr>
  <td><strong>Sick</strong></td>
  <td>{{ $local->sick }}</td>
  <td>{{ $international->sick }}</td>
</tr>
<tr>
  <td><strong>Pregnancy</strong></td>
  <td>{{ $local->pregnancy }}</td>
  <td>{{ $international->pregnancy }}</td>
</tr>