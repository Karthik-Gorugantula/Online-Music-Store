

<?php
	session_start();
	require 'connection.php';

	// Get no.of items available in the cart table
	if (isset($_GET['cart-item']) && isset($_GET['cart-item']) == 'cart_item') {
	  $stmt = $con->prepare('SELECT * FROM cart');
	  $stmt-> execute();
	  $stmt-> store_result();
	  $rows = $stmt->num_rows;
	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $con->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// // Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $con->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table (MODULE NOT SET)
	if (isset($_GET['npid'])) {
	  $qty = $_POST['nqty'];
	  $pid = $_POST['npid'];
	  $pprice = $_POST['nprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET quantity=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}

	// // Checkout and save customer info in the orders table
	// if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	//   $name = $_POST['name'];
	//   $email = $_POST['email'];
	//   $phone = $_POST['phone'];
	//   $products = $_POST['products'];
	//   $grand_total = $_POST['grand_total'];
	//   $address = $_POST['address'];
	//   $pmode = $_POST['pmode'];

	//   $data = '';

	//   $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
	//   $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total);
	//   $stmt->execute();
	//   $stmt2 = $conn->prepare('DELETE FROM cart');
	//   $stmt2->execute();
	//   $data .= '<div class="text-center">
	// 							<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
	// 							<h2 class="text-success">Your Order Placed Successfully!</h2>
	// 							<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
	// 							<h4>Your Name : ' . $name . '</h4>
	// 							<h4>Your E-mail : ' . $email . '</h4>
	// 							<h4>Your Phone : ' . $phone . '</h4>
	// 							<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
	// 							<h4>Payment Mode : ' . $pmode . '</h4>
	// 					  </div>';
	//   echo $data;
	// }
	
?>