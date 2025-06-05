<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Editace ročníku</title>
    <link rel="stylesheet" href="<?= base_url('node_modules/flag-icons/css/flag-icons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>" />
    <script src="<?= base_url('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <style>
        body {
            background-color: #10141a;
            color: #e0e0e0;
            font-family: "Segoe UI", sans-serif;
        }
        .card {
            background-color: #1b1f27;
            border: 1px solid #2d323c;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
        .card-header {
            background-color: #242a35;
            color: #fff;
            border-bottom: 1px solid #3c3f47;
            font-size: 1.2rem;
        }
        .table {
            background-color: #1e232d;
        }
        .table thead {
            background-color: #2d333f;
        }
        .table th {
            color: #a0c8ff;
        }
        .table-results {
            background-color: #272d39;
            margin-top: 0.5rem;
        }
        a {
            color: #8ecbff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Editace ročníku – <?= esc($year->default_name) ?></h1>

    <form method="post" action="<?= base_url("rocnik/update/" . $year->id) ?>">
        <div class="mb-3">
            <label for="real_name" class="form-label">Název ročníku</label>
            <input type="text" name="real_name" id="real_name" class="form-control" value="<?= esc($year->real_name) ?>">
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Datum začátku</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="<?= esc($year->start_date) ?>">
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Datum konce</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="<?= esc($year->end_date) ?>">
        </div>

        <div class="mb-3">
            <label for="uci_tour" class="form-label">UCI Tour</label>
            <select name="uci_tour" id="uci_tour" class="form-select">
                <option value="">— Vyberte —</option>
                <?php foreach ($uciTourTypes as $type): ?>
                    <option value="<?= $type->id ?>" <?= $year->uci_tour == $type->id ? 'selected' : '' ?>>
                        <?= esc($type->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Uložit změny</button>
        <a href="<?= base_url("rocnik/" . $year->id) ?>" class="btn btn-secondary">Zpět</a>
    </form>
</div>
</body>
</html>
