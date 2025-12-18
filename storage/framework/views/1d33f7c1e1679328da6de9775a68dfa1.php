

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="active">Dashboard</a>
    <a href="<?php echo e(route('admin.users.index')); ?>">Kelola User</a>
    <a href="<?php echo e(route('admin.fakultas.index')); ?>">Kelola Fakultas</a>
    <a href="<?php echo e(route('admin.jurusan.index')); ?>">Kelola Jurusan</a>
    <a href="<?php echo e(route('admin.prodi.index')); ?>">Kelola Prodi</a>
    <a href="<?php echo e(route('admin.mahasiswa.index')); ?>">Kelola Mahasiswa</a>
    <hr style="margin: 10px 0; border: none; border-top: 1px solid #ddd;">
    <a href="<?php echo e(route('profile.change-password')); ?>" style="color: #e74c3c;">Ubah Password</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Dashboard Admin</h1>
    </div>
    
    <div class="card">
        <h2>Selamat Datang</h2>
        <p>Anda login sebagai Admin. Gunakan menu di samping untuk mengelola aplikasi kuisioner.</p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>