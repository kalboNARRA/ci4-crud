<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | StudentHub</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .card-header { border-radius: 12px 12px 0 0 !important; }
        .section-label { font-size: .7rem; text-transform: uppercase; letter-spacing: .08em; color: #6c757d; font-weight: 600; }
        .form-title { font-size: 1.25rem; font-weight: 700; }
        .form-subtitle { font-size: .85rem; color: #6c757d; }
        .field-num { font-weight: 700; color: #0d6efd; font-size: .9rem; }
        .back-link { font-size: .85rem; text-decoration: none; color: #6c757d; }
        .back-link:hover { color: #0d6efd; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/student">
            <i class="bi bi-mortarboard-fill me-2"></i>StudentHub
        </a>
        <span class="navbar-text text-white-50 small">CodeIgniter 4 CRUD</span>
    </div>
</nav>

<div class="container py-5" style="max-width: 640px;">

    <!-- Back link -->
    <a href="/student" class="back-link d-inline-flex align-items-center mb-3">
        <i class="bi bi-arrow-left me-1"></i> Back to Students
    </a>

    <div class="card">
        <div class="card-header bg-white pt-4 pb-3 px-4 border-bottom">
            <div class="section-label mb-1">
                <?= isset($student) ? '— Edit Record' : '— New Entry' ?>
            </div>
            <div class="form-title">
                <?= isset($student) ? 'Update Student' : 'Add Student' ?>
            </div>
            <p class="form-subtitle mb-0">
                <?= isset($student)
                    ? 'Revise the details below and save your changes.'
                    : 'Fill in the details below to register a new student.' ?>
            </p>
        </div>

        <div class="card-body px-4 py-4">

            <!-- Validation Errors -->
            <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        <?php foreach ($validation->getErrors() as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form: toggles between store and update based on $student -->
            <form method="post"
                  action="<?= isset($student)
                      ? '/student/update/' . $student['id']
                      : '/student/store' ?>">
                <?= csrf_field() ?>

                <!-- Field 01: Full Name -->
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-1">
                        <span class="field-label me-2">
                            <span>Full Name</span>
                        </span>
                        <div class="field-num">:01</div>
                    </div>
                    <input
                        type="text"
                        name="name"
                        class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>"
                        placeholder="e.g. Juan dela Cruz"
                        value="<?= isset($student) ? esc($student['name']) : old('name') ?>">
                    <?php if (isset($validation) && $validation->hasError('name')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('name') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Field 02: Email -->
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-1">
                        <span class="field-label me-2">
                            <span>Email Address</span>
                        </span>
                        <div class="field-num">:02</div>
                    </div>
                    <input
                        type="email"
                        name="email"
                        class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>"
                        placeholder="e.g. juan@email.com"
                        value="<?= isset($student) ? esc($student['email']) : old('email') ?>">
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Field 03: Course -->
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-1">
                        <span class="field-label me-2">
                            <span>Course</span>
                        </span>
                        <div class="field-num">:03</div>
                    </div>
                    <input
                        type="text"
                        name="course"
                        class="form-control <?= isset($validation) && $validation->hasError('course') ? 'is-invalid' : '' ?>"
                        placeholder="e.g. BSIT"
                        value="<?= isset($student) ? esc($student['course']) : old('course') ?>">
                    <?php if (isset($validation) && $validation->hasError('course')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('course') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Submit -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-floppy-fill me-1"></i>
                        <?= isset($student) ? 'Save Changes' : 'Add Student' ?>
                    </button>
                    <a href="/student" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
