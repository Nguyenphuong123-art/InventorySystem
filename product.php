<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Kiểm tra quyền truy cập của người dùng vào trang này
  page_require_level(2);
  $products = join_product_table();

  // Xử lý tìm kiếm sản phẩm theo tên
  if (isset($_POST['search'])) {
    $search = remove_junk($db->escape($_POST['product-search']));
    $products = search_product($search);
  }
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-right">
          <a href="add_product.php" class="btn btn-primary">Add New</a>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <form method="post" action="product.php" class="clearfix">
              <div class="input-group">
                <input type="text" class="form-control" name="product-search" placeholder="Search by Product Name">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit" name="search">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Photo</th>
              <th> Product Name </th>
              <th class="text-center" style="width: 15%;">Quantity</th>
              <th class="text-center" style="width: 15%;">Location</th>
              <th class="text-center" style="width: 15%;">Specification</th>
              <th class="text-center" style="width: 15%;">Recipient</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td>
                  <?php if ($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['location']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['specification']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['recipient']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id']; ?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id']; ?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                  <div class="pull-right">
                    <a href="export_products_pdf.php" class="btn btn-success">Export to PDF</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
