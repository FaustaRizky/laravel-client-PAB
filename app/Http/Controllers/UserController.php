<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
 
class UserController extends Controller
{
    public function index(): View
    {
        //get users API dari server
        $send_request = Http::get('http://localhost:8000/api/v1/users');
 
        //membuat json menjadi array
        $response = $send_request->json('data');
 
        //memanggil view user,
        //users merupakan nama folder
        //index merupakan file index.blade.php yang ada di dalam folder php
        return view('users.index', ['data' => $response]);
    }
 
    public function create()
    {
        $data = array();
        return view('users.create', $data);
    }
 
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required',
            'address'       => 'required',
            'house_number'  => 'required',
            'phone_number'  => 'required',
            'city'          => 'required',
            'roles'         => 'required',
        ]);
        // request untuk simpan data ke server
        $send_request = Http::post('http://localhost:8000/api/v1/users', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'house_number'  => $request->house_number,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'roles' => $request->roles
        ]);
        $response = $send_request->json();
        if ($response['success'] === true) {
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('users.index')->with(['error' => 'Data gagal Disimpan!']);
        }
    }
 
    public function show(string $id): View
    {
        //request get user dengan parameter ID ke server
        $response = Http::get("http://localhost:8000/api/v1/users/{$id}");
        // membuat notifikasi dari respon yang dihasilkan
        if ($response['success'] === true) {
            $dt = $response->json()['data'];
            return view('users.show', compact('dt'));
        } else {
            return redirect()->route('users.index')->with(['error' => 'Data tidak ditemukan']);
        }
    }
 
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            //validate form
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
                'city' => 'required',
                'roles' => 'required',
            ]);
 
            // request ke server menggunakan PATCH
            $send_request = Http::asForm()->patch("http://localhost:8000/api/v1/users/{$id}", [
                '_method' => 'PATCH', // Tambahkan ini untuk method spoofing
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
                'roles' => $request->roles
            ]);
 
            if (!$send_request->successful()) {
                throw new \Exception('Gagal mengupdate data');
            }
 
            $response = $send_request->json();
 
            if ($response['success'] === true) {
                return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }
 
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with(['error' => $e->getMessage()]);
        }
    }
 
    public function destroy($id): RedirectResponse
    {
        //delete user by ID
        $response = Http::delete("http://localhost:8000/api/v1/users/{$id}");
        if ($response['success'] === true) {
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('users.index')->with(['eror' => 'Data tidak ditemukan']);
        }
    }


    // LOGIN
    public function showLoginForm()
    {
        return view('auth.login'); // Arahkan ke view login
    }
    public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required',
        'password' => 'required',
    ]);

    // Kirim permintaan login ke server API
    $send_request = Http::post('http://localhost:8000/api/v1/login', [
        'name' => $request->name,
        'password' => $request->password,
    ]);

    // Ambil respons dari API
    $response = $send_request->json();

    // Jika login berhasil
    if (isset($response['access_token'])) {
        // Simpan token ke session
        session(['access_token' => $response['access_token']]);
        // Arahkan ke halaman /users
        return redirect('/users')->with(['success' => 'Login Berhasil!']);
    }

    // Jika login gagal
    return redirect()->back()->with(['error' => 'Login Gagal, Name atau Password Salah!']);
}

// SHOW BARANG
// SHOW BARANG
public function showItems()
{
    // Mengambil semua data barang dari API
    $response = Http::get('http://localhost:8000/api/v1/items');

    // Memastikan respons API valid dan mengonversi ke array
    $items = $response->successful() ? $response->json()['data'] : [];

    // Menampilkan halaman items.index dengan data barang
    return view('items.index', compact('items'));
}

public function showAddItemForm()
{
    return view('items.create'); // Arahkan ke form tambah barang
}

public function storeItem(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'detail' => 'required|string',
        'harga' => 'required|numeric|min:0',
    ]);

    // Kirim request ke API backend
    $send_request = Http::post('http://127.0.0.1:8000/api/v1/items', [
        'nama_barang' => $request->nama_barang,
        'detail' => $request->detail,
        'harga' => $request->harga,
    ]);

    $response = $send_request->json();

    if ($response['success']) {
        return redirect()->route('users.index')->with('success', 'Barang berhasil ditambahkan!');
    } else {
        return redirect()->back()->with('error', 'Gagal menambahkan barang.');
    }
}

public function showCheckoutForm($itemId)
{
    $response = Http::get('http://localhost:8000/api/v1/items/' . $itemId);

    if (!$response->successful()) {
        return redirect('/items')->with('error', 'Item tidak ditemukan.');
    }

    $item = $response->json()['data'];

    if (empty($item)) {
        return redirect('/items')->with('error', 'Item tidak ditemukan.');
    }

    return view('checkout', compact('item'));
}

public function processCheckout(Request $request, $itemId)
{
    // Validasi data input
    $request->validate([
        'name' => 'required|string',
        'address' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    // Simulasi proses pembayaran
    $transaction = [
        'name' => $request->name,
        'address' => $request->address,
        'payment_method' => $request->payment_method,
        'status' => 'Berhasil', // Simulasi status pembayaran berhasil
    ];

    // Simpan data transaksi ke session
    session(['transaction' => $transaction]);

    // Arahkan ke halaman "thank you"
    return redirect('/thankyou');
}

}