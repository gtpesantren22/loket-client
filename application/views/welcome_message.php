<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistem Antrian Digital</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<!-- jQuery (required by Select2) -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: '#3B82F6',
						secondary: '#10B981',
						accent: '#F59E0B',
						dark: '#1F2937',
						danger: '#EF4444',
					}
				}
			}
		}
	</script>
	<style>
		.select2-container--default .select2-selection--single {
			height: 2.5rem;
			/* Sesuaikan dengan Tailwind py-2 */
			padding: 0.5rem 1rem;
			border-radius: 0.5rem;
			border-color: #d1d5db;
			/* Tailwind gray-300 */
		}

		/* Animasi modal */
		.modal {
			transition: opacity 0.3s ease, transform 0.3s ease;
		}

		.modal-hidden {
			opacity: 0;
			transform: translateY(-20px);
			pointer-events: none;
		}

		.modal-visible {
			opacity: 1;
			transform: translateY(0);
		}

		/* Overlay */
		.modal-overlay {
			transition: opacity 0.3s ease;
		}

		.modal-overlay-hidden {
			opacity: 0;
			pointer-events: none;
		}

		.modal-overlay-visible {
			opacity: 0.5;
		}

		.custom-select {
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
			background-position: right 0.5rem center;
			background-repeat: no-repeat;
			background-size: 1.5em 1.5em;
			-webkit-print-color-adjust: exact;
			print-color-adjust: exact;
		}
	</style>
</head>

