<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Editace rocniku</title>
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
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .card-header {
            background-color: #242a35;
            color: #fff;
            font-size: 1.3rem;
            font-weight: 500;
            border-bottom: 1px solid #3c3f47;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.4rem;
        }

        .form-control,
        .form-select {
            background-color: #2a2f3a;
            color: #e0e0e0;
            border: 1px solid #3c414e;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #2a2f3a;
            color: #fff;
            border-color: #6ca0f6;
            box-shadow: 0 0 0 0.25rem rgba(108, 160, 246, 0.25);
        }

        .btn-primary {
            background-color: #4a90e2;
            border-color: #4a90e2;
        }

        .btn-primary:hover {
            background-color: #3973b7;
            border-color: #3973b7;
        }

        .btn-secondary {
            background-color: #3c3f47;
            border-color: #3c3f47;
            color: #ccc;
        }

        .btn-secondary:hover {
            background-color: #2e3138;
            border-color: #2e3138;
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

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <div class="card">
                    <!-- hlavicka karty -->
                    <div class="card-header">
                        Editace rocniku – <?= ($year->default_name) ?>
                    </div>
                    <div class="card-body">
                        <!-- formular pro editaci rocniku -->
                        <form method="post" action="<?= base_url("rocnik/update/" . $year->id) ?>">
                            <!-- pole pro nazev rocniku -->
                            <div class="mb-3">
                                <label for="real_name" class="form-label">Nazev rocniku</label>
                                <input type="text" name="real_name" id="real_name" class="form-control" value="<?= ($year->real_name) ?>">
                            </div>

                            <!-- pole pro datum zacatku -->
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Datum zacatku</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= ($year->start_date) ?>">
                            </div>

                            <!-- pole pro datum konce -->
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Datum konce</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="<?= ($year->end_date) ?>">
                            </div>

                            <!-- pole pro vyberUCI Tour -->
                            <div class="mb-4">
                                <label for="uci_tour" class="form-label">UCI Tour</label>
                                <select name="uci_tour" id="uci_tour" class="form-select">
                                    <!-- vychozi moznost -->
                                    <option value="">— Vyberte —</option>
                                    <!-- cyklus pro vypis vsech moznosti UCI Tour -->
                                    <?php foreach ($uciTourTypes as $type): ?>
                                        <!-- moznost UCI Tour -->
                                        <option value="<?= $type->id ?>" <?= $year->uci_tour == $type->id ? 'selected' : '' ?>>
                                            <?= ($type->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- tlacitka pro odeslani a navrat -->
                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url() ?>" class="btn btn-secondary">Zpet</a>
                                <button type="submit" class="btn btn-primary">Ulozit zmeny</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>