<table class="w-full">
    <thead>
        <tr class="bg-gray-100 text-gray-700">
            <th class="py-3 px-4 text-left rounded-tl-lg">No. Antrian</th>
            <th class="py-3 px-4 text-left">Layanan</th>
            <th class="py-3 px-4 text-left">Nama</th>
            <th class="py-3 px-4 text-left">Waktu Ambil</th>
            <th class="py-3 px-4 text-left rounded-tr-lg">Status</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        <?php foreach ($antrianAll as $antall): ?>
            <tr>
                <td class="py-3 px-4 font-medium"><?= $antall['jenis'] .  convNol($antall['nomor']) ?></td>
                <td class="py-3 px-4">Pendaftaran</td>
                <td class="py-3 px-4"><?= $antall['nama'] ?></td>
                <td class="py-3 px-4"><?= $antall['waktu'] ?></td>
                <td class="py-3 px-4">
                    <?php if ($antall['ket'] == 'menunggu') { ?>
                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm">Menunggu</span>
                    <?php } elseif ($antall['ket'] == 'proses') { ?>
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm">Dilayani</span>
                    <?php } else { ?>
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Selesai</span>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>