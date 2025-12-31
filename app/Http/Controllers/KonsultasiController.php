namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    // HALAMAN KONSULTASI
    public function index()
    {
        $gejalas = Gejala::all();
        return view('konsultasi.index', compact('gejalas'));
    }

    // PROSES DIAGNOSA (FORWARD CHAINING)
    public function proses(Request $request)
    {
        $request->validate([
            'gejala_ids' => 'required|array|min:1'
        ]);

        $userGejala = $request->gejala_ids;
        $rules = Rule::all();

        $hasil = null;
        $persentase = 0;

        foreach ($rules as $rule) {
            $ruleGejala = $rule->gejala_ids;

            $cocok = array_intersect($ruleGejala, $userGejala);
            $nilai = count($cocok) / count($ruleGejala) * 100;

            if ($nilai > $persentase) {
                $persentase = $nilai;
                $hasil = Kerusakan::find($rule->kerusakan_id);
            }
        }

        return view('konsultasi.hasil', compact(
            'hasil',
            'persentase',
            'userGejala'
        ));
    }
}
