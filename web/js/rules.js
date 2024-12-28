// Счётчик для отслеживания условий
let conditionIndex = 1;

/**
 * Функция для создания нового условия
 */
function createCondition() {
    // Проверяем, не превышено ли максимальное количество условий (5)
    if (conditionIndex >= 5) {
        alert('Количество правил не должно превышать 5.');
        return;
    }

    // Получаем контейнер для условий
    const conditionsDiv = document.getElementById('conditions');
    if (!conditionsDiv) {
        console.error('Элемент с id="conditions" не найден');
        return;
    }

    // Создаем обертку для условия
    const newConditionDiv = document.createElement('div');
    newConditionDiv.className = 'condition-wrapper';

    // Получаем данные из скрытых полей
    const fields = JSON.parse(document.getElementById('fields-data').value);
    const operators = JSON.parse(document.getElementById('operators-data').value);

    // Создаем элементы для поля, оператора и значения
    const field = document.createElement('select');
    field.classList.add('form-control', 'form-control-sm');
    const operator = document.createElement('select');
    operator.classList.add('form-control', 'form-control-sm');
    const value = document.createElement('input');
    value.classList.add('form-control', 'form-control-sm');
    value.setAttribute('type', 'text');
    value.setAttribute('placeholder', 'Value');

    // Добавляем опции в select поля
    const fieldDefaultOption = document.createElement('option');
    fieldDefaultOption.value = '';
    fieldDefaultOption.textContent = 'Select a field';
    field.appendChild(fieldDefaultOption);

    for (const key in fields) {
        if (fields.hasOwnProperty(key)) {
            const option = document.createElement('option');
            option.value = key;
            option.textContent = fields[key];
            field.appendChild(option);
        }
    }

    // Добавляем опции в select оператора
    const operatorDefaultOption = document.createElement('option');
    operatorDefaultOption.value = '';
    operatorDefaultOption.textContent = 'Select an operator';
    operator.appendChild(operatorDefaultOption);

    for (const key in operators) {
        if (operators.hasOwnProperty(key)) {
            const option = document.createElement('option');
            option.value = key;
            option.textContent = operators[key];
            operator.appendChild(option);
        }
    }

    // Устанавливаем имена для полей
    field.setAttribute('name', `conditions[${conditionIndex}][field]`);
    operator.setAttribute('name', `conditions[${conditionIndex}][operator]`);
    value.setAttribute('name', `conditions[${conditionIndex}][value]`);

    // Добавляем элементы в обертку
    newConditionDiv.appendChild(field);
    newConditionDiv.appendChild(operator);
    newConditionDiv.appendChild(value);

    // Создаем кнопку "+" для добавления условий
    const addButton = document.createElement('button');
    addButton.type = 'button';
    addButton.classList.add('btn', 'btn-success', 'btn-sm');
    addButton.textContent = '+';
    addButton.onclick = createCondition;

    // Создаем кнопку "-" для удаления условий
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'btn-m');
    removeButton.textContent = '-';
    removeButton.onclick = () => {
        newConditionDiv.remove(); // Удаляем обертку
        conditionIndex--; // Уменьшаем счётчик
    };

    // Добавляем кнопки в обертку
    newConditionDiv.appendChild(addButton);
    newConditionDiv.appendChild(removeButton);

    // Добавляем обертку в контейнер
    conditionsDiv.appendChild(newConditionDiv);

    // Увеличиваем счётчик
    conditionIndex++;
}

/**
 * Функция для удаления условия
 */
function removeCondition(button) {
    const parentWrapper = button.parentNode;
    if (parentWrapper.getAttribute('data-default-rule') === 'true') {
        alert('Правило по умолчанию нельзя удалить!');
    } else {
        parentWrapper.remove();
        conditionIndex--;
    }
}

// Обработчик события отправки формы
document.getElementById('rule-form').addEventListener('submit', function(event) {
    const conditionWrappers = document.querySelectorAll('.condition-wrapper');
    if (conditionWrappers.length === 0) {
        event.preventDefault();
        alert('Необходимо добавить хотя бы одно условие!');
    }
});
