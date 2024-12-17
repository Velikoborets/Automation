
let rules = 0;

function createCondition() {

    if (rules >= 4) {
        alert('Количество правил не должно быть больше 5');
        return;
    }

    const conditionsZone = document.getElementById('conditions');
    const conditionWrapper = document.createElement('div');
    conditionWrapper.classList.add('condition-wrapper');

    const key = document.createElement('input');
    key.classList.add('form-control', 'form-control-sm');
    const select = document.createElement('select');
    select.classList.add('form-control', 'form-control-sm');
    const value = document.createElement('input');
    value.classList.add('form-control', 'form-control-sm');

    const equalOption = document.createElement('option');
    equalOption.value = '=';
    equalOption.textContent = '=';
    const greaterThanOption = document.createElement('option');
    greaterThanOption.value = '>';
    greaterThanOption.textContent = '>';
    const lessThanOption = document.createElement('option');
    lessThanOption.value = '<';
    lessThanOption.textContent = '<';

    select.appendChild(equalOption);
    select.appendChild(greaterThanOption);
    select.appendChild(lessThanOption);

    key.setAttribute('name', `Rule[conditions][${rules}][key]`);
    select.setAttribute('name', `Rule[conditions][${rules}][operator]`);
    value.setAttribute('name', `Rule[conditions][${rules}][value]`);

    conditionWrapper.appendChild(key);
    conditionWrapper.appendChild(select);
    conditionWrapper.appendChild(value);

    const addButton = document.createElement('button');
    addButton.type = 'button';
    addButton.classList.add('btn', 'btn-success', 'btn-sm');
    addButton.textContent = '+';
    addButton.onclick = createCondition; // Используем onclick для привязки функции

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'btn-m');
    removeButton.textContent = '-';
    removeButton.onclick = () => {
        conditionWrapper.remove();
        rules--;
    };

    conditionWrapper.appendChild(addButton);
    conditionWrapper.appendChild(removeButton);
    conditionsZone.appendChild(conditionWrapper);

    rules++;
}

document.getElementById('addCondition').addEventListener('click', () => {
    if (rules >= 4) {
        alert('Количество правил не должно превышать 5');
        return
    }

    createCondition();
});