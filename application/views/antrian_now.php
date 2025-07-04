<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <?php foreach ($meja as $meja): ?>
        <!-- Loket -->
        <div class="bg-gray-100 rounded-lg p-4 text-center">
            <div
                class="bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                <span class="text-2xl font-bold"><?= $meja['nomor_meja'] ?></span>
            </div>
            <h3 class="font-medium text-lg mb-2"><?= $meja['petugas'] ?></h3>
            <div class="text-4xl font-bold text-accent mb-2" id="current-queue-1">
                <?= $meja['jenis'] != '' && $meja['antrian'] != '' ? $meja['jenis'] . convNol($meja['antrian']) : '0' ?>
            </div>
            <div class="text-gray-500" id="current-name-1"><?= $meja['nama'] != '' ? $meja['nama'] : 'belum' ?></div>
        </div>
    <?php endforeach ?>
</div>