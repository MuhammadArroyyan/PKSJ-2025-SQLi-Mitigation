

<?php $__env->startSection('title', 'Jawaban Mahasiswa'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kaprodi.dashboard')); ?>">Dashboard</a>
    <a href="<?php echo e(route('kaprodi.periode.index')); ?>">Periode Kuisioner</a>
    <a href="<?php echo e(route('kaprodi.pertanyaan.index')); ?>">Pertanyaan</a>
    <a href="<?php echo e(route('kaprodi.summary.index')); ?>">Summary</a>
    <a href="<?php echo e(route('kaprodi.jawaban.index')); ?>" class="active">Jawaban Mahasiswa</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Jawaban Mahasiswa</h1>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>NIM Mahasiswa</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Periode</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $jawaban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($j->nim); ?></td>
                        <td><?php echo e($j->pertanyaan->pertanyaan); ?></td>
                        <td><?php echo e($j->pilihanJawaban->deskripsi_pilihan); ?></td>
                        <td><?php echo e($j->periode->keterangan); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/kaprodi/jawaban/index.blade.php ENDPATH**/ ?>