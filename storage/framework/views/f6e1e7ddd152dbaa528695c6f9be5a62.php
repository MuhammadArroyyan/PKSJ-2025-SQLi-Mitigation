

<?php $__env->startSection('title', 'Isi Kuisioner'); ?>

<?php $__env->startSection('extra_styles'); ?>
    <style>
        .pertanyaan-item {
            border: 2px solid #6366f1;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #0f1419;
        }
        
        .pertanyaan-item h3 {
            color: #e4e6eb;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .pilihan-label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px 15px;
            background: #1a1f2e;
            border: 1px solid #6366f1;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            color: #e4e6eb;
            font-weight: 500;
        }
        
        .pilihan-label:hover {
            background: #6366f1;
            color: white;
            transform: translateX(5px);
        }
        
        .pilihan-label input {
            margin-right: 10px;
            accent-color: #6366f1;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('mahasiswa.dashboard')); ?>">Dashboard</a>
    <a href="<?php echo e(route('mahasiswa.kuisioner.list')); ?>" class="active">Daftar Kuisioner</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1><?php echo e($periode->keterangan); ?></h1>
    </div>
    
    <div class="card">
        <form action="<?php echo e(route('mahasiswa.kuisioner.store', $periode->id_periode)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <?php $__empty_1 = true; $__currentLoopData = $pertanyaanPeriode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="pertanyaan-item">
                    <h3><?php echo e($pp->pertanyaan->pertanyaan); ?></h3>
                    
                    <?php $__currentLoopData = $pp->pertanyaan->pilihanJawaban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="pilihan-label">
                            <input type="radio" 
                                   name="jawaban[<?php echo e($pp->pertanyaan->id_pertanyaan); ?>]" 
                                   value="<?php echo e($pilihan->id_pilihan_jawaban); ?>"
                                   <?php echo e((isset($jawaban[$pp->pertanyaan->id_pertanyaan]) && $jawaban[$pp->pertanyaan->id_pertanyaan]->id_pilihan_jawaban_pertanyaan === $pilihan->id_pilihan_jawaban) ? 'checked' : ''); ?>

                                   required>
                            <?php echo e($pilihan->deskripsi_pilihan); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php $__errorArgs = ["jawaban.{$pp->pertanyaan->id_pertanyaan}"];
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Tidak ada pertanyaan dalam periode ini</p>
            <?php endif; ?>
            
            <?php if($pertanyaanPeriode->count() > 0): ?>
                <button type="submit" class="btn btn-success">Simpan Jawaban</button>
                <a href="<?php echo e(route('mahasiswa.kuisioner.list')); ?>" class="btn">Batal</a>
            <?php endif; ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/mahasiswa/kuisioner/show.blade.php ENDPATH**/ ?>