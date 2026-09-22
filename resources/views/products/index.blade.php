<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Manajemen Data Produk</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- Header / Navbar Minimalis Modern -->
    <header class="bg-slate-900 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-emerald-500 text-slate-900 p-2 rounded-lg font-bold text-xl">
                    <i class="fa-solid me-1 fa-boxes-stacked"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-wide">Aplikasi Manajemen Produk</h1>
                    <p class="text-xs text-slate-400">Sistem Informasi Kelola Data Produk</p>
                </div>
            </div>
            <span class="text-xs font-semibold px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30">
                CRUD Laravel 13
            </span>
        </div>
    </header>

    <!-- Content Utama -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Flash Message / Alert Sukses -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-emerald-500 me-3 text-lg"></i>
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Card Tabel Data -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            
            <!-- Sub Header Tabel & Tombol Tambah -->
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Daftar Produk</h2>
                    <p class="text-sm text-slate-500 mt-1">Kelola data stok, harga, dan kategori produk toko Anda.</p>
                </div>
                <a href="{{ route('products.create') }}" 
                   class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition duration-150 ease-in-out">
                    <i class="fa-solid fa-plus me-2"></i> Tambah Produk
                </a>
            </div>

            <!-- Tabel Data -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider border-b border-slate-200">
                            <th class="py-4 px-6 font-semibold">No</th>
                            <th class="py-4 px-6 font-semibold">Kode</th>
                            <th class="py-4 px-6 font-semibold">Nama Produk</th>
                            <th class="py-4 px-6 font-semibold">Kategori</th>
                            <th class="py-4 px-6 font-semibold">Harga</th>
                            <th class="py-4 px-6 font-semibold">Stok</th>
                            <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($products as $index => $product)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-4 px-6 text-slate-500 font-medium">{{ $index + 1 }}</td>
                                <td class="py-4 px-6">
                                    <span class="inline-block px-2.5 py-1 text-xs font-mono font-semibold text-slate-700 bg-slate-100 rounded-md border border-slate-200">
                                        {{ $product->kode_produk }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-semibold text-slate-800">{{ $product->nama_produk }}</td>
                                <td class="py-4 px-6">
                                    <span class="inline-block px-2.5 py-1 text-xs font-medium text-emerald-700 bg-emerald-50 rounded-full">
                                        {{ $product->kategori }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-medium text-slate-700">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-medium {{ $product->stok > 0 ? 'text-slate-700' : 'text-rose-500' }}">
                                        {{ $product->stok }} unit
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('products.show', $product->id) }}" 
                                           class="p-2 text-slate-500 hover:text-emerald-600 hover:bg-slate-100 rounded-lg transition" title="Detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('products.edit', $product->id) }}" 
                                           class="p-2 text-slate-500 hover:text-amber-600 hover:bg-slate-100 rounded-lg transition" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-500 hover:text-rose-600 hover:bg-slate-100 rounded-lg transition" title="Hapus">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Tampilan Jika Data Kosong -->
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fa-solid fa-folder-open text-4xl mb-3 text-slate-300"></i>
                                        <p class="text-base font-medium">Data produk belum tersedia.</p>
                                        <p class="text-xs text-slate-400 mt-1">Klik tombol "+ Tambah Produk" di atas untuk menambahkan data baru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto py-4 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} Aplikasi Manajemen Data Produk — All rights reserved.</p>
    </footer>

</body>
</html>