let conditionIndex = 1;

function createCondition() {
    if (conditionIndex >= 5) {
        alert('Количество правил не должно превышать 5.');
        return;
    }

    const conditionsDiv = document.getElementById('conditions');
    const newConditionDiv = document.createElement('div');
    newConditionDiv.className = 'condition-wrapper';

    // Получаем данные из скрытых полей
    const fields = JSON.parse(document.getElementById('fields-data').value);
    const operators = JSON.parse(document.getElementById('operators-data').value);

    let fieldsOptions = '<option value="">Select a field</option>';
    for (const key in fields) {
        if (fields.hasOwnProperty(key)) {
            fieldsOptions += `<option value="${key}">${fields[key]}</option>`;
        }
    }

    let operatorsOptions = '<option value="">Select an operator</option>';
    for (const key in operators) {
        if (operators.hasOwnProperty(key)) {
            operatorsOptions += `<option value="${key}">${operators[key]}</option>`;
        }
    }

    newConditionDiv.innerHTML = `
        <select name="conditions[${conditionIndex}][field]" class="form-control form-control-sm">
            ${fieldsOptions}
        </select>
        <select name="conditions[${conditionIndex}][operator]" class="form-control form-control-sm">
            ${operatorsOptions}
        </select>
        <input type="text" name="conditions[${conditionIndex}][value]" placeholder="Value" class="form-control form-control-sm"/>
        <button type="button" class="btn btn-success btn-sm" onclick="createCondition()">+</button>
        <button type="button" class="btn btn-danger btn-sm btn-m" onclick="removeCondition(this);">-</button>
    `;

    conditionsDiv.appendChild(newConditionDiv);
    conditionIndex++;
}

function removeCondition(button) {
    const parentWrapper = button.parentNode;
    if (parentWrapper.getAttribute('data-default-rule') === 'true') {
        alert('Правило по умолчанию нельзя удалить!');
    } else {
        parentWrapper.remove();
        conditionIndex--;
    }
}

document.getElementById('rule-form').addEventListener('submit', function(event) {
    const conditionWrappers = document.querySelectorAll('.condition-wrapper');
    if (conditionWrappers.length === 0) {
        event.preventDefault();
        alert('Необходимо добавить хотя бы одно условие!');
    }
});
