

<?php $__env->startSection('title', 'Daftar Kuisioner'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('mahasiswa.dashboard')); ?>">Dashboard</a>
    <a href="<?php echo e(route('mahasiswa.kuisioner.list')); ?>" class="active">Daftar Kuisioner</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Daftar Kuisioner</h1>
    </div>
    
    <div class="card">
        <?php $__empty_1 = true; $__currentLoopData = $periode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="padding: 15px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px;">
                <h3><?php echo e($p->keterangan); ?></h3>
                <p>Status: <strong><?php echo e(ucfirst($p->status_periode)); ?></strong></p>
                <?php if($p->status_periode === 'active'): ?>
                    <a href="<?php echo e(route('mahasiswa.kuisioner.show', $p->id_periode)); ?>" class="btn">Isi Kuisioner</a>
                <?php else: ?>
                    <button class="btn" disabled>Tidak Aktif</button>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Tidak ada periode kuisioner</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/mahasiswa/kuisioner/list.blade.php ENDPATH**/ ?>