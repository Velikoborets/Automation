<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Правила</title>
</head>
<body class="bg-dark text-light">
<div class="container mt-5">
    <h1 class="mb-4">Создайте правило</h1>
    <form id="createRuleForm">
        <div class="form-group row align-items-center">
            <label for="name" class="col-sm-2 col-form-label">Имя правила</label>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="name" name="Rule[name]" required>
            </div>
        </div>
        <p>Условия</p>
        <div id="conditions" class="mb-3">
            <div class="condition-wrapper">
                <input class="form-control form-control-sm" name="Rule[conditions][0][key]">
                <select class="form-control form-control-sm" name="Rule[conditions][0][operator]">
                    <option value="=">=</option>
                    <option value=">">></option>
                    <option value="<"><</option>
                </select>
                <input class="form-control form-control-sm" name="Rule[conditions][0][value]">
                <button type="button" class="btn btn-success btn-sm" onclick="createCondition()">+</button>
                <button type="button" class="btn btn-danger btn-sm btn-m">-</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>
</body>
</html>