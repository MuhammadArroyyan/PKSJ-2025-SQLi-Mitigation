

<?php $__env->startSection('title', 'Summary'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kaprodi.dashboard')); ?>">Dashboard</a>
    <a href="<?php echo e(route('kaprodi.periode.index')); ?>">Periode Kuisioner</a>
    <a href="<?php echo e(route('kaprodi.pertanyaan.index')); ?>">Pertanyaan</a>
    <a href="<?php echo e(route('kaprodi.summary.index')); ?>" class="active">Summary</a>
    <a href="<?php echo e(route('kaprodi.jawaban.index')); ?>">Jawaban Mahasiswa</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Summary Pengisian Kuisioner</h1>
    </div>
    
    <div class="card">
        <form method="GET" style="display: flex; gap: 10px; align-items: flex-end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label for="periode">Pilih Periode</label>
                <select id="periode" name="id_periode" required>
                    <option value="">-- Pilih Periode --</option>
                    <?php $__currentLoopData = $periode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->id_periode); ?>" <?php echo e(request('id_periode') == $p->id_periode ? 'selected' : ''); ?>>
                            <?php echo e($p->keterangan); ?> (<?php echo e($p->status_periode); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="btn">Lihat Summary</button>
        </form>
    </div>

    <?php if(request('id_periode')): ?>
        <?php
            $id_periode = request('id_periode');
            $prodi = Auth::user()->prodi()->first();
            $pertanyaan = \App\Models\_2301020106_Pertanyaan::where('id_prodi', $prodi->id_prodi)
                ->with('pilihanJawaban')
                ->whereHas('periode', function($query) use ($id_periode) {
                    $query->where('id_periode', $id_periode);
                })
                ->get();
            $periode = \App\Models\_2301020106_PeriodeKuisioner::find($id_periode);
        ?>

        <?php if(!$prodi): ?>
            <div class="alert alert-warning">
                Anda belum ditugaskan sebagai kaprodi untuk prodi manapun.
            </div>
        <?php elseif($pertanyaan->isEmpty()): ?>
            <div class="alert alert-warning">
                Tidak ada pertanyaan untuk prodi <?php echo e($prodi->nama_prodi); ?>.
            </div>
        <?php else: ?>
            <div class="card">
                <h3>Periode: <?php echo e($periode->keterangan); ?></h3>
                <p style="color: #666;">Program Studi: <strong><?php echo e($prodi->nama_prodi); ?></strong></p>
                
                <!-- DEBUG INFO -->
                <div style="background: #2d2d2d; padding: 10px; margin-bottom: 15px; border-left: 3px solid #6366f1; color: #a0aec0; font-size: 12px;">
                    <strong>Debug:</strong> Prodi ID: <?php echo e($prodi->id_prodi); ?>, Periode ID: <?php echo e($id_periode); ?>, Questions Found: <?php echo e($pertanyaan->count()); ?>

                </div>
                
                <?php $__currentLoopData = $pertanyaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Get all answers for this question and period
                        $allJawaban = \App\Models\_2301020002_Jawaban::where('id_pertanyaan', $p->id_pertanyaan)
                            ->where('id_periode', $id_periode)
                            ->get();
                        
                        // Group by choice
                        $jawabanGrouped = $allJawaban->groupBy('id_pilihan_jawaban_pertanyaan')
                            ->map(fn($group) => $group->count());
                        
                        $totalJawaban = $allJawaban->count();
                        
                        // Debug: Log jawaban count
                        // \Log::info("Q{$p->id_pertanyaan} Periode{$id_periode}: Total=" . $totalJawaban);
                    ?>
                    
                    <div style="margin-bottom: 20px; padding: 15px; border: 2px solid #6366f1; border-radius: 8px; background: #0f1419;">
                        <h4 style="color: #e4e6eb; font-size: 16px; margin-bottom: 10px;"><?php echo e($p->pertanyaan); ?></h4>
                        <small style="color: #888; margin-bottom: 10px; display: block;">Total jawaban ditemukan: <strong><?php echo e($totalJawaban); ?></strong></small>
                        
                        <?php if($totalJawaban == 0): ?>
                            <p style="color: #a0aec0;">Belum ada jawaban untuk pertanyaan ini.</p>
                        <?php else: ?>
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #1a1f2e; border-bottom: 2px solid #6366f1;">
                                        <th style="padding: 10px; text-align: left; color: #e4e6eb; font-weight: 600;">Pilihan</th>
                                        <th style="padding: 10px; text-align: center; color: #e4e6eb; font-weight: 600;">Jumlah</th>
                                        <th style="padding: 10px; text-align: center; color: #e4e6eb; font-weight: 600;">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $p->pilihanJawaban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $count = $jawabanGrouped[$pilihan->id_pilihan_jawaban_pertanyaan] ?? 0;
                                            $persentase = $totalJawaban > 0 ? round(($count / $totalJawaban) * 100, 2) : 0;
                                        ?>
                                        <tr style="border-bottom: 1px solid #6366f1;">
                                            <td style="padding: 10px; color: #e4e6eb;"><?php echo e($pilihan->deskripsi_pilihan); ?></td>
                                            <td style="padding: 10px; text-align: center; color: #e4e6eb;"><?php echo e($count); ?></td>
                                            <td style="padding: 10px; text-align: center;">
                                                <div style="background-color: #6366f1; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
                                                    <?php echo e($persentase); ?>%
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <p style="margin-top: 10px; color: #a0aec0;"><strong>Total Responden:</strong> <?php echo e($totalJawaban); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/kaprodi/summary/index.blade.php ENDPATH**/ ?>