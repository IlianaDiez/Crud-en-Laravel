<?php $__env->startSection('template_title'); ?>
    Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Cambiamos a container-fluid y agregamos padding lateral para ampliar el ancho -->
    <div class="container-fluid px-4 py-4">
        <div class="row">
            <div class="col-sm-12">
                
                <!-- Tarjeta Principal Ampliada -->
                <div class="card shadow-sm border-0 rounded-4">
                    
                    <!-- Cabecera -->
                    <div class="card-header bg-primary text-white py-3 px-4 rounded-top-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-boxes me-2"></i> <?php echo e(__('Lista de Productos')); ?>

                            </h5>
                            <a href="<?php echo e(route('products.create')); ?>" class="btn btn-light btn-sm fw-semibold text-primary shadow-sm px-3 py-2">
                                <i class="fa fa-plus me-1"></i> <?php echo e(__('Crear Nuevo')); ?>

                            </a>
                        </div>
                    </div>
                    
                    <!-- Mensaje de Éxito -->
                    <?php if($message = Session::get('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show m-4 shadow-sm" role="alert">
                            <strong>¡Excelente!</strong> <?php echo e($message); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="card-body bg-white p-4">
                        
                        <!-- Formulario de Filtros / Búsqueda -->
                        <form method="GET" action="<?php echo e(route('products.index')); ?>" class="mb-4">
                            <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                <input type="text" name="search" class="form-control border-0 bg-light px-4 py-2" placeholder="Buscar por nombre o descripción..." value="<?php echo e($search ?? request('search')); ?>">
                                <button class="btn btn-dark px-4" type="submit">
                                    <i class="fa fa-search me-1"></i> <?php echo e(__('Filtrar')); ?>

                                </button>
                                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary px-3">
                                    <i class="fa fa-redo"></i> <?php echo e(__('Limpiar')); ?>

                                </a>
                            </div>
                        </form>

                        <!-- Tabla con estilo para que el menú desplegable no se corte -->
                        <div style="min-height: 250px; overflow: visible !important;">
                            <table class="table table-hover align-middle">
                                <thead class="table-light text-uppercase fs-7 text-secondary">
                                    <tr>
                                        <th class="py-3 ps-3">#</th>
                                        <th class="py-3">Nombre</th>
                                        <th class="py-3">Descripción</th>
                                        <th class="py-3">Precio</th>
                                        <th class="py-3">Stock</th>
                                        <th class="py-3 text-center pe-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="fw-bold text-muted ps-3"><?php echo e(++$i); ?></td>
                                            <td>
                                                <span class="fw-semibold text-dark"><?php echo e($product->name); ?></span>
                                            </td>
                                            <td class="text-muted"><?php echo e($product->description); ?></td>
                                            <td>
                                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fw-bold">
                                                    $<?php echo e(number_format($product->price, 2)); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 fw-bold">
                                                    <?php echo e($product->stock); ?> unids.
                                                </span>
                                            </td>
                                            <td class="text-center pe-3">
                                                <!-- Menú desplegable de Tres Puntitos -->
                                                <div class="dropdown position-static">
                                                    <button class="btn btn-light btn-sm rounded-circle shadow-sm px-2 py-1" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Opciones">
                                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2">
                                                        <li>
                                                            <a class="dropdown-item py-2 text-primary fw-semibold" href="<?php echo e(route('products.show', $product->id)); ?>">
                                                                <i class="fa fa-eye me-2"></i> Ver
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item py-2 text-success fw-semibold" href="<?php echo e(route('products.edit', $product->id)); ?>">
                                                                <i class="fa fa-edit me-2"></i> Editar
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" class="d-inline">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="submit" class="dropdown-item py-2 text-danger fw-semibold" onclick="event.preventDefault(); confirm('¿Estás seguro de eliminar este producto?') ? this.closest('form').submit() : false;">
                                                                    <i class="fa fa-trash me-2"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                No se encontraron productos registrados.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <!-- Paginación -->
                <div class="mt-4 d-flex justify-content-center">
                    <?php echo $products->withQueryString()->links(); ?>

                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\crud_rapido\resources\views/product/index.blade.php ENDPATH**/ ?>