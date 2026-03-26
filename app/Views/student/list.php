<?php // Feature Branch: Search, Pagination and REST API - GORCHRISTIAN ?>

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
        .table thead th { font-size: .8rem; text-transform: uppercase; letter-spacing: .05em; }
        .btn-action { width: 32px; height: 32px; padding: 0; line-height: 32px; font-size: .85rem; }
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

<!-- Main Content -->
<div class="container py-5">

    <!-- Flash Messages -->
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i><?= esc($title) ?></h5>
            <a href="/student/create" class="btn btn-light btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Student
            </a>
        </div>

        <div class="card-body">

            <!-- Search Form -->
            <form method="get" action="/student" class="mb-4">
                <div class="input-group" style="max-width: 400px;">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by name, email or course…"
                        value="<?= esc($keyword) ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <?php if ($keyword !== ''): ?>
                        <a href="/student" class="btn btn-outline-secondary">Clear</a>
                    <?php endif; ?>
                </div>
            </form>

            <!-- Student Table -->
            <?php if (empty($students)): ?>
                <div class="text-center text-muted py-5">
                    <i class="bi bi-inbox fs-1"></i>
                    <p class="mt-2">No students found.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Course</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $i => $student): ?>
                            <tr>
                                <td class="text-muted small"><?= esc($student['id']) ?></td>
                                <td>
                                    <div class="fw-semibold"><?= esc($student['name']) ?></div>
                                </td>
                                <td class="text-muted"><?= esc($student['email']) ?></td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                        <?= esc($student['course']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="/student/edit/<?= $student['id'] ?>"
                                       class="btn btn-outline-warning btn-action me-1"
                                       title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="/student/delete/<?= $student['id'] ?>"
                                       class="btn btn-outline-danger btn-action"
                                       title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this student?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                    <p class="text-muted small mb-0">
                        Showing <?= count($students) ?> record(s)
                        <?= $keyword !== '' ? 'for "' . esc($keyword) . '"' : '' ?>
                    </p>
                    <nav>
                        <?= $pager->links('students') ?>
                    </nav>
                </div>

            <?php endif; ?>
        </div><!-- /.card-body -->
    </div><!-- /.card -->
</div><!-- /.container -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
