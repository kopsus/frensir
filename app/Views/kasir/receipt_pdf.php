<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt <?= $order_code ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .container { width: 100%; max-width: 600px; margin: auto; }
        .header { text-align: center; font-size: 18px; font-weight: bold; }
        .order-details, .items, .summary { width: 100%; margin-top: 10px; }
        .items th, .items td { border-bottom: 1px solid #ddd; padding: 5px; text-align: left; }
        .summary td { padding: 5px; text-align: right; }
    </style>
</head>
<body>
    <div class="container">
        <p class="header">Receipt</p>
        <p><strong>Order ID:</strong> <?= $order_code ?></p>
        <p><strong>Date:</strong> <?= $formatted_date ?></p>
        
        <table class="items">
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $item): ?>
                <tr>
                    <td><?= $item['Jumlah_Produk'] ?></td>
                    <td><?= $item['Nama_Produk'] ?></td>
                    <td>Rp<?= number_format($item['Harga'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <table class="summary">
            <tr>
                <td>Subtotal:</td>
                <td>Rp<?= number_format($subtotal) ?></td>
            </tr>
            <tr>
                <td>Tax:</td>
                <td>Rp<?= number_format($tax) ?></td>
            </tr>
            <tr>
                <td><strong>Total:</strong></td>
                <td><strong>Rp<?= number_format($final_total) ?></strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
