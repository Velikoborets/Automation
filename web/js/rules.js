let rules = 0;

/**
 * function for create new condition
 * 
 */
function createCondition() {

    if (rules >= 5) {
        alert('Количество правил не должно превышать 5.');
        return;
    }

    const conditionsZone = document.getElementById('conditions');
    const conditionWrapper = document.createElement('div');
    conditionWrapper.classList.add('condition-wrapper');

    // Создаем поле для ключа
    const key = document.createElement('input');
    key.classList.add('form-control', 'form-control-sm');
    key.setAttribute('name', `RuleForm[conditions][${rules}][key]`);
    key.setAttribute('placeholder', 'Сущность');

    // Создаем селектор для оператора
    const select = document.createElement('select');
    select.classList.add('form-control', 'form-control-sm');
    select.setAttribute('name', `RuleForm[conditions][${rules}][operator]`);

    // Добавляем опции в селектор
    const operators = ['=', '>', '<'];
    operators.forEach(op => {
        const option = document.createElement('option');
        option.value = op;
        option.textContent = op;
        select.appendChild(option);
    });

    // Создаем поле для значения
    const value = document.createElement('input');
    value.classList.add('form-control', 'form-control-sm');
    value.setAttribute('name', `RuleForm[conditions][${rules}][value]`);
    value.setAttribute('placeholder', 'Значение');

    // Кнопка для добавления нового условия
    const addButton = document.createElement('button');
    addButton.type = 'button';
    addButton.classList.add('btn', 'btn-success', 'btn-sm');
    addButton.textContent = '+';
    addButton.onclick = createCondition;

    // Кнопка для удаления условия
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'btn-m');
    removeButton.textContent = '-';
    removeButton.onclick = () => {
        conditionWrapper.remove();
        rules--;
    };

    // Добавляем элементы в обертку условия
    conditionWrapper.appendChild(key);
    conditionWrapper.appendChild(select);
    conditionWrapper.appendChild(value);
    conditionWrapper.appendChild(addButton);
    conditionWrapper.appendChild(removeButton);

    // Добавляем обертку в зону условий
    conditionsZone.appendChild(conditionWrapper);

    rules++;
}

/**
 * function to collect conditions before submitting a form
 * 
 */
function collectConditions() {

    // Создаём пустой массив, куда будет записывать собранные условия.
    const conditionsArray = [];

    // Получаем все элементы с классом condition-wrapper (внутри которых select с оption)
    const conditionWrappers = document.querySelectorAll('.condition-wrapper');

    // C помощью метода foreach() перебираем все элементы имеющие класс ".condition-wrapper";
    conditionWrappers.forEach(wrapper => {

        // Динамически формируем константы, внутри которых, если значение атрибута "name" с указанной подстрокой существ.
        // то записываем его в константу. (Проверка идёт с помощью QuerySelector - он ищет, а "*=" - озн. - содержит).
        const keyInput = wrapper.querySelector('[name*="[key]"]');
        const operatorSelect = wrapper.querySelector('[name*="[operator]"]');
        const valueInput = wrapper.querySelector('[name*="[value]"]');

        // И соотв. если во ВСЕ наши константы что-то записалось
        if (keyInput && operatorSelect && valueInput) {
            try {
                // Создается объект с тремя свойствами.
                const condition = {
                    key: keyInput.value,
                    operator: operatorSelect.value,
                    value: valueInput.value
                };
                // И добавл. массив conditionsArray с помощью метода push().
                conditionsArray.push(condition);
            } catch (error) {
                console.error('Ошибка при обработке условия:', error);
            }
        }
    });

    try {
        // Преобразуем массив условий в JSON-строку и сохраняем в скрытое поле формы
        document.getElementById('conditions-json').value = JSON.stringify(conditionsArray);
    } catch (error) {
        console.error('Ошибка при записи JSON:', error);
    }
}

// Добавляем обработчик события на отправку формы
document.querySelector('.rule-form').addEventListener('submit', collectConditions);
