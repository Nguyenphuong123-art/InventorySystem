<?php
// export_results.php

// Kiểm tra xem có dữ liệu được gửi từ form hay không
if (isset($_POST['export'])) {
    // Lấy dữ liệu sản phẩm được gửi từ form
    if (isset($_POST['id']) && isset($_POST['quantity']) && isset($_POST['recipient'])) {
      $productIds = $_POST['id'];
      $quantities = $_POST['quantity'];
      $recipients = $_POST['recipient'];
  
      // Hiển thị bảng kết quả mới nhập
      echo '<table class="table table-bordered">';
      echo '<thead>';
      echo '<tr>';
      echo '<th class="text-center">#</th>';
      echo '<th>Photo</th>';
      echo '<th>Product Name</th>';
      echo '<th class="text-center">Quantity</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      foreach ($productIds as $index => $productId) {
        $quantity = $quantities[$index];
        $recipient = $recipients[$index];
  
        // Cập nhật giá trị Quantity trong bảng products
        $query = "UPDATE products SET quantity = quantity - '{$quantity}' WHERE id = '{$productId}'";
        $db->query($query);
  
        // Hiển thị hàng mới nhập
        echo '<tr>';
        echo '<td class="text-center">' . ($index + 1) . '</td>';
        echo '<td>...</td>'; // Hiển thị ảnh sản phẩm
        echo '<td>...</td>'; // Hiển thị tên sản phẩm
        echo '<td class="text-center">' . $quantity . '</td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    } else {
      echo 'No data available.';
    }
  }  
?>
