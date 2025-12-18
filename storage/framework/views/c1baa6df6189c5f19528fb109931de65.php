

<?php $__env->startSection('title', 'Periode Kuisioner'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kaprodi.dashboard')); ?>">Dashboard</a>
    <a href="<?php echo e(route('kaprodi.periode.index')); ?>" class="active">Periode Kuisioner</a>
    <a href="<?php echo e(route('kaprodi.pertanyaan.index')); ?>">Pertanyaan</a>
    <a href="<?php echo e(route('kaprodi.summary.index')); ?>">Summary</a>
    <a href="<?php echo e(route('kaprodi.jawaban.index')); ?>">Jawaban Mahasiswa</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Periode Kuisioner</h1>
        <div class="page-header-actions">
            <a href="<?php echo e(route('kaprodi.periode.create')); ?>" class="btn">Buat Periode</a>
        </div>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $periode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($p->id_periode); ?></td>
                        <td><?php echo e($p->keterangan); ?></td>
                        <td><?php echo e(ucfirst($p->status_periode)); ?></td>
                        <td>
                            <a href="<?php echo e(route('kaprodi.periode.edit', $p->id_periode)); ?>" class="btn">Edit</a>
                            <form action="<?php echo e(route('kaprodi.periode.destroy', $p->id_periode)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/kaprodi/periode/index.blade.php ENDPATH**/ ?>