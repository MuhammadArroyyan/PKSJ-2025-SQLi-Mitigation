

<?php $__env->startSection('title', 'Kaprodi Dashboard'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kaprodi.dashboard')); ?>" class="active">Dashboard</a>
    <a href="<?php echo e(route('kaprodi.periode.index')); ?>">Periode Kuisioner</a>
    <a href="<?php echo e(route('kaprodi.pertanyaan.index')); ?>">Pertanyaan</a>
    <a href="<?php echo e(route('kaprodi.summary.index')); ?>">Summary</a>
    <a href="<?php echo e(route('kaprodi.jawaban.index')); ?>">Jawaban Mahasiswa</a>
    <hr style="margin: 10px 0; border: none; border-top: 1px solid #ddd;">
    <a href="<?php echo e(route('profile.change-password')); ?>" style="color: #e74c3c;">Ubah Password</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Dashboard Kaprodi</h1>
    </div>
    
    <div class="card">
        <h2>Selamat Datang</h2>
        <p>Anda login sebagai Kaprodi untuk Program Studi: <strong><?php echo e($prodi->nama_prodi ?? 'N/A'); ?></strong></p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/kaprodi/dashboard.blade.php ENDPATH**/ ?>