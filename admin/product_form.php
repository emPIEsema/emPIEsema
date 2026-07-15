<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

requireAdmin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['id']) ? (int)$_POST['id'] : 0);
$isEdit = $id > 0;

$errors = [];

$product = [
    'name' => '', 'code' => '', 'price' => '', 'image' => '', 'status' => '',
    'color' => '', 'material' => '', 'dimensions' => '', 'description' => '',
    'made' => '', 'category' => '', 'featured' => 0, 'stock' => 3,
];
$leftSpecsText = '';
$rightSpecsText = '';

if ($isEdit && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $existing = getProductById($pdo, $id);
    if (!$existing) {
        header('Location: index.php');
        exit;
    }
    $product = $existing;
    $leftSpecsText = implode("\n", $existing['left_specs']);
    $rightSpecsText = implode("\n", $existing['right_specs']);
}

function uploadProductImage(array $file): array
{
    // Returns [success bool, path-or-error string]
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'];
    $maxBytes = 5 * 1024 * 1024;

    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return [true, null];
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return [false, 'Image upload failed. Please try again.'];
    }
    if ($file['size'] > $maxBytes) {
        return [false, 'Image must be smaller than 5MB.'];
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        return [false, 'Image must be a JPG, PNG, WEBP, AVIF, or GIF file.'];
    }

    $filename = 'product-' . bin2hex(random_bytes(8)) . '.' . $ext;
    $destination = __DIR__ . '/../images/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return [false, 'Could not save the uploaded image.'];
    }

    return [true, 'images/' . $filename];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product['name'] = trim($_POST['name'] ?? '');
    $product['code'] = trim($_POST['code'] ?? '');
    $product['price'] = trim($_POST['price'] ?? '');
    $product['image'] = trim($_POST['current_image'] ?? '');
    $product['status'] = trim($_POST['status'] ?? '');
    $product['color'] = trim($_POST['color'] ?? '');
    $product['material'] = trim($_POST['material'] ?? '');
    $product['dimensions'] = trim($_POST['dimensions'] ?? '');
    $product['description'] = trim($_POST['description'] ?? '');
    $product['made'] = trim($_POST['made'] ?? '');
    $product['category'] = $_POST['category'] ?? '';
    $product['featured'] = isset($_POST['featured']) ? 1 : 0;
    $product['stock'] = trim($_POST['stock'] ?? '');

    $leftSpecsText = $_POST['left_specs'] ?? '';
    $rightSpecsText = $_POST['right_specs'] ?? '';

    if ($product['name'] === '') {
        $errors[] = 'Name is required.';
    }
    if ($product['price'] === '' || !is_numeric($product['price'])) {
        $errors[] = 'Price must be a number.';
    }
    if ($product['stock'] === '' || !ctype_digit($product['stock'])) {
        $errors[] = 'Stock must be a whole number (0 or more).';
    }

    if (!empty($_FILES['image_file']['name'])) {
        [$uploadOk, $result] = uploadProductImage($_FILES['image_file']);
        if (!$uploadOk) {
            $errors[] = $result;
        } elseif ($result !== null) {
            $product['image'] = $result;
        }
    }

    if (empty($errors)) {

        $data = [
            ':name' => $product['name'],
            ':code' => $product['code'] !== '' ? $product['code'] : null,
            ':price' => $product['price'],
            ':image' => $product['image'] !== '' ? $product['image'] : null,
            ':status' => $product['status'] !== '' ? $product['status'] : null,
            ':color' => $product['color'] !== '' ? $product['color'] : null,
            ':material' => $product['material'] !== '' ? $product['material'] : null,
            ':dimensions' => $product['dimensions'] !== '' ? $product['dimensions'] : null,
            ':description' => $product['description'] !== '' ? $product['description'] : null,
            ':made' => $product['made'] !== '' ? $product['made'] : null,
            ':category' => $product['category'] !== '' ? $product['category'] : null,
            ':featured' => $product['featured'],
            ':stock' => $product['stock'],
        ];

        $leftSpecs = array_filter(array_map('trim', explode("\n", $leftSpecsText)), fn($v) => $v !== '');
        $rightSpecs = array_filter(array_map('trim', explode("\n", $rightSpecsText)), fn($v) => $v !== '');

        if ($isEdit) {
            updateProduct($pdo, $id, $data, $leftSpecs, $rightSpecs);
        } else {
            $id = createProduct($pdo, $data, $leftSpecs, $rightSpecs);
        }

        header('Location: index.php?saved=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isEdit ? 'Edit' : 'Add'; ?> Product | emPIEsema Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css?v=6">
</head>
<body>

<div class="admin-topbar">
    <div class="admin-brand">
        <span class="mark">emPIEsema</span>
        <span class="tag">Admin</span>
    </div>
    <div class="admin-user">
        <span>Logged in as <strong><?php echo htmlspecialchars(currentUsername()); ?></strong></span>
        <a href="../index.php" class="view-site" target="_blank">View Site</a>
        <a href="../logout.php" class="logout-link">Logout</a>
    </div>
</div>

<div class="admin-wrap">

    <form class="admin-form" method="POST" enctype="multipart/form-data">

        <h1><?php echo $isEdit ? 'Edit Product' : 'Add Product'; ?></h1>

        <?php if (!empty($errors)): ?>
            <div class="error"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
        <?php endif; ?>

        <input type="hidden" name="id" value="<?php echo (int)$id; ?>">
        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($product['image'] ?? ''); ?>">

        <div class="form-section-label">Basic Details</div>

        <div class="form-row">
            <div class="field">
                <label>Name *</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="field">
                <label>Code</label>
                <input type="text" name="code" value="<?php echo htmlspecialchars($product['code'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="field">
                <label>Price (₱) *</label>
                <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars((string)$product['price']); ?>" required>
            </div>
            <div class="field">
                <label>Stock *</label>
                <input type="number" step="1" min="0" name="stock" value="<?php echo htmlspecialchars((string)$product['stock']); ?>" required>
            </div>
        </div>

        <div class="field">
            <label>Product Image</label>
            <div class="image-upload">
                <?php if (!empty($product['image'])): ?>
                    <img src="../<?php echo htmlspecialchars($product['image']); ?>" alt="" class="image-upload-preview" id="imagePreview">
                <?php else: ?>
                    <div class="image-upload-preview image-upload-empty" id="imagePreview"><i class="fa-solid fa-image"></i></div>
                <?php endif; ?>
                <div class="image-upload-controls">
                    <label for="image_file" class="btn-secondary image-upload-btn"><i class="fa-solid fa-upload"></i> <?php echo !empty($product['image']) ? 'Replace Image' : 'Upload Image'; ?></label>
                    <input type="file" id="image_file" name="image_file" accept=".jpg,.jpeg,.png,.webp,.avif,.gif" style="display:none;">
                    <small>JPG, PNG, WEBP, AVIF or GIF — up to 5MB</small>
                </div>
            </div>
        </div>

        <div class="form-section-label">Classification</div>

        <div class="form-row">
            <div class="field">
                <label>Category</label>
                <select name="category">
                    <option value="" <?php echo empty($product['category']) ? 'selected' : ''; ?>>— None —</option>
                    <?php foreach (['travel' => 'Travel Bags', 'men' => "Men's Bags", 'women' => "Women's Bags", 'backpack' => 'Backpacks'] as $val => $label): ?>
                        <option value="<?php echo $val; ?>" <?php echo ($product['category'] ?? '') === $val ? 'selected' : ''; ?>><?php echo $label; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label>Status</label>
                <input type="text" name="status" placeholder="New, Limited Edition, ..." value="<?php echo htmlspecialchars($product['status'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-section-label">Materials</div>

        <div class="form-row">
            <div class="field">
                <label>Color</label>
                <input type="text" name="color" value="<?php echo htmlspecialchars($product['color'] ?? ''); ?>">
            </div>
            <div class="field">
                <label>Material</label>
                <input type="text" name="material" value="<?php echo htmlspecialchars($product['material'] ?? ''); ?>">
            </div>
            <div class="field">
                <label>Dimensions</label>
                <input type="text" name="dimensions" placeholder="16 × 33 × 5.7 cm" value="<?php echo htmlspecialchars($product['dimensions'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-section-label">Description</div>

        <div class="field">
            <label>Description</label>
            <textarea name="description" rows="4"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
        </div>

        <div class="field">
            <label>Made in</label>
            <input type="text" name="made" value="<?php echo htmlspecialchars($product['made'] ?? ''); ?>">
        </div>

        <div class="form-row">
            <div class="field">
                <label>Left column specs</label>
                <small>One per line</small>
                <textarea name="left_specs" rows="6"><?php echo htmlspecialchars($leftSpecsText); ?></textarea>
            </div>
            <div class="field">
                <label>Right column specs</label>
                <small>One per line</small>
                <textarea name="right_specs" rows="6"><?php echo htmlspecialchars($rightSpecsText); ?></textarea>
            </div>
        </div>

        <div class="field field-checkbox">
            <input type="checkbox" id="featured" name="featured" <?php echo !empty($product['featured']) ? 'checked' : ''; ?>>
            <label for="featured">Show in homepage Featured Collection</label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary"><i class="fa-solid fa-check"></i> Save Product</button>
            <a href="index.php" class="btn-secondary">Cancel</a>
        </div>

    </form>

</div>

<script>
    document.getElementById('image_file').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (ev) {
            let preview = document.getElementById('imagePreview');
            if (preview.tagName === 'DIV') {
                const img = document.createElement('img');
                img.id = 'imagePreview';
                img.className = 'image-upload-preview';
                preview.replaceWith(img);
                preview = img;
            }
            preview.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>

</body>
</html>
