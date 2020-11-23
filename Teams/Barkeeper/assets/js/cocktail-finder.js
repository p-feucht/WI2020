ingredientSelects = [undefined];

function addIngredientsSelect(id, selectedValue) {
    isNew = (id !== undefined) ? false : true;
    id = (id !== undefined) ? id : ingredientSelects.length;
    let html = `
        <div class="form-group row ingredient-select-group" id="ingredient-select-group-${id}">
            <label for="ingredient-select-${id}" class="col-sm-2 col-form-label">Zutat ${id + 1}</label>
            <div class="col-sm-${id !== 0 ? '9' : '10'}">
                <select id="ingredient-select-${id}" data-id="${id}" name="ingredient-select-${id}" class="form-control ingredient-select selectpicker" data-live-search="true" title="Zutat auswählen...">
                    ${availableIngredients.map(ingredient => '<option data-tokens="'+ingredient.title+'" value="'+ingredient.id+'">'+ingredient.title+'</option>')}
                </select>
            </div>
            ${ id !== 0 ? `
                <div class="col-md-1">
                    <button id="remove-ingredient-filter-${id}-btn" class="btn btn-outline-danger remove-ingredient-filter-btn" data-id="${id}"><i class="fas fa-times"></i></button>
                </div>
            ` : ''}
        </div>
    `;

    let existingEls = document.querySelectorAll('.ingredient-select-group');
    if(existingEls.length > 0) {
        existingEls[existingEls.length-1].insertAdjacentHTML('afterend', html);
        document.querySelector(`#remove-ingredient-filter-${id}-btn`).addEventListener('click', ($event) => {
            $event.preventDefault();
            let id = $event.target.getAttribute('data-id');
            if(!id) {
                id = $event.target.closest('.remove-ingredient-filter-btn').getAttribute('data-id');
            }
            removeIngredientSelect(id);
        });
    } else {
        document.querySelector('#add-ingredient-filter-group').insertAdjacentHTML('beforeBegin', html);
    }

    if(selectedValue) {
        $('#ingredient-select-'+id).selectpicker('val', selectedValue);
    } else {
        $('#ingredient-select-'+id).selectpicker();
    }

    if(isNew) {
        ingredientSelects.push(undefined);
    }
    
    $('#ingredient-select-'+id).on('changed.bs.select', (e, clickedIndex, isSelected, previousValue) => {
        let id = parseInt(e.target.getAttribute('data-id'));
        let val = e.target.value;
        ingredientSelects[id] = val;
    });
}

function removeIngredientSelect(index) {
    index = index;
    ingredientSelects.splice(index, 1);
    renderAllIngredients();
}

function renderAllIngredients() {
    document.querySelectorAll('.ingredient-select-group').forEach(element => {
        element.remove();
    });
    for(let i = 0; i < ingredientSelects.length; i++) {
        addIngredientsSelect(i, ingredientSelects[i]);
    }
}

(() => {
    // Initialisierung des Select Plugins
    $('#ingredient-select-0').selectpicker();
    $('#ingredient-select-0').on('changed.bs.select', (e, clickedIndex, isSelected, previousValue) => {
        let id = parseInt(e.target.getAttribute('data-id'));
        let val = e.target.value;
        ingredientSelects[id] = val;
    });


    document.querySelector('#add-ingredient-filter-btn').addEventListener('click', ($event) => {
        // preventDefault wird benötigt, da ein Click auf einen Button in eine Formular ein Submit Event auslöst.
        // Das hat zur Folge, dass der Browser das Formular an den Server schicken will und die Seite neu lädt und
        // den eigentlichem Code nicht ausführt.
        $event.preventDefault();
        addIngredientsSelect();
    });
})();