<body class="bg-gray-50 min-h-screen">
	<div class="container mx-auto px-4 py-8">
		<!-- Header -->
		<header class="mb-10 text-center">
			<h1 class="text-4xl font-bold text-dark mb-2">Sistem Antrian Digital</h1>
			<p class="text-lg text-gray-600">PSB PPDWK - TAHUN 2025/2026</p>
			<div class="mt-4 flex justify-center">
				<div class="bg-primary text-white px-4 py-2 rounded-full flex items-center">
					<i class="fas fa-clock mr-2"></i>
					<span id="current-time">00:00:00</span>
				</div>
				<div class="bg-secondary text-white px-4 py-2 rounded-full flex items-center ml-4">
					<span id="current-date">Hari, DD/MM/YYYY</span>
				</div>


				<button onclick="window.location='auth/logout'" class="bg-danger hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center ml-4">
					<i class="fas fa-sign-out-alt mr-2"></i> Logout
				</button>


			</div>
		</header>

		<!-- Main Content -->
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
			<!-- Panel Antrian Sekarang -->
			<div class="bg-white rounded-xl shadow-lg p-6 col-span-2">
				<h2 class="text-2xl font-semibold text-dark mb-6">Antrian Saat Ini</h2>

				<div id="now-antrian"></div>

				<!-- Antrian Berikutnya -->
				<div class="mt-8">
					<h3 class="text-xl font-semibold mb-4">Antrian Berikutnya</h3>
					<div class="bg-gray-50 rounded-lg p-4">
						<div id="next-antrian"></div>
					</div>
				</div>
			</div>

			<!-- Panel Ambil Antrian -->
			<div class="bg-white rounded-xl shadow-lg p-6">
				<h2 class="text-2xl font-semibold text-dark mb-6">Ambil Antrian</h2>

				<form class="space-y-4" method="post" action="<?= base_url('welcome/add') ?>">
					<div>
						<label class="block text-gray-700 mb-2">Cari Nama</label>
						<select id="cariSantri" name="nama" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
							<option>Pilih santri</option>
						</select>
					</div>
					<div>
						<label class="block text-gray-700 mb-2">Jenis</label>
						<select name="jenis" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
							<option value="A">Sudah Daftar</option>
							<option value="B">Belum Daftar</option>
						</select>
					</div>

					<button type="submit"
						class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
						<i class="fas fa-ticket-alt mr-2"></i> Ambil Nomor Antrian
					</button>
				</form>

				<!-- Info Antrian Anda -->
				<div class="mt-8 bg-blue-50 rounded-lg p-4 border border-blue-200">
					<h3 class="text-lg font-semibold text-blue-800 mb-2">Antrian Terakhir</h3>
					<div class="text-center py-4">
						<div class="text-5xl font-bold text-accent mb-2" id="last-no">0</div>
						<div class="text-gray-700">Nama: <span class="font-medium" id="last-nama">nama santri</span>
						</div>
					</div>
					<button id="btn-batal"
						class="w-full bg-accent hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center">
						<i class="fas fa-trash mr-2"></i> Batalkan
					</button>
				</div>
			</div>
		</div>

		<!-- Daftar Antrian -->
		<div class="mt-10 bg-white rounded-xl shadow-lg p-6">
			<h2 class="text-2xl font-semibold text-dark mb-6">Daftar Antrian Hari Ini</h2>

			<div class="overflow-x-auto">
				<div id="all-antrian"></div>

			</div>
		</div>

		<!-- Footer -->
		<footer class="mt-12 text-center text-gray-600">
			<p>© 2025 Sistem Antrian Digital - PSB PPDWK 2025/2026</p>
			<p class="mt-2 text-sm">Nomor antrian dapat dipantau melalui aplikasi mobile kami</p>
			<div class="flex justify-center mt-4 space-x-4">
				<a href="#" class="text-primary hover:text-blue-700"><i class="fab fa-whatsapp text-xl"></i></a>
				<a href="#" class="text-primary hover:text-blue-700"><i class="fab fa-instagram text-xl"></i></a>
				<a href="#" class="text-primary hover:text-blue-700"><i class="fas fa-globe text-xl"></i></a>
			</div>
		</footer>
	</div>

	<script>
		// Update waktu dan tanggal secara real-time
		function updateDateTime() {
			const now = new Date();

			// Format waktu
			const timeString = now.toLocaleTimeString('id-ID', {
				hour: '2-digit',
				minute: '2-digit',
				second: '2-digit'
			});

			// Format tanggal
			const options = {
				weekday: 'long',
				year: 'numeric',
				month: 'long',
				day: 'numeric'
			};
			const dateString = now.toLocaleDateString('id-ID', options);

			document.getElementById('current-time').textContent = timeString;
			document.getElementById('current-date').textContent = dateString;
		}

		// Update setiap detik
		setInterval(updateDateTime, 1000);
		updateDateTime(); // Panggil sekali saat pertama kali load
	</script>
	<script>
		$(document).ready(function() {
			$('#cariSantri').select2({
				placeholder: "Pilih santri",
				allowClear: true,
				width: '100%' // supaya mengikuti lebar Tailwind
			});
			runInSequence()
			setInterval(async () => {
				try {
					await loadAntrianNow();
					await loadAntrianNext();
					await loadAntrianAll();
				} catch (error) {
					console.error('Gagal memuat antrian:', error);
				}
			}, 5000);
		});
		async function runInSequence() {
			try {
				await loadAntrianNow();
				await loadAntrianNext();
				await loadAntrianAll();
				await loadAntrianLast();
				await loadSantri();
			} catch (err) {
				console.error("Terjadi kesalahan:", err);
			}
		}

		function loadSantri() {
			return $.ajax({
				type: "GET",
				url: "<?= base_url('welcome/santri') ?>",
				dataType: "json",
				success: function(response) {
					$('#cariSantri').empty();
					$.each(response.data.data, function(index, value) {
						$('#cariSantri').append(' <option value = "' + value.nama + '" >' + value.nama + ' </>');
					});
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		}

		function loadAntrianNow() {
			return $.ajax({
				type: "GET",
				url: "<?= base_url('welcome/nowQueu') ?>",
				dataType: "html",
				success: function(response) {
					$('#now-antrian').html(response);
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		}

		function loadAntrianNext() {
			return $.ajax({
				type: "GET",
				url: "<?= base_url('welcome/nextQueu') ?>",
				dataType: "html",
				success: function(response) {
					$('#next-antrian').html(response);
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		}

		function loadAntrianAll() {
			return $.ajax({
				type: "GET",
				url: "<?= base_url('welcome/allQueu') ?>",
				dataType: "html",
				success: function(response) {
					$('#all-antrian').html(response);
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		}

		function loadAntrianLast() {
			return $.ajax({
				type: "GET",
				url: "<?= base_url('welcome/lastQueu') ?>",
				dataType: "json",
				success: function(response) {
					if (response.data != null) {

						$('#last-no').text(response.data.jenis + formatNomor(response.data.nomor));
						$('#last-nama').text(response.data.nama);
						$('#btn-batal').attr('data-id', response.data.id);
					}
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		}

		function formatNomor(nomor, panjang = 3) {
			return String(nomor).padStart(panjang, '0');
		}

		$('#btn-batal').on('click', function(e) {
			if (confirm('Yakin akan dibatalkan ??')) {
				var id = $(this).attr('data-id');
				$.ajax({
					type: "GET",
					url: "<?= base_url('welcome/batal/') ?>" + id,
					dataType: "json",
					success: function(response) {
						if (response.status == 'success') {
							loadAntrianNext()
							loadAntrianLast()
							loadAntrianAll()
						}
					},
					error: function(xhr, status, error) {
						console.log(xhr.responseText);
					}
				})
			}
		})
	</script>


</body>

</html>