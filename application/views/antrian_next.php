<div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center font-medium">
    <?php foreach ($antrian as $ant): ?>
        <div>Nomor: <span class="text-accent"><?= $ant['jenis'] . convNol($ant['nomor']) ?></span></div>
    <?php endforeach ?>
</div>