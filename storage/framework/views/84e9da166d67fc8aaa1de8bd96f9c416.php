

<?php $__env->startSection('title', 'Mahasiswa Dashboard'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('mahasiswa.dashboard')); ?>" class="active">Dashboard</a>
    <a href="<?php echo e(route('mahasiswa.kuisioner.list')); ?>">Daftar Kuisioner</a>
    <hr style="margin: 10px 0; border: none; border-top: 1px solid #ddd;">
    <a href="<?php echo e(route('profile.change-password')); ?>" style="color: #e74c3c;">Ubah Password</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Dashboard Mahasiswa</h1>
    </div>
    
    <div class="card">
        <h2>Informasi Diri</h2>
        <p><strong>NIM:</strong> <?php echo e($mahasiswa->nim ?? 'N/A'); ?></p>
        <p><strong>Nama:</strong> <?php echo e($mahasiswa->nama_mahasiswa ?? 'N/A'); ?></p>
        <p><strong>Program Studi:</strong> <?php echo e($mahasiswa->prodi->nama_prodi ?? 'N/A'); ?></p>
    </div>
    
    <div class="card">
        <h2>Periode Pengisian Kuisioner</h2>
        <?php $__empty_1 = true; $__currentLoopData = $periode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="padding: 15px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px;">
                <h3><?php echo e($p->keterangan); ?></h3>
                <p>Status: <strong><?php echo e(ucfirst($p->status_periode)); ?></strong></p>
                <a href="<?php echo e(route('mahasiswa.kuisioner.show', $p->id_periode)); ?>" class="btn">Lihat Kuisioner</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Tidak ada periode kuisioner yang aktif</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/mahasiswa/dashboard.blade.php ENDPATH**/ ?>