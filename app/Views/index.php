<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite závody</title>

    <link rel="stylesheet" href="<?= base_url('node_modules/flag-icons/css/flag-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url("node_modules/bootstrap/dist/css/bootstrap.min.css") ?>">
    <script src="<?= base_url("node_modules/bootstrap/dist/js/bootstrap.bundle.min.js") ?>"></script>

    <style>
        body {
            background-color: #10141a;
            color: #e0e0e0;
            font-family: "Segoe UI", sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 2.5rem;
            color: #ffffff;
        }

        .card {
            background-color: #1b1f27;
            border: 1px solid #2d323c;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background-color: #242a35;
            color: #ffffff;
            border-bottom: 1px solid #3c3f47;
            font-size: 1.25rem;
            font-weight: 500;
            padding: 1rem 1.25rem;
        }

        .table {
            background-color: #1e232d;
            margin-bottom: 0;
        }

        .table thead {
            background-color: #2d333f;
        }

        .table th {
            color: #a0c8ff;
            font-weight: 600;
        }

        .table td,
        .table th {
            vertical-align: middle;
            padding: 0.75rem;
        }

        a {
            color: #8ecbff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn-outline-info {
            border-radius: 8px;
            border-color: #3399ff;
            color: #3399ff;
        }

        .btn-outline-info:hover {
            background-color: #3399ff;
            color: #fff;
        }

        .flag-icon {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>Elite závody mužů</h1>

        <!-- cyklus pro vypis vsech zavodu -->
        <?php foreach ($races as $race): ?>
            <div class="card">
                <div class="card-header">
                    <!-- pokud je nastavena zeme, vypiseme ji jako vlajku -->
                    <?php if (!empty($race->info->country)): ?>
                        <span class="fi fi-<?= strtolower(($race->info->country)) ?> flag-icon"></span>&nbsp;
                    <?php endif; ?>
                    <?= ($race->info->default_name) ?>
                </div>
                <div class="card-body p-0">
                    <!-- tabulka s rocniky zavodu -->
                    <table class="table table-sm table-dark table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Ročník</th>
                                <th>Datum</th>
                                <th>UCI Tour</th>
                                <th>Top 20 výsledků</th>
                                <th>Upravit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- cyklus pro vypis vsech rocniku zavodu -->
                            <?php foreach ($race->years as $year): ?>
                                <tr>
                                    <!-- nazev rocniku -->
                                    <td>
                                        <a href="<?= base_url('rocnik/' . $year->id) ?>">
                                            <?= ($year->real_name) ?>
                                        </a>
                                    </td>
                                    <!-- datum rocniku -->
                                    <td><?= ($year->start_date) ?> – <?= ($year->end_date) ?></td>
                                    <!-- uci tour rocniku -->
                                    <td><?= ($year->uci_tour_name ?? '-') ?></td>
                                    <!-- odkaz na vysledky rocniku -->
                                    <td>
                                        <a href="<?= base_url('rocnik/' . $year->id) ?>">Zobrazit výsledky</a>
                                    </td>
                                    <!-- odkaz na editaci rocniku -->
                                    <td>
                                        <a href="<?= base_url('rocnik/edit/' . $year->id) ?>" class="btn btn-sm btn-outline-info">
                                            Upravit ročník
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>