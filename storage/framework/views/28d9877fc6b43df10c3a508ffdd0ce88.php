<?php $__env->startSection('content'); ?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Main Dashboard Content -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Total Contacts</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>
                            <p>Email sent ratio</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>Email open ratio</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Email reply ratio</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <section class="content">
                <div class="container-fluid">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Client List</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                                <button type="button" class="btn btn-block btn-outline-primary"
                                                    style="margin-left: 5px;" data-toggle="modal"
                                                    data-target="#addUserModal">
                                                    Add User
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($user->user_id); ?></td>
                                                <td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></td>
                                                <td><?php echo e($user->email); ?></td>
                                                <td><?php echo e($user->status); ?></td>
                                                <td><a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                                                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6">No users found</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Festival Management</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Festival</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>New Year's Day</td>
                                                <td>11-7-2014</td>
                                                <td><a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                                                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a></td>
                                            </tr>
                                            <tr>
                                                <td>Valentine's Day</td>
                                                <td>11-7-2014</td>
                                                <td><a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                                                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a></td>
                                            </tr>
                                            <tr>
                                                <td>Easter</td>
                                                <td>11-7-2014</td>
                                                <td><a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                                                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a></td>
                                            </tr>
                                            <tr>
                                                <td>Christmas</td>
                                                <td>11-7-2014</td>
                                                <td><a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                                                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    <!-- Add User Modal -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserModalLabel">Register a new membership</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo $__env->make('auth.register', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                <!-- Ratio Charts -->
                <div class="flex flex-wrap -mx-2 -my-2 justify-between mb-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex-1 mx-2 my-2">
                        <h3 class="text-lg font-semibold mb-2">Sales Chart</h3>
                        <canvas id="salesChart" width="400" height="200"></canvas>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex-1 mx-2 my-2">
                        <h3 class="text-lg font-semibold mb-2">User Growth Chart</h3>
                        <canvas id="userGrowthChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Sales',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
const userGrowthChart = new Chart(userGrowthCtx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'User Growth',
            data: [20, 15, 25, 30, 35, 40],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/projects/laravel-11-multi-auth/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>