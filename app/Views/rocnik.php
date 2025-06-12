<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Výsledky ročníku</title>

    <link rel="stylesheet" href="<?= base_url('node_modules/flag-icons/css/flag-icons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>" />
    <script src="<?= base_url('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

    <style>
        body {
            background-color: #10141a;
            color: #e0e0e0;
            font-family: "Segoe UI", sans-serif;
        }

        h1 {
            margin-bottom: 0.5rem;
            color: #ffffff;
            font-weight: 600;
        }

        p {
            margin-bottom: 1.5rem;
            color: #c0c9d6;
        }

        .card {
            background-color: #1b1f27;
            border: 1px solid #2d323c;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            margin-bottom: 0;
            border-collapse: collapse;
            color: #e8f0ff;
        }

        thead {
            background-color: #2d333f;
        }

        thead th {
            color: #a0c8ff;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #3c3f47;
            text-align: left;
            font-weight: 600;
        }

        tbody tr:nth-child(odd) {
            background-color: #1e232d;
        }

        tbody tr:nth-child(even) {
            background-color: #272d39;
        }

        tbody td {
            padding: 0.65rem 1rem;
            border-bottom: 1px solid #2d323c;
        }

        tbody tr:hover {
            background-color: #323946;
        }

        a {
            color: #8ecbff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <!-- hlavni nadpis -->
        <h1>Top 20 – <?= ($year->default_name) ?> (<?= ($year->real_name) ?>)</h1>
        <!-- datum rocniku -->
        <p><?= ($year->start_date) ?> – <?= ($year->end_date) ?></p>

        <!-- pokud jsou vysledky, vypiseme je -->
        <?php if (!empty($results)): ?>
            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>Pořadí</th>
                            <th>Jezdec</th>
                            <th>Čas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- cyklus pro vypis vsech vysledku -->
                        <?php foreach ($results as $result): ?>
                            <tr>
                                <!-- poradi -->
                                <td><?= ($result->rank) ?></td>
                                <!-- jezdec -->
                                <td>
                                    <span class="flag-icon fi fi-<?php echo strtolower($result->country); ?>"></span>&nbsp;
                                    <?= ($result->first_name . ' ' . $result->last_name) ?>
                                </td>
                                <!-- cas -->
                                <td><?= ($result->time) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- pokud nejsou vysledky, vypiseme zprávu -->
        <?php else: ?>
            <!-- karta pro zprávu -->
            <div class="card">
                <p class="mb-0">Výsledky nejsou k dispozici.</p>
            </div>
        <?php endif; ?>

        <!-- odkaz zpet na hlavni stranku -->
        <a href="<?= base_url() ?>" class="back-link">← Zpět na přehled</a>

    </div>
</body>

</html>