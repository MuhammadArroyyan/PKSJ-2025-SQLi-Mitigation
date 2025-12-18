

<?php $__env->startSection('title', 'Kelola Mahasiswa'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
    <a href="<?php echo e(route('admin.users.index')); ?>">Kelola User</a>
    <a href="<?php echo e(route('admin.fakultas.index')); ?>">Kelola Fakultas</a>
    <a href="<?php echo e(route('admin.jurusan.index')); ?>">Kelola Jurusan</a>
    <a href="<?php echo e(route('admin.prodi.index')); ?>">Kelola Prodi</a>
    <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="active">Kelola Mahasiswa</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Kelola Mahasiswa</h1>
        <div class="page-header-actions">
            <a href="<?php echo e(route('admin.mahasiswa.create')); ?>" class="btn">Tambah Mahasiswa</a>
        </div>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>User</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($m->nim); ?></td>
                        <td><?php echo e($m->nama_mahasiswa); ?></td>
                        <td><?php echo e($m->user->nama_user); ?></td>
                        <td><?php echo e($m->prodi->nama_prodi); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.mahasiswa.edit', $m->nim)); ?>" class="btn">Edit</a>
                            <form action="<?php echo e(route('admin.mahasiswa.destroy', $m->nim)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/admin/mahasiswa/index.blade.php ENDPATH**/ ?>