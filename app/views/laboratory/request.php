<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-8 flex items-center">
    <a href="<?php echo URLROOT; ?>/laboratory/index" class="mr-4 text-slate-500 hover:text-blue-600 transition-colors">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <h2 class="text-2xl font-bold text-slate-800">New Laboratory Test Order</h2>
        <p class="text-slate-500">Request diagnostic tests for patients.</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 max-w-2xl">
    <form action="<?php echo URLROOT; ?>/laboratory/request" method="post">
        <div class="space-y-6">
            <!-- Patient Selection -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Select Patient <span class="text-red-500">*</span></label>
                <select name="patient_id" class="w-full px-4 py-2 rounded-lg border <?php echo (!empty($data['patient_err'])) ? 'border-red-500 bg-red-50' : 'border-slate-200 focus:border-blue-500'; ?> outline-none transition-all">
                    <option value="">- Choose Patient -</option>
                    <?php foreach($data['patients'] as $patient) : ?>
                        <option value="<?php echo $patient->id; ?>" <?php echo ($data['patient_id'] == $patient->id) ? 'selected' : ''; ?>>
                            <?php echo $patient->name; ?> (<?php echo $patient->patient_id; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-xs text-red-500"><?php echo $data['patient_err']; ?></span>
            </div>

            <!-- Doctor Selection -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Requested By (Doctor) <span class="text-red-500">*</span></label>
                <select name="doctor_id" class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-blue-500 outline-none transition-all">
                    <option value="">- Choose Doctor -</option>
                    <?php foreach($data['doctors'] as $doctor) : ?>
                        <option value="<?php echo $doctor->id; ?>" <?php echo ($data['doctor_id'] == $doctor->id) ? 'selected' : ''; ?>>
                            Dr. <?php echo $doctor->name; ?> (<?php echo $doctor->department; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Test Selection -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Select Test <span class="text-red-500">*</span></label>
                <select name="test_id" class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-blue-500 outline-none transition-all">
                    <option value="">- Choose Test -</option>
                    <?php foreach($data['tests'] as $test) : ?>
                        <option value="<?php echo $test->id; ?>" <?php echo ($data['test_id'] == $test->id) ? 'selected' : ''; ?>>
                            <?php echo $test->test_name; ?> (৳ <?php echo $test->price; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all transform active:scale-95">
                    Submit Request
                </button>
            </div>
        </div>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
