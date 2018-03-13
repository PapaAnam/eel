<?php

namespace App\Http\Controllers\Fleet;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Fleet\MasterSupply;
use App\Models\Fleet\MasterSO;
use App\Models\Fleet\DetailSO;
use App\Models\Fleet\Collector;
use App\Models\Fleet\SalesPerson;
use App\Models\Fleet\SalesOrder;
use App\Models\Fleet\Pelanggan;
use Illuminate\Http\Request;
use PDF;
use Excel;

class SalesOrderController extends Controller
{
	public function api($driver)
	{
		$driver = str_replace('-', '/', $driver);
		$mso = MasterSO::where('sales', $driver)->get();
		$so = SalesOrder::all()->pluck('KodeNota');
		return $mso->whereNotInStrict('KodeNota', $so)->values();
	}

	public function apiResult()
	{
		return SalesOrder::with('driver')->orderBy('DikirimPada', 'DESC')->get()->transform(function($item, $key){
			$a = collect($item);
			return [
				'NamaSopir' => $a['driver']['Nama'],
			]+$a->except('driver')->toArray();
		});
	}

	public function process(Request $r)
	{
		foreach ($r->KodeNota as $nota) {
			SalesOrder::create([
				'KodeNota' => $nota,
				'Status' => 'Proses Kirim',
				'Sopir' => str_replace('-', '/', $r->driver),
				'DikirimPada' => now(),
			]);
		}
		return 'Sales order berhasil diproses';
	}

	public function updateStatus($id, Request $r)
	{
		$tambahan = [];
		if($r->AlasanDitolak){
			$tambahan['AlasanDitolak'] = $r->AlasanDitolak;
		}
		SalesOrder::find($id)->update([
			'Status' => $r->status,
			'DilaporkanPada' => now(),
		]+$tambahan);
		return 'Status berhasil diganti ke '.$r->status;
	}

	public function export($export_type, $tgl)
	{
		if($tgl == ''){
			return 'tanggal wajib diisi';
		}
		$includes = function($string, $text){
			return strpos($string, $text) === true;
		};
		if(substr($tgl, 0,4) == '' || $includes(substr($tgl, 0,4), 'y') || substr($tgl, 5,2) == '' || $includes(substr($tgl, 5,2), 'm') || substr($tgl, 8,2) == '' || $includes(substr($tgl, 8,2), 'd')){
			return ('tanggal tidak valid');
		}
		$data = SalesOrder::with('driver')->orderBy('DikirimPada', 'DESC')->where('DilaporkanPada', 'LIKE', $tgl.'%')->get()->transform(function($item, $key){
			$a = collect($item);
			return [
				'NamaSopir' => $a['driver']['Nama'],
			]+$a->except('driver', 'id')->toArray();
		});
		if(count($data)){
			return $this->toExport($data, $export_type, $tgl);
		}
		return 'Tak ada data';
	}

	private function toExport($data, $type, $tgl)
	{
		if($type == 'print'){
			return view('fleet.sales_order.print', [
				'data' => $data,
				'tgl' => $tgl,
			]);
		}else if($type == 'pdf'){
			return PDF::loadView('fleet.sales_order.print', [
				'data' => $data,
				'tgl' => $tgl,
			])
			->setPaper('A3', 'landscape')
			->download('sales-order-'.$tgl.".pdf");
		}
		Excel::create('sales-order-'.$tgl, function($excel) use ($data, $tgl){
			$excel->sheet('data', function($sheet) use ($data, $tgl){
				$sheet->with($data);
				$sheet->prependRow(1, ['Tanggal '.$tgl]);
				$sheet->prependRow(1, ['Sales Order']);
				$sheet->row(1, function($row){
					$row->setFontSize(16)->setFontWeight('bold')->setBackground('#999999');
					// $row->setAligment('center');
				});
				// $sheet->cell('A1', function($cell){
				// });
				$sheet->mergeCells('A1:G1');
			});
		})
		->export('xlsx');
	}
}
