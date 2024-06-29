<?php $__env->startSection('content'); ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Plans Management Box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Plans Management</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-block btn-outline-primary"
                                    style="margin-left: 5px;" data-toggle="modal"
                                    data-target="#addPlanModal">
                                    Add Plan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" id="planTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Plan Type</th>
                                <th>Plan Name</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($plan->plan_id); ?></td>
                                    <td><?php echo e($plan->plan_type); ?></td>
                                    <td><?php echo e($plan->plan_name); ?></td>
                                    <td><?php echo e($plan->amount); ?></td>
                                    <td><?php echo e($plan->plan_description); ?></td>
                                    <td>
                                        <!-- Edit Icon -->
                                        <a href="#"
                                            class="text-indigo-600 hover:text-indigo-900 edit-plan-btn"
                                            data-toggle="modal" data-target="#editPlanModal"
                                            data-id="<?php echo e($plan->plan_id); ?>"
                                            data-type="<?php echo e($plan->plan_type); ?>"
                                            data-name="<?php echo e($plan->plan_name); ?>"
                                            data-amount="<?php echo e($plan->amount); ?>"
                                            data-description="<?php echo e($plan->plan_description); ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Icon -->
                                        |
                                        <a href="#" class="text-red-600 hover:text-red-900 delete-btn"
                                            data-festival-id="<?php echo e($plan->plan_id); ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>

                                        <!-- Delete Form -->
                                        <form id="delete-form-<?php echo e($plan->plan_id); ?>"
                                            action="<?php echo e(route('admin.plans.destroy', $plan->plan_id)); ?>"
                                            method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6">No plans found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal for Editing Plans -->
            <div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="editPlanModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editPlanForm" action="<?php echo e(route('admin.plans.update', ':plan_id')); ?>"
                            method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPlanModalLabel">Edit Plan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="edit_plan_type">Plan Type</label>
                                    <input type="text" class="form-control" id="edit_plan_type"
                                        name="plan_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_plan_name">Plan Name</label>
                                    <input type="text" class="form-control" id="edit_plan_name"
                                        name="plan_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_amount">Amount</label>
                                    <input type="number" class="form-control" id="edit_amount"
                                        name="amount" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_plan_description">Plan Description</label>
                                    <textarea class="form-control" id="edit_plan_description" name="plan_description" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal for Adding Plans -->
            <div class="modal fade" id="addPlanModal" tabindex="-1" aria-labelledby="addPlanModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?php echo e(route('admin.plans.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPlanModalLabel">Add Plan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="plan_type">Plan Type</label>
                                    <input type="text" class="form-control" id="plan_type"
                                        name="plan_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="plan_name">Plan Name</label>
                                    <input type="text" class="form-control" id="plan_name"
                                        name="plan_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="plan_description">Plan Description</label>
                                    <textarea class="form-control" id="plan_description" name="plan_description" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Plan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/projects/laravel-11-multi-auth/resources/views/admin/layouts/plans.blade.php ENDPATH**/ ?>