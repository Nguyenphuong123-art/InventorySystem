<?php
$page_title = 'Export Products';
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
          <a href="product.php" class="btn btn-primary">Back</a>
        </div>
      </div>
      <div class="panel-body">
        <form action="export_results.php" method="post">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th>Photo</th>
                <th>Product Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Recipient</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product) : ?>
                <tr>
                  <td class="text-center"><?php echo $product['id']; ?></td>
                  <td>
                    <?php if ($product['media_id'] === '0') : ?>
                      <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                    <?php else : ?>
                      <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                    <?php endif; ?>
                  </td>
                  <td><?php echo remove_junk($product['name']); ?></td>
                  <td class="text-center">
                    <input type="number" class="form-control" name="quantity[<?php echo $product['id']; ?>]" value="0" min="0" max="<?php echo remove_junk($product['quantity']); ?>">
                  </td>
                  <td class="text-center">
                    <input type="text" class="form-control" name="recipient[<?php echo $product['id']; ?>]" value="">
                  </td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-success btn-xs" title="Export" data-toggle="tooltip" name="export" value="<?php echo $product['id']; ?>">
                        <span class="glyphicon glyphicon-export"></span>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
