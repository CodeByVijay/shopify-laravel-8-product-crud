<!doctype html>
<html lang="en">

<head>
    <title>Product Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container mt-4 mb-4">

        <h3>Hello Welcome to Laravel Shopify App</h3>
        <h4>You are: <span style="color: red"><?php echo e($shopDomain ?? Auth::user()->name); ?></span></h4>
        

        <div class="table-responsive text-center">
            <table class="table table-bordered" id="productTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php $__empty_1 = true; $__currentLoopData = $products['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td scope="row"><?php echo e($i++); ?></td>

                            <td><img src="<?php echo e($row['image']['src']); ?>" alt="" width="100" height="100">
                            </td>
                            <td><?php echo e($row['title']); ?></td>
                            <td><?php echo wordwrap($row['body_html'], 30, '<br>'); ?></td>
                            <td>
                                <a href="javascript:void(0)" data-id="<?php echo e($row['id']); ?>" onclick="modelOpen(this)"
                                    class="btn btn-primary"><i class="fa fa-pencil-square"></i></a>
                                <a href="<?php echo e(route('productDelete', ['id' => $row['id']])); ?>" class="btn btn-danger"
                                    onclick="return confirm('Are you sure. want to delete this product.')"><i
                                        class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <h4 class="text-center">No Product Found.</h4>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

    
    <div class="modal fade" id="productEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('editSingleProduct')); ?>" method="POST">
                    <div class="modal-body">

                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="productId" id="productId">
                        <div class="image">
                            <img src="" alt="" id="image" height="200" style="width: 100%">
                        </div>
                        <div class="form-group">
                            <label for="productTitle" class="col-form-label">Product Title:</label>
                            <input type="text" name="productTitle" id="productTitle" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="productDesc" class="col-form-label">Product Description:</label>
                            <textarea class="form-control" name="productDesc" id="productDesc"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary updateBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
        });
    </script>

    
    <script>
        function modelOpen(e) {
            let pid = $(e).data('id');
            // console.log(pid)
            $.ajax({
                type: "post",
                url: "<?php echo e(route('getSingleProduct')); ?>",
                data: {
                    "pid": pid
                },
                beforeSend: function() {
                    // setting a timeout
                    // $('.updateBtn').addClass('btn-primary');
                    // $('.updateBtn').addClass('btn-danger');
                    // $('.updateBtn').attr('disabled',true);
                    // $('.updateBtn').html('Updating...');
                },
                success: function(response) {
                    if (response.msg === "success") {
                        let productModal = $('#productEditModel');
                        // console.log(response.product.product);
                        $('#image').attr('src', response.product.product.image.src)
                        $('#productId').val(response.product.product.id)
                        $('#productTitle').val(response.product.product.title)
                        $('#productDesc').val(response.product.product.body_html.replace(/(<([^>]+)>)/ig, ""))
                        productModal.modal('show');
                    }

                }
            });
        }
    </script>
</body>

</html>
<?php /**PATH /home/chhabicl/shopify.vijayamule.in/resources/views/welcome.blade.php ENDPATH**/ ?>