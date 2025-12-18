

<?php $__env->startSection('title', 'Tambah Mahasiswa'); ?>

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
        <h1>Tambah Mahasiswa</h1>
    </div>
    
    <div class="card">
        <form action="<?php echo e(route('admin.mahasiswa.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" required value="<?php echo e(old('nim')); ?>">
                <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div style="color: red; font-size: 14px;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="form-group">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" required value="<?php echo e(old('nama_mahasiswa')); ?>">
                <?php $__errorArgs = ['nama_mahasiswa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div style="color: red; font-size: 14px;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="form-group">
                <label for="id_prodi">Program Studi</label>
                <select id="id_prodi" name="id_prodi" required>
                    <option value="">-- Pilih Program Studi --</option>
                    <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->id_prodi); ?>" <?php echo e(old('id_prodi') == $p->id_prodi ? 'selected' : ''); ?>>
                            <?php echo e($p->nama_prodi); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['id_prodi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div style="color: red; font-size: 14px;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="btn">Batal</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/admin/mahasiswa/create.blade.php ENDPATH**/ ?>