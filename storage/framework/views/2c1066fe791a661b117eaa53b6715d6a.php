<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Festival Management</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-block btn-outline-primary"
                                        style="margin-left: 5px;" data-toggle="modal" data-target="#addFestivalModal">
                                        Add Festival
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="addFestivalModal" tabindex="-1" aria-labelledby="addFestivalModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?php echo e(route('admin.festivals.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addFestivalModalLabel">Add Festival</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Festival Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" id="date" name="date"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject_line">Subject Line</label>
                                            <input type="text" class="form-control" id="subject_line"
                                                name="subject_line">
                                        </div>
                                        <div class="form-group">
                                            <label for="email_body">Email Body</label>
                                            <textarea class="form-control" id="email_body" name="email_body"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap" id="festivalTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Festival</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Subject Line</th>
                                    <th>Email Body</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $festivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $festival): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($festival->festival_id); ?></td>
                                        <td><?php echo e($festival->name); ?></td>
                                        <td><?php echo e($festival->date); ?></td>
                                        <td>
                                            <span
                                                class="<?php echo e($festival->status === 'Active' ? 'status-active' : 'status-inactive'); ?>">
                                                <?php echo e($festival->status); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($festival->subject_line); ?></td>
                                        <td><?php echo e($festival->email_body); ?></td>
                                        <td>
                                            <!-- Edit Icon -->
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                                data-toggle="modal"
                                                data-target="#editFestivalModal<?php echo e($festival->festival_id); ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete Icon -->
                                                            |
                                                            <a href="#"
                                                                class="text-red-600 hover:text-red-900 delete-btn"
                                                                data-festival-id="<?php echo e($festival->festival_id); ?>">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>

                                            <!-- Delete Form -->
                                            <form id="delete-form-<?php echo e($festival->festival_id); ?>"
                                                action="<?php echo e(route('admin.festivals.destroy', $festival->festival_id)); ?>"
                                                method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Festival Modal -->
                                    <div class="modal fade" id="editFestivalModal<?php echo e($festival->festival_id); ?>"
                                        tabindex="-1" aria-labelledby="editFestivalModalLabel<?php echo e($festival->festival_id); ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form
                                                    action="<?php echo e(route('admin.festivals.update', $festival->festival_id)); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editFestivalModalLabel<?php echo e($festival->festival_id); ?>">
                                                            Edit Festival</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name<?php echo e($festival->festival_id); ?>">Festival
                                                                Name</label>
                                                            <input type="text" class="form-control"
                                                                id="name<?php echo e($festival->festival_id); ?>" name="name"
                                                                value="<?php echo e($festival->name); ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date<?php echo e($festival->festival_id); ?>">Date</label>
                                                            <input type="date" class="form-control"
                                                                id="date<?php echo e($festival->festival_id); ?>" name="date"
                                                                value="<?php echo e($festival->date); ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status<?php echo e($festival->festival_id); ?>">Status</label>
                                                            <select class="form-control"
                                                                id="status<?php echo e($festival->festival_id); ?>" name="status"
                                                                required>
                                                                <option value="active"
                                                                    <?php echo e($festival->status === 'active' ? 'selected' : ''); ?>>
                                                                    Active</option>
                                                                <option value="inactive"
                                                                    <?php echo e($festival->status === 'inactive' ? 'selected' : ''); ?>>
                                                                    Inactive</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_scheduled<?php echo e($festival->festival_id); ?>">Email
                                                                Scheduled</label>
                                                            <input type="text" class="form-control"
                                                                id="email_scheduled<?php echo e($festival->festival_id); ?>"
                                                                name="email_scheduled"
                                                                value="<?php echo e($festival->email_scheduled); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="subject_line<?php echo e($festival->festival_id); ?>">Subject
                                                                Line</label>
                                                            <input type="text" class="form-control"
                                                                id="subject_line<?php echo e($festival->festival_id); ?>"
                                                                name="subject_line"
                                                                value="<?php echo e($festival->subject_line); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_body<?php echo e($festival->festival_id); ?>">Email
                                                                Body</label>
                                                            <textarea class="form-control" id="email_body<?php echo e($festival->festival_id); ?>" name="email_body"><?php echo e($festival->email_body); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7">No festivals found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/projects/laravel-11-multi-auth/resources/views/admin/layouts/festivals.blade.php ENDPATH**/ ?